@extends('layouts.dashboard')
@section('title', 'MediaBerbagi Setting')

@section('header', "MediaBerbagi Setting")

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
						<h5 class="card-title text-white fs-30 font-w500 mt-4">MediaBerbagi Setting</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Atur MediaBerbagi server anda</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/mediaberbagi') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">
					
                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="host">MediaBerbagi Host</label>
							<input type="text" name="host" value="{{$config->MB_HOST}}" class="form-control" {{$config->MB_HOST != null ? "disabled" : ""}}>
							@error('host')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
					</div>

                    <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="key">MediaBerbagi Access Key</label>
							<input type="text" name="key" value="{{$config->MB_ACCESS_KEY}}" class="form-control" {{$config->MB_ACCESS_KEY != null ? "disabled" : ""}}>
							@error('key')
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
