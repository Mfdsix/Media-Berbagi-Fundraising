@extends('layouts.dashboard')
@section('title', 'Program Qurban')

@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: var(--main-color) !important;
		color: #fff !important;
	}
</style>
@endsection

@section('header', "Program Qurban")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/qurban') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/qurban/'.$data->id) : url('admin/qurban') }}" method="post">
			@csrf
			@if(isset($data))
			<input type="hidden" name="_method" value="PUT">
			@endif

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="title">Judul</label>
							<input type="text" class="form-control" id="title" placeholder="Judul" name="title" required="" value="{{ (isset($data)) ? $data->title : '' }}">
							@error('title')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="price">Harga (Rp.)</label>
							<input type="number" class="form-control" id="price" placeholder="Harga" name="price" value="{{ (isset($data)) ? $data->price : '' }}">
							@error('price')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" id="path_icon" placeholder="Foto" name="path_icon">
							@error('path_icon')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

					</div>
				</div>
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
@endsection
