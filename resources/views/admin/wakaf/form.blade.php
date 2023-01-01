@extends('layouts.dashboard')
@section('title', 'Program Zakat')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.css">
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: var(--main-color) !important;
		color: #fff !important;
	}
	.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
	transform:scale(0.8);
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endsection

@section('header', "Program Wakaf")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/wakaf') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/wakaf/'.$data->id) : url('admin/wakaf') }}" method="post">
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

						@php $instant = isset($data) ? ($data->id == 0 ? true : false) : false @endphp

						@if(!$instant)
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
						@endif

						<div class="mb-4">
							<label for="foto">Foto</label>
							<p class="text-warning">campaign image recommendation 600x900px</p>
							<input type="file" class="form-control hidden_input" id="featured" placeholder="Foto" name="featured" onchange="loadFile(event)">
							<div class="btn btn-secondary" onclick="UploadModal()">Upload Foto</div>
							@error('featured')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="content">Konten</label>
							<textarea id="content" class="form-control" name="content" required=""></textarea>
							@error('content')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						@if(!$instant)
						<div class="mb-4">
							<label for="content">Satuan / Unit</label>
							<input type="text" class="form-control" id="wakaf_unit" placeholder="misal: m2, m, kg, dll" name="wakaf_unit" value="{{ isset($data) ? $data->wakaf_unit : old('wakaf_unit') }}">
							@error('wakaf_unit')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="wakaf_price">Harga per Unit</label>
							<input type="text" class="form-control rupiah" id="wakaf_price" placeholder="Harga per Unit" name="wakaf_price" value="{{ isset($data) ? $data->wakaf_price : old('wakaf_price') }}">
							@error('wakaf_price')
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
							<label for="nominal_target">Target (dalam satuan unit)</label>
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
						@endif

						<div class="mb-4">
							<label for="button_label">Label Tombol Donasi</label>
							<input type="text" class="form-control" id="button_label" placeholder="Wakaf Sekarang" name="button_label" required="" value="{{ isset($data) ? $data->button_label : old('button_label') }}">
							@error('button_label')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="operational_percentage">Persentase Dana Operasional (dalam %)</label>
							<div class="input-group">
								<input type="number" min="0" max="100" class="form-control" id="operational_percentage" placeholder="Persentase Dana Operasional" name="operational_percentage" required="" value="{{ isset($data) ? $data->operational_percentage : old('operational_percentage') }}">
							</div>
							@error('operational_percentage')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="fundraiser_reward">Persentase Untuk Reward Fundraiser (dalam %)</label> <a href="javascript:void(0)" title="biaya akan di hitung dari total nominal donatur yang diajak fundraiser, default 1%" class="bg-secondary bg-opacity-75 rounded-pill"><i class="bx bx-question-mark"></i></a>
							<div class="input-group">
								<input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="0.1" min="0" max="100" class="form-control" id="fundraiser_reward" placeholder="Persentasel Reward Fundraiser" name="fundraiser_reward" required="" value="{{ isset($data) ? $data->fundraiser_reward : old('fundraiser_reward') }}">
								<span class="input-group-text">%</span>
							</div>
							@error('fundraiser_reward')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<a href="javascrip:void(0)" class="btn-link mb-4" onclick="$('#cusnom').toggleClass('d-none')">Custom Nominal</a>

						{{-- custom nominal --}}
						<div class="mb-4 d-none" id="cusnom">
							<label for="custom_nominal">Nominal Custom (optional)</label>

							@if(isset($data))
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 1" name="custom_nominal[]" value="{{ $data->custom_nominal[0] }}">
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 2" name="custom_nominal[]" value="{{ $data->custom_nominal[1] }}">
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 3" name="custom_nominal[]" value="{{ $data->custom_nominal[2] }}">
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 4" name="custom_nominal[]" value="{{ $data->custom_nominal[3] }}">
							@else
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 1" name="custom_nominal[]" value="100000">
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 2" name="custom_nominal[]" value="200000">
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 3" name="custom_nominal[]" value="300000">
							<input type="number" min="0" class="form-control mb-2" id="custom_nominal" placeholder="Nominal Custom 4" name="custom_nominal[]" value="400000">
							@endif

							@error('custom_nominal')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						
					</div>
				</div>
				<div class="gr-btn text-end">

					<div class="d-flex align-items-center justify-content-end">
						
						@if(!$instant)
						<div class="mr-8 pr-8">
							<div>Tampil Program</div>
							<div class="text-muted">*Jika tidak di check program tidak akan tampil</div>
						</div>
						<label class="switch mr-8">
							<input type="checkbox" name="is_hidden" @if(isset($data)) {{$data->is_hidden == 0 ? 'checked' : ''}} @else checked @endif >
							<span class="slider round"></span>
						</label>

						@else
						
						<div class="mr-8 pr-8">
							<div>Tampil Program</div>
							<div class="text-muted">*Jika tidak di check program tidak akan tampil</div>
						</div>

							@if($data->is_hidden == 0)
							<label class="switch mr-8">
								<input type="checkbox" onchange="$('#status-form').submit()" >
								<span class="slider round"></span>
							</label>
							@else
							<label class="switch mr-8">
								<input type="checkbox" onchange="$('#status-form').submit()" checked >
								<span class="slider round"></span>
							</label>
							@endif

						@endif

						<button type="submit" class="btn btn-primary btn-lg fs-16">SIMPAN</button>
					</div>

				</div>
			</div>
		</form>
		<form method="POST" id="status-form" action="{{ url('admin/instant-program/wakaf/switch' ) }}">
			@csrf
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload Dokumen</h5>
        <span onclick="closeModal()" class="btn"><h3>&times;</h3></span>
      </div>
	  	<div class="modal-body">
			<div class="position-relative uploader-wrap" onclick="Preview()" ondrop="dropHandler(event);" ondragover="dragOverHandler(event);">
				<div class="uploader-image text-primary text-center">
					<p>Click to Select Image</p>
					<p>or</p>
					<p>drop here</p>
				</div>
			</div> 
		</div>
		<img alt="" class="img-fluid d-none" id="preview">
		<div class="modal-footer">
			<a href="javascript:void(0)" class="btn btn-primary" onclick="saveImage()">Simpan</a>
		</div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/2.0.0-alpha.2/cropper.min.js"></script>
<script src="{{ asset('assets/media-berbagi/styles/js/cropper.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#content").html(`{{ isset($data) ? $data->content : old('content') }}`);
		$('#content').summernote({
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
            $('#content').summernote("insertNode", image[0]);
		}
		});
	}
</script>
@endsection
