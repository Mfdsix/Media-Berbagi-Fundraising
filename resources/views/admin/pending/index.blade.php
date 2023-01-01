@extends('layouts.dashboard')
@section('title', 'User Pending')

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">User Pending</h2>
	<h5 class="text-white op-7 mb-2">User Pending</h5>
</div>
@endsection

@section('content')
<div class="row mt--2">
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				<h3>Belum Ada Penggalang Dana</h3>
				<p>tambah penggalang dana</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				@include('layouts.notif')
				<div class="card-sub">
					Daftar User Pending
				</div>
				<table class="table mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Deskripsi</th>
							<th scope="col">Alamat</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->fullname }}</td>
							<td>{!! $v->description !!}</td>
							<td>{{ $v->address }}</td>
							<td>
								<a href="{{ url('admin/pending/'.$v->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
							</td>
						</tr>
						@endforeach				
					</tbody>
				</table>
				{!! $datas->links() !!}
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

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-delete-trigger").on("click", function(){
			var id = $(this).data('id');
			$("#form-delete").attr('action', '{{ url("admin/fundraiser") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection