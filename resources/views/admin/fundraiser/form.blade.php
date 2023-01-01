@extends('layouts.dashboard')
@section('title', 'Penggalang Dana')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: #1a2035!important;
	}
</style>
@endsection

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">Penggalang Dana</h2>
	<h5 class="text-white op-7 mb-2">Penggalang Dana</h5>
</div>
<div class="ml-md-auto py-2 py-md-0">
</div>
@endsection

@section('content')
<div class="row mt--2">
	<div class="col-md-12">
		<form class="card" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('admin/fundraiser/'.$data->id) : url('admin/fundraiser') }}">
			<div class="card-header">
				<div class="card-title">Penggalang Dana</div>
			</div>
			<div class="card-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="form-group">
							<label for="fullname">Nama Penggalang Dana</label>
							<input type="text" class="form-control" id="fullname" placeholder="Nama Penggalang Dana" name="fullname" required="" value="{{ isset($data) ? $data->fullname : old('fullname') }}">
							@error('fullname')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="foto">Foto Profil</label>
							<input type="file" class="form-control" id="foto" placeholder="Foto Profil" name="foto">
							@error('foto')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="foto">Deskripsi</label>
							<textarea class="form-control samenot" name="description">{{ isset($data) ? $data->description : old('description') }}</textarea>
							@error('description')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>	

						<div class="form-group">
							<label for="foto">Alamat</label>
							<textarea class="form-control" name="address" placeholder="Alamat">{{ isset($data) ? $data->address : old('address') }}</textarea>
							@error('foto')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>	

						<hr>
						<div class="form-group">
							<h5>Informasi Bank (boleh dikosongkan sementara)</h5>
						</div>

						<div class="form-group">
							<label for="bank_name">Nama Bank</label>
							<input type="text" class="form-control" id="bank_name" placeholder="Nama Bank (contoh: BNI)" name="bank_name" value="{{ isset($data) ? $data->bank_name : old('bank_name') }}">
							@error('bank_name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="bank_account">Nomor Rekening</label>
							<input type="text" class="form-control" id="bank_account" placeholder="Nomor Rekening" name="bank_account" value="{{ isset($data) ? $data->bank_account : old('bank_account') }}">
							@error('bank_account')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="form-group">
							<label for="bank_username">Nama Pemilik Rekening</label>
							<input type="text" class="form-control" id="bank_username" placeholder="Nama Pemilik Rekening" value="{{ isset($data) ? $data->bank_username : old('bank_username') }}" name="bank_username">
							@error('bank_username')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<hr>
						<div class="form-group">
							<h5>Informasi Akun (untuk login sebagai penggalang dana)</h5>
						</div>
						<div class="form-group">
							<label for="bank_account">Alamat Email</label>
							<input type="email" class="form-control" id="email" placeholder="Alamat Email" name="email" value="{{ isset($data) ? $data->email : old('email') }}">
							@error('email')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="form-group">
							<label for="bank_account">Password</label>
							@if(isset($data))
							<span class="text-warning font-weight-bold">* silahkan diisi jika ingin mengganti password</span>
							@endif
							<input type="password" class="form-control" id="password" placeholder="Password" name="password" value="">
							@error('password')
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
		</form>
	</div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.samenot').summernote({
			tabsize: 2,
			height: 200
		});
	});
</script>
@endsection