@extends('layouts.dashboard')
@section('title', 'Penarikan Komisi')

@section('header', 'Penarikan Komisi')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Penarikan Komisi</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kelola penarikan komisi fundraiser</p>
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
				<h3>Belum Ada Permintaan</h3>
				<p>belum ada penarikan</p>
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
							<th scope="col">Kategori</th>
							<th scope="col">Icon</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->category }}</td>
							<td>
								@if($v->path_icon == null)
								<img src="{{ asset('images/category.png') }}" height="50">
								@else
								<img src="{{ asset('storage/'.$v->path_icon) }}" height="50">
								@endif
							</td>
							<td>
								<a href="{{ url('accounting/instance_right/'.$v->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
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
			$("#form-delete").attr('action', '{{ url("accounting/instance_right") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
