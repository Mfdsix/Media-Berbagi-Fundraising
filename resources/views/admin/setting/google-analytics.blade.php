@extends('layouts.dashboard')
@section('title', 'Google Analytics')

@section('header', "Google Analytics")

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
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Google Analytics</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">tambahkan google analytics ke website anda</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/google-analytics') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">
                        <!-- <div>
                            <i>* cara mendapatkan google analytics tracking id</i>
                            <img src="{{ asset('/assets/img/ga.png') }}" style="width: 80%; height: auto">
                        </div>
                        <br> -->
						<div class="mb-4 mt-4">
							<label for="value">ID Pelacakan (Tracking ID)</label>
							<input type="text" name="value" placeholder="UA-XXXXXX" value="{{ $data->google_analytics }}" class="form-control">
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
