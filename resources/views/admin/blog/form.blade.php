@extends('layouts.dashboard')
@section('title', 'Kelola Blog')

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

@section('header', "Kelola Blog")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/blog') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ (isset($data)) ? url('admin/blog/'.$data->id) : url('admin/blog') }}" method="post" enctype="multipart/form-data">
			@csrf
			@if(isset($data))
			<input type="hidden" name="_method" value="PUT">
			@endif
			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">

						<div class="mb-4">
							<label for="title">Judul</label>
							<input type="text" class="form-control" id="title" placeholder="Judul" name="title" required="" value="{{ isset($data) ? $data->title : old('title') }}">
							@error('title')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="slug">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="Judul" name="slug" required="" value="{{ isset($data) ? $data->slug : old('slug') }}">
							@error('slug')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="category">Kategori</label>
							<select class="form-control" required="" name="category">
								<option value="">Pilih Kategori</option>
								@foreach($categories as $k => $v)
								<option @if(isset($data) && $data->category == $v->id) selected="" @endif value="{{ $v->id }}">{{ $v->name }}</option>
								@endforeach
							</select>
							@error('category')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="featured">Foto</label>
							<p class="text-warning">blog image recommendation 575x575px</p>
							<input type="file" class="form-control" id="featured" placeholder="Foto" name="featured">
							@error('featured')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="content">Konten</label>
							<textarea class="samernot" name="content" required="">{{ isset($data) ? $data->content : old('content') }}</textarea>
							@error('content')
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.samernot').summernote({
			tabsize: 2,
			height: 300,
			callbacks: {
				onImageUpload: function(files, editor, welEditable) {
					sendFile(files[0], editor, welEditable);
				}
			}
		});
	});

	function sendFile(file,editor,welEditable) {
		let data = new FormData();
		data.append("file", file);
		$.ajax({
		data: data,
		type: "POST",
		url: '{{ url("/api/upload") }}',
		cache: false,
		contentType: false,
		processData: false,
		success: function(url) {
			var image = $('<img>').attr('src', url);
            $('.samernot').summernote("insertNode", image[0]);
		}
		});
	}
</script>
@endsection
