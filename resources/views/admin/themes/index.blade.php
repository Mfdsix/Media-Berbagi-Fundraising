@extends('layouts.dashboard')
@section('title', 'Theme Setting')

@section('header', "Theme Setting")

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
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Theme Setting</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Select Theme</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <b>Theme Uploaded</b>
                <div class="row">

                    @foreach($themes as $theme)
                    <div class="col-md-3">
                        <img src="{{ $theme->image }}" alt="" class="w-100 img-thumbnail mb-4">
                        <p>{{$theme->name}}<br/>
                            version {{$theme->version}}<br/>
                            @if($theme->active)
                                <a href="?theme={{$theme->path}}&action=nonactive" class="btn btn-warning">Non active</a>
                            @else
                                <a href="?theme={{$theme->path}}&action=active" class="btn btn-primary">Active</a>
                            @endif
                            <a href="?theme={{$theme->path}}&action=delete" class="btn btn-danger">Delete</a>
                        </p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/themes') }}" method="post" enctype="multipart/form-data">
			@csrf

			<div class="box-body">
				<div class="row">

                <div class="p-4">
                    {{-- show session message error --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- show session message success --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{--show error--}}
                @if (isset($error))
                    <div class="alert alert-danger">
                       {{$error}}
                    </div>
                @endif
                </div>

                <div class="col-md-12 col-lg-12">
						<div class="">
							<label for="file">Upload File Theme(zip)</label>
							<input type="file" name="file" class="form-control">
							@error('file')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div><br>
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
