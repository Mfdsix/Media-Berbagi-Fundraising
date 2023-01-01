@extends('layouts.dashboard')
@section('title', 'Notifikasi')

@section('header', "Notifikasi")

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
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Notifikasi Whatsapp</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kustom notifikasi whatsapp</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" action="{{ url('admin/notification') }}" method="post">
			@csrf

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">

						<div class="box bg-warning mb-4">! Mohon untuk menggunakan anotasi <b><<{key}>></b> seperti disediakan di template awal, agar pesan terbaca sistem sebagai field dinamis yang akan didapatkan dari database.</div>

						<div class="mb-4 mt-4">
							<label for="donation_reminder">Pengingat Donasi</label>
							<textarea class="form-control" name="donation_reminder" required="">{{ isset($data['donation_reminder']) ? $data['donation_reminder'] : old('donation_reminder') }}</textarea>
							@error('donation_reminder')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="donation_thanks">Donasi Berhasil</label>
							<textarea class="form-control" name="donation_thanks" required="">{{ isset($data['donation_thanks']) ? $data['donation_thanks'] : old('donation_thanks') }}</textarea>
							@error('donation_thanks')
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
