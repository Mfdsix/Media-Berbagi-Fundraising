@extends('layouts.dashboard')
@section('title', 'Penggalangan Dana')

@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: #1a2035!important;
	}
</style>
@endsection

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">Penggalangan Dana</h2>
	<h5 class="text-white op-7 mb-2">Penggalangan Dana</h5>
</div>
<div class="ml-md-auto py-2 py-md-0">
</div>
@endsection

@section('content')
<div class="row mt--2">
	<div class="col-md-12">
		<form class="card" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/funding/'.$data->id) : url('admin/funding') }}" method="post">
			@csrf
			@if(isset($data))
			<input type="hidden" name="_method" value="PUT">
			@endif
			<div class="card-header">
				<div class="card-title">Galang Dana</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="form-group">
							<label for="title">Judul</label>
							<input type="text" class="form-control" id="title" placeholder="Judul" name="title" required="" value="{{ isset($data) ? $data->title : old('title') }}">
							@error('title')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="slug">Slug (jika dikosongi akan digenerate otomatis)</label>
							<input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{ isset($data) ? $data->slug : old('slug') }}">
							@error('slug')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" id="featured" placeholder="Foto" name="featured">
							@error('featured')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="content">Konten</label>
							<textarea id="content" name="content" required="">{{ isset($data) ? $data->content : old('content') }}</textarea>
							@error('content')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
			</div>
			<div class="card-action">
				<button class="btn btn-success">Submit</button>
				<a href="" class="btn btn-danger">Kembali</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#content').summernote({
			tabsize: 2,
        	height: 300
		});
	});
</script>
@endsection