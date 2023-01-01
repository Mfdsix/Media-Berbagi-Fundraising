@extends('layouts.dashboard')
@section('title', 'Update Laporan')

@section('header', 'Update Laporan')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Update Laporan</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">buat update laporan untuk campaign</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/dashboard-program/update/create') }}"><span>Buat Update</span></a>
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
				<h3>Belum Ada Update</h3>
				<p>buat update baru</p>
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
							<th scope="col">#</th>
							<th scope="col">Nama Projek</th>
							<th scope="col">Tipe</th>
							<th scope="col">Dibuat Pada</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->project ? $v->project->title : '-' }}</td>
							<td><span class="badge badge-success">Update</span></td>
							<td style="max-height: 200px">{!! $v->created_at !!}</td>
							<td>
								<a target="_blank" href="{{ url('project/'.$v->project_id.'/news') }}" class="btn btn-sm btn-primary">preview</a>
								<a class="btn btn-sm btn-warning" href="{{ url('/dashboard-program/update/'.$v->id.'/edit') }}"><i class="bx bx-edit"></i></a>
								<button data-id="{{ $v->id }}" class="btn-delete-trigger btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
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
			$("#form-delete").attr('action', '{{ url("dashboard-program/update") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});
		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
