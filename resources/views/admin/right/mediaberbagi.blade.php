@extends('layouts.dashboard')
@section('title', 'Hak MediaBerbagi')

@section('header', 'Hak MediaBerbagi')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Hak MediaBerbagi</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">history penyaluran dana terkumpul</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/mediaberbagi_right/create') }}"><span>Input Pencatatan</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada Penyaluran</h3>
				<p>salurkan dana sekarang</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nominal</th>
							<th scope="col">Rencana Penggunaan</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ number_format($v->nominal, 0, null, '.') }}</td>
							<td>{{ $v->use_plan }}</td>
							<td>{{ date('d M Y', strtotime($v->created_at)) }}</td>
							<td>
								<a href="{{ url('admin/mediaberbagi_right/'.$v->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
								<button data-id="{{ $v->id }}" class="btn btn-sm btn-danger btn-delete-trigger"><i class="bx bx-trash"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<div>
					{!! $datas->links() !!}
				</div>

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
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus data ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-delete">Hapus</button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<form method="post" id="form-delete">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
</form>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-delete-trigger").on("click", function(){
			var id = $(this).data('id');
			$("#form-delete").attr('action', '{{ url("admin/mediaberbagi_right") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
