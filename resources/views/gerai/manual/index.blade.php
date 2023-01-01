@extends('layouts.dashboard')
@section('title', 'Transaksi Offline')

@section('header', 'Transaksi Offline')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Transaksi Offline</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau semua donasi yang diinput melalui admin</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/gerai/manual_donation/create') }}"><span>Input Transaksi</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				@if(count($funding) == 0)
					<h3>Belum Ada Donasi</h3>
					<p>belum ada Donasi</p>
				@else
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Kontak</th>
							<th scope="col">Campaign</th>
							<th scope="col">Donasi</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($funding as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->donature_name }}</td>
							<td>{{ $v->donature_email . ', '. $v->donature_phone }}</td>
							<td>{{ $v->project == null ? "Program instant ".$v->fund_type : $v->project->title }}</td>
							<td>{{ number_format($v->total, 0, ',', '.') }}</td>
							<td>
								<a href="{{ url('gerai/manual_donation/'.$v->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
								<button data-id="{{ $v->id }}" class="btn btn-sm btn-danger btn-delete-trigger"><i class="bx bx-trash"></i></button>
								{{-- <a target="_blank" href="{{ url('gerai/manual_donation/'.$v->id.'/receipt') }}" class="btn btn-sm btn-primary"><i class="bx bx-printer"></i></a> --}}
								<a download="{{'FD-'.sprintf('%05d', $v->id).now()->format('dmY')}}" href="{{ url('admin/kwitansi/'.$v->id) }}" class="btn btn-sm btn-primary"><i class="bx bx-download"></i></a>
								<a target="_blank" href="{{ url('gerai/kwitansi/'.$v->id) }}" class="btn btn-sm btn-primary"><i class="bx bx-printer"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
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
			$("#form-delete").attr('action', '{{ url("gerai/manual_donation") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});

		@if(request()->receipt)
		window.open("/gerai/manual_donation/" + '{{ request()->receipt }}' + '/receipt');
		@endif
	});
</script>
@endsection
