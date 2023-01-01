@extends('layouts.dashboard')
@section('title', 'Google Font')

@section('header', "Google Font")

@section('css')
<style>
	textarea{
		height: 150px;
		white-space: pre-wrap;
	}
</style>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Google Font</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kustom font yang anda gunakan di website dengan google font</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/google-font') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="mb-4 mt-4">
							<label for="value">Kode Google Font</label>
							<textarea class="form-control" name="value" id="value" cols="30" rows="8">{{ $data->font ?? '<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: Inter, Roboto, sans-serif;
        }
    </style>' }}</textarea>
							@error('value')
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
@endsection
