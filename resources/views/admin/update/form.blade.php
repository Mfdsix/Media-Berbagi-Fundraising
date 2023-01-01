@extends('layouts.dashboard')
@section('title', 'Update Laporan')

@section('css')
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: var(--main-color) !important;
		color: #fff !important;
	}
</style>
@endsection

@section('header', "Update Laporan")

@section('content')
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/update') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('admin/update/'.$data->id) : url('admin/update') }}">
			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="project_id">Projek</label>
							<select id="project_id" @if(isset($data)) readonly @endif class="form-control select-picker" name="project_id" required=""  data-live-search="true">
								<option value="">Pilih Projek</option>
								@foreach($projects as $k => $v)
								<option @if(isset($data) && $data->project_id == $v->id) selected @endif value="{{ $v->id }}">{{ $v->title }}</option>
								@endforeach
							</select>
							@error('project_id')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="content">Judul</label>
							<input name="title" class="form-control" placeholder="Masukan Judul" value="{{ isset($data) ? $data->title : old('title') }}">
							@error('title')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="content">Konten</label>
							<textarea name="content" class="form-control saminote" placeholder="Konten">{{ isset($data) ? $data->content : old('content') }}</textarea>
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
		</form>
	</div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#project_id').selectpicker();
		$('.saminote').summernote({
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
            $('.saminote').summernote("insertNode", image[0]);
		}
		});
	}
</script>
@endsection
