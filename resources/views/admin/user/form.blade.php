@extends('layouts.dashboard')
@section('title', 'Kelola User')

@section('header', 'Kelola User')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
            <div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/user') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('admin/user/' . $data->id) : url('admin/user') }}">

			<div class="box-body">
				<div class="row">

					@csrf

                    @if(isset($data))
                    <input type="hidden" name="_method" value="PUT">
                    @endif

					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="name">Username</label>
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

                        @if(!isset($data))
                        <div class="mb-4">
							<label for="level">Tipe User</label>
							<select name="level" id="level" required class="form-control">
                                <option value="admin">Admin</option>
                                <option value="program">Program</option>
                                <option value="accounting">Akunting</option>
                                <option value="gerai">Gerai</option>
                            </select>
							@error('level')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						@else
						<div class="mb-4">
							<label>Tipe User</label>
							<h3>{{ $data->level }}</h3>
						</div>
                        @endif
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
