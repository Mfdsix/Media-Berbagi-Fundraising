@extends('layouts.dashboard')
@section('title', 'Official Store')

@section('header', 'Official Store')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Official Store</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">promosikan produk-produk anda untuk donatur</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/product/create') }}"><span>Tambah Produk</span></a>
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
				<h3>Belum Ada Product Official Store</h3>
				<p>Buat Product Baru Sekarang</p>
			</div>
		</div>
	</div>
	@else
	@foreach($datas as $k => $v)
	<div class="col-4 col-sm-12 mb-25">
		<div class="box client">

			<div class="dropdown">
				<a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
					<i class='bx bx-dots-horizontal-rounded'></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ url('admin/product/'.$v->id.'/edit') }}"><i class="bx bx-edit mr-5"></i>Edit</a>
					<a href="javascript:void(0);" data-id="{{ $v->id }}" class="dropdown-item btn-delete-trigger"><i class="bx bx-trash"></i> Hapus</a>
				</div>
			</div>
			<div class="box-body pt-5 pb-0">
				<div class="img-box">
					@if($v->thumbnail == null)
					<img class="card-img-top" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
					@else
					<img class="card-img-top" src="{{ asset('storage/'.$v->thumbnail) }}" alt="Card image cap">
					@endif
				</div>
				<a href="javascript:void(0)"><h5 class="mt-17">{{ $v->name }}</h5></a>

				<p class="fs-14 font-w400 font-main">{{ $v->price }}</p>
				
				<div class="group-btn d-flex justify-content-between">
					<a class="bg-btn-pri color-white" href="{{ url('product/' . $v->id) }}" target="_blank">Preview</a>
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
			$("#form-delete").attr('action', '{{ url("admin/product") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});
		
		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
