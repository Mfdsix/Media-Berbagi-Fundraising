@extends('layouts.dashboard')
@section('title', 'Penggalangan Dana')

@section('header', 'Penggalangan Dana')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Sebarkan kebaikan</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">sebarkan kebaikan dengan membuat lebih banyak campaign</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/campaign/create') }}"><span>Buat Campaign</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">

	{{--show all error--}}
	@if ($errors->any())
	<div class="col-md-12">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<button type="button" class="btn text-danger close" data-dismiss="alert" aria-label="Close" style="">
				<span aria-hidden="true">&times;</span> close
			</button>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif

	{{-- instant program --}}
	<div class="col-4 col-sm-12 mb-25">
		<div class="box client">
			<div class="dropdown">
				<a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
					<i class='bx bx-dots-horizontal-rounded'></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ url('admin/campaign/0/edit') }}"><i class="bx bx-edit mr-5"></i>Edit</a>
				</div>
			</div>
			<div class="box-body pt-5 pb-0">
				<div class="img-box">
					@if($instant['instant']->path_featured == null)
					<img class="card-img-top" src="{{ asset('assets/img/sedekah-icon.svg') }}" alt="Card image cap">
					@else
					<img class="card-img-top" src="{{ asset('storage/'.$instant['instant']->path_featured) }}" alt="Card image cap">
					@endif
				</div>
				<a href="javascript:void(0)">
					@if($instant['instant']->title == null)
						<h5 class="mt-17">Program Instant {{ $instant['title'] }}</h5>
					@else 
						<h5 class="mt-17">{{ $instant['instant']->title }}</h5>
					@endif
				</a>
				<p class="fs-14 font-w400 font-main">Program Tidak Terikat</p>
				<ul class="info">
					<li class="fs-14"><i class='bx bxs-dollar-circle'></i>∞</li>
					<li class="fs-14"><i class='bx bxs-timer'></i>∞</li>
				</ul>
				<div class="group-btn d-flex justify-content-between">
					<a class="bg-btn-pri color-white" href="{{ url('program-instant-sedekah') }}" target="_blank">Preview</a>
				</div>
			</div>

		</div>
	</div>

	@if(count($datas) > 0)
	@foreach($datas as $k => $v)
	<div class="col-4 col-sm-12 mb-25">
		<div class="box client" @if($v->is_hidden == 1) style="background:#dbdbdb" @endif>

			<div class="dropdown">
				<a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
					<i class='bx bx-dots-horizontal-rounded'></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ url('admin/campaign/'.$v->id.'/edit') }}"><i class="bx bx-edit mr-5"></i>Edit</a>
					<a href="javascript:void(0);" data-id="{{ $v->id }}" class="dropdown-item btn-delete-trigger"><i class="bx bx-trash"></i> Hapus</a>
				</div>
			</div>
			<div class="box-body pt-5 pb-0">
				<div class="img-box">
					@if($v->path_featured == null)
					<img class="card-img-top" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
					@else
					<img class="card-img-top" src="{{ asset('storage/'.$v->path_featured) }}" alt="Card image cap">
					@endif
				</div>
				<a href="client-details.html"><h5 class="mt-17">{{ $v->title }}</h5></a>

				<p class="fs-14 font-w400 font-main">{{ $v->category == null ? 'Tidak Berkateogri' : $v->category->category }}</p>
				<ul class="info">
					<li class="fs-14"><i class='bx bxs-dollar-circle'></i>{{ $v->nominal_target }}</li>
					<li class="fs-14"><i class='bx bxs-timer'></i>{{ $v->date_target }}</li>
				</ul>
				<div class="group-btn d-flex justify-content-between">
					<a class="bg-btn-pri color-white" href="{{ url($v->slug ?? '') }}" target="_blank">Preview</a>
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
			$("#form-delete").attr('action', '{{ url("admin/campaign") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
