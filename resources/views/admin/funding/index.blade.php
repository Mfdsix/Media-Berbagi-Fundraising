@extends('layouts.dashboard')
@section('title', 'Penggalangan Dana')

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">Program Penggalangan</h2>
	<h5 class="text-white op-7 mb-2">Program Penggalangan</h5>
</div>
<div class="ml-md-auto py-2 py-md-0">
	<a href="{{ url('admin/funding/create') }}" class="btn btn-secondary btn-round">Buat Program</a>
</div>
@endsection

@section('content')
<div class="row mt--2">
	<div class="col-md-12 mb-3">
		@include('layouts.notif')
	</div>
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				<h3>Belum Ada Program</h3>
				<p>mulai galang dana sekarang</p>
			</div>
		</div>
	</div>
	@else
	@foreach($datas as $k => $v)
	<div class="col-md-4 mb-3">
		<div class="card card-post card-round">
			@if($v->path_featured == null)
			<img class="card-img-top" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
			@else
			<img class="card-img-top" src="{{ asset('storage/'.$v->path_featured) }}" alt="Card image cap">
			@endif
			<div class="card-body">
				<p class="card-category text-info mb-1"><a href="javascript:void(0)">Program</a></p>
				<h3 class="card-title">
					<a href="#">
						{{ $v->title }}
					</a>
				</h3>
				<hr>
				<div>
					<a href="{{ url($v->slug) }}" target="_blank" class="btn btn-primary btn-rounded btn-sm">Preview</a>
					<a href="{{ url('admin/funding/'.$v->id.'/edit') }}" class="btn btn-warning btn-rounded btn-sm">Edit</a>
					<button data-id="{{ $v->id }}" class="btn btn-danger btn-delete-trigger btn-rounded btn-sm">Hapus</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="col-md-12 mt-4">
		{{ $datas->links() }}
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
			$("#form-delete").attr('action', '{{ url("admin/funding") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection