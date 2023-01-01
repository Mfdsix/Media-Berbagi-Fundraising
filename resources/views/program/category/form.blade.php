@extends('layouts.dashboard')
@section('title', 'Kelola Kategori')

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

@section('header', "Kelola Kategori")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/dashboard-program/category') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('dashboard-program/category/'.$data->id) : url('dashboard-program/category') }}">
			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="category">Nama Kategori</label>
							<input type="text" class="form-control" id="category" placeholder="Nama Kategori" name="category" required="" value="{{ isset($data) ? $data->category : old('category') }}">
							@error('category')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<input type="checkbox" class="form-checked mr-2" id="status" name="status" {{isset($data) ? ($data->risalah_status == 1 ? 'checked="true"' : '') : ''}}>
							<label for="status">Tampilkan risalah</label>
							@error('icon')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="mb-4 {{isset($data) ? ($data->risalah_status == 1 ? '' : 'd-none') : ''}}" id="risalah-container">
							<label for="risalah">Risalah</label>
							<textarea type="text" id="risalah" name="risalah" class="form-control" placeholder="Risalah" required="">{{ isset($data) ? $data->risalah : old('risalah') }}</textarea>
							@error('risalah')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="foto">Icon</label>
							<input type="file" class="form-control" id="icon" placeholder="Foto" name="icon">
							@error('icon')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="foto">Foto Background</label>
							<input type="file" class="form-control" id="image" placeholder="Foto" name="image">
							@error('image')
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
		$('#risalah').summernote({
			tabsize: 2,
			height: 300
		});
		$('#status').change(function(e) {
			if($(e.target).prop('checked')) {
				$('#risalah-container').removeClass('d-none')
			}else{
				$('#risalah-container').addClass('d-none')
			}
		})
	});
</script>
@endsection
