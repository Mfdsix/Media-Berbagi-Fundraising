@extends('layouts.dashboard')
@section('title', 'Penggalangan Dana')

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

@section('header', "Penggalangan Dana")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/dashboard-program/campaign') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" action="{{ isset($data) ? url('dashboard-program/campaign/'.$data->id) : url('dashboard-program/campaign') }}" method="post">
			@csrf
			@if(isset($data))
			<input type="hidden" name="_method" value="PUT">
			@endif

			<div class="box-body p-4">
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
							<label for="slug">Slug (jika dikosongi akan digenerate otomatis)</label>
							<input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{ isset($data) ? $data->slug : old('slug') }}">
							@error('slug')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="category_id">Kategori</label>
							<select class="form-control" required="" name="category_id">
								<option value="">Pilih Kategori</option>
								@foreach($categories as $k => $v)
								<option @if(isset($data) && $data->category_id == $v->id) selected="" @endif value="{{ $v->id }}">{{ $v->category }}</option>
								@endforeach
							</select>
							@error('category_id')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" id="featured" placeholder="Foto" name="featured">
							<p class="text-danger">* ukuran yang disarankan (1280 x 722px)</p>
							@error('featured')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="content">Konten</label>
							<textarea id="content" name="content" required="" class="form-control"></textarea>
							@error('content')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="content">Program Unlimited</label>
							<p class="text-warning">* jika dicentang, target tanggal dan nominal tidak diisi</p>
							<p>
								<input value="unlimited" type="checkbox" name="unlimited" @if(isset($data) && $data->is_unlimited) checked @endif> Program Unlimited ?
							</p>
							@error('content')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="nominal_target">Target (Rp)</label>
							<input type="text" class="form-control rupiah" id="nominal_target" placeholder="Target" name="nominal_target" value="{{ isset($data) ? $data->nominal_target : old('nominal_target') }}">
							@error('nominal_target')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="date_target">Batas Waktu</label>
							<input type="text" class="form-control tanggalpicker" id="date_target" placeholder="Batas Waktu" name="date_target" value="{{ isset($data) ? $data->date_target : old('date_target') }}">
							@error('date_target')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="button_label">Label Tombol Donasi</label>
							<input type="text" class="form-control" id="button_label" placeholder="Donasi Sekarang" name="button_label" required="" value="{{ isset($data) ? $data->button_label : old('button_label') }}">
							@error('button_label')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="operational_percentage">Persentase Dana Operasional (dalam %)</label>
							<div class="input-group">
								<input type="number" min="0" max="100" class="form-control" id="operational_percentage" placeholder="Persentase Dana Operasional" name="operational_percentage" required="" value="{{ isset($data) ? $data->operational_percentage : old('operational_percentage') }}">
								<span class="input-group-text">%</span>
							</div>
							@error('operational_percentage')
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
		$("#content").html(`{{ isset($data) ? $data->content : old('content') }}`);
		$('#content').summernote({
			tabsize: 2,
			height: 300
		});
	});
</script>
@endsection
