@extends('layouts.dashboard')
@section('title', 'Profil Saya')

@section('header', 'Profil Saya')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Profil Saya</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">update profil berkala untuk keamanan akun anda</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post">

			<div class="box-body">
				<div class="row">

					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="name">Nama</label>
							<input type="text" class="form-control" id="name" placeholder="Nama" name="name" required="" value="{{ isset($data) ? $data->name : old('name') }}">
							@error('name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="email">Alamat Email</label>
							<input type="email" class="form-control" id="email" placeholder="Alamat Email" name="email" value="{{ isset($data) ? $data->email : old('email') }}">
							@error('email')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						<div class="mb-4">
							<label for="password">Password</label>
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
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
				</div>
			</div>

		</form>
	</div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
</script>
@endsection
