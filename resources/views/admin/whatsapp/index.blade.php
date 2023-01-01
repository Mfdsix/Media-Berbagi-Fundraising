@extends('layouts.dashboard')
@section('title', 'Whatsapp Setting')

@section('header', "Whatsapp Setting")

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
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Whatsapp Setting</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Atur integrasi ruangwa</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/whatsapp') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">

                    <h5>System whatsapp gateway ini hanya bekerja dan terintegrasi pada <a href="https://goowa.id" class="text-warning">GOOWA</a></h5>
                    <br><br>
					
                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="token">Masukan Token</label>
							<input type="text" name="token" value="{{$config->RUANGWA_TOKEN}}" class="form-control" placeholder="xxxxxxxx">
							@error('token')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div><br>

						@if ($status)
							<div class="alert alert-success">Connected</div>
						@else
							<div class="alert alert-warning">Not Connected</div>
						@endif
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
