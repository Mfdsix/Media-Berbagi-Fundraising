@extends('layouts.dashboard')
@section('title', 'Kelola Kegiatan')

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

@section('header', "Kelola Kegiatan")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/activity') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ (isset($data)) ? url('admin/activity/'.$data->id) : url('admin/activity') }}" method="post" enctype="multipart/form-data">
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
							<label for="photo">Foto</label>
							<p class="text-warning">kegiatan image recommendation 575x575px</p>
							<input type="file" class="form-control" id="photo" placeholder="Foto" name="photo">
							@error('photo')
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

						<div class="mb-4">
							<label for="link">CTA (call to action)</label>
							<input type="text" class="form-control" id="link" placeholder="Name Button CTA" name="link" required="" value="{{ isset($data) ? $data->link : old('link') }}">
							@error('link')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="direct_link">Direct_link direct_link</label>
							<input type="text" class="form-control" id="direct_link" placeholder="Direct link" name="direct_link" required="" value="{{ isset($data) ? $data->direct_link : old('direct_link') }}">
							@error('direct_link')
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
