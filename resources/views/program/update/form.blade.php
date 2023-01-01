@extends('layouts.dashboard')
@section('title', 'Update Laporan')

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

@section('header', "Update Laporan")

@section('content')
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/dashboard-program/update') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('dashboard-program/update/'.$data->id) : url('dashboard-program/update') }}">
			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="content">Projek</label>
							<select @if(isset($data)) readonly @endif class="form-control" name="project_id" required="">
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
		$('.saminote').summernote({
			tabsize: 2,
        	height: 300
		});
	});
</script>
@endsection
