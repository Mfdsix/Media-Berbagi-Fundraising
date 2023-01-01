@extends('layouts.dashboard')
@section('title', 'Data Bank')

@section('header', 'Data Bank')

@section('content')
<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/bank') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('admin/bank/'.$data->id) : url('admin/bank') }}">

			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="foto">Icon Bank</label>
							<input type="file" class="form-control" id="icon" placeholder="Foto" name="icon">
							@error('icon')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="bank_code">Kode Bank</label>
							<input type="text" class="form-control" id="bank_code" placeholder="Kode Bank" name="bank_code" required="" value="{{ isset($data) ? $data->bank_code : old('bank_code') }}">
							@error('bank_code')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="bank_name">Nama Bank</label>
							<input type="text" class="form-control" id="bank_name" placeholder="Nama Bank" name="bank_name" required="" value="{{ isset($data) ? $data->bank_name : old('bank_name') }}">
							@error('bank_name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="bank_username">Nama Pemilik Rekening</label>
							<input type="text" class="form-control" id="bank_username" placeholder="Nama Pemilik Rekening" name="bank_username" required="" value="{{ isset($data) ? $data->bank_username : old('bank_username') }}">
							@error('bank_username')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="bank_number">Nomor Rekening</label>
							<input type="text" class="form-control" id="bank_number" placeholder="Nomor Rekening" name="bank_number" required="" value="{{ isset($data) ? $data->bank_number : old('bank_number') }}">
							@error('bank_number')
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
@endsection
