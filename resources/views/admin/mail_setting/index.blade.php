@extends('layouts.dashboard')
@section('title', 'Mail Setting')

@section('header', "Mail Setting")

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
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Mail Setting</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Atur mail server anda</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/mail_setting') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">

					<div class="col-md-12 col-lg-12">
						<div class="">
							<label for="host">Mail Mailer</label>
							<input type="text" name="mailer" value="{{$config->MAIL_MAILER ?? 'mail'}}" class="form-control">
							@error('mailer')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>
					
                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="host">Mail Host</label>
							<input type="text" name="host" value="{{$config->MAIL_HOST}}" class="form-control">
							@error('host')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="port">Mail Port</label>
							<input type="text" name="port" value="{{$config->MAIL_PORT}}" class="form-control">
							@error('port')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="user">Mail Username</label>
							<input type="text" name="user" value="{{$config->MAIL_USERNAME}}" class="form-control">
							@error('user')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="pass">Mail Password</label>
							<input type="text" name="pass" value="{{$config->MAIL_PASSWORD}}" class="form-control">
							@error('pass')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="enc">Mail Encryption</label>
							<input type="text" name="enc" value="{{$config->MAIL_ENCRYPTION}}" class="form-control">
							@error('enc')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="address">Mail From Address</label>
							<input type="text" name="address" value="{{$config->MAIL_FROM_ADDRESS}}" class="form-control">
							@error('address')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="from">Mail From Name</label>
							<input type="text" name="from" value="{{$config->MAIL_FROM_NAME}}" class="form-control">
							@error('from')
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
