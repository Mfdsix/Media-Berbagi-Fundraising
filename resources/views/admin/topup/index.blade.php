@extends('layouts.dashboard')
@section('title', 'Topup Saldo')

@section('header', 'Topup Saldo')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Topup Saldo</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau transaksi topup saldo dari akun donatur</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt-2">
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada Transaksi</h3>
				<p>belum ada transaksi</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">User</th>
							<th scope="col">Nominal</th>
							<th scope="col">Status</th>
							<th scope="col">Tanggal</th>
							<th scope="col">#</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->username }}</td>
							<td>{{ number_format($v->nominal, 0, ',', '.') }}</td>
							<td>
								@if($v->status == 0)
								<span class="badge badge-danger">Dibatalkan</span>
								@elseif($v->status == 1)
								<span class="badge badge-warning">Menunggu Pembayaran</span>
								@elseif($v->status == 2)
								<span class="badge badge-warning">Menunggu Verifikasi</span>
								@elseif($v->status == 3)
								<span class="badge badge-success">Berhasil</span>
								@else
								<span class="badge badge-danger">Gagal</span>
								@endif
							</td>
							<td>{{$v->created_at->diffForHumans()}}</td>
							<td>
								<a href="/admin/topup/{{ $v->id }}" class="btn-warning btn-sm"><i class="fa fa-edit mr-2"></i>Edit</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
	@endif
</div>

<div class="modal" id="modal-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus data ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-delete">Hapus</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<form method="post" id="form-delete">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
</form>
@endsection

@push('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-delete-trigger").on("click", function(){
			var id = $(this).data('id');
			$("#form-delete").attr('action', '{{ url("super_admin/slider") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});
		
		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endpush
