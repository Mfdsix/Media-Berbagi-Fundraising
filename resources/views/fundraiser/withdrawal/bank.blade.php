@extends('layouts.dashboard')
@section('title', 'Data Bank')

@section('header', 'Data Bank')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Data Bank</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Atur rekening untuk penarikan dana</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post">
			<div class="box-body">
				<div class="row">
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="bank_account_name">Nama Bank</label>
							<input type="text" class="form-control" id="bank_account_name" placeholder="Nama Bank" name="bank_account_name" required="" value="{{ isset($data) ? $data->bank_account_name : old('bank_account_name') }}">
							@error('bank_account_name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="mb-4">
							<label for="bank_account_number">Nomor Rekening</label>
                            <input type="text" class="form-control" id="bank_account_number" placeholder="Nomor Rekening" name="bank_account_number" required="" value="{{ isset($data) ? $data->bank_account_number : old('bank_account_number') }}">
							@error('bank_account_number')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
                        <div class="mb-4">
							<label for="bank_account_code">Kode Bank</label>
                            <input type="text" class="form-control" id="bank_account_code" placeholder="Kode Bank" name="bank_account_code" required="" value="{{ isset($data) ? $data->bank_account_code : old('bank_account_code') }}">
							@error('bank_account_code')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>
				</div>
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>

@endsection
