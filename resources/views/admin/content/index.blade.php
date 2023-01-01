@extends('layouts.dashboard')
@section('title', 'Konten')

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

@section('header', "Konten")

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Konten Website</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">isi konten website untuk dibaca donatur</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/content') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">

						<div class="mb-4">
							<label for="about_us">Tentang Kami</label>
							<textarea class="samernot" name="about_us" required="">{{ isset($about_us) ? $about_us : old('about_us') }}</textarea>
							@error('about_us')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="term_condition">Syarat & Ketentuan</label>
							<textarea class="samernot" name="term_condition" required="">{{ isset($term_condition) ? $term_condition : old('term_condition') }}</textarea>
							@error('term_condition')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="help">Bantuan</label>
							<textarea class="samernot" name="help" required="">{{ isset($help) ? $help : old('help') }}</textarea>
							@error('help')
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
        	height: 300
		});
	});
</script>
@endsection
