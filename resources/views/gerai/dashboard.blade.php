@extends('layouts.dashboard')

@section('title', 'Dashboard')
@section('css')
@endsection

@section('header', "Dashboard")

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-manage">
			<div class="box-body d-flex pd-7 pb-0">
				<div class="me-auto w-55">
					<h5 class="card-title text-white fs-30 font-w500 mt-4">Selamat Datang</h5>
					<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Silahkan menggunakan menu disamping untuk memulai</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="box p-2rem">
			<h3>Statistik</h3>
			<div class="row">
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Total Transaksi</h5>
					<p class="mb-0 pt-4">{{ $transaction }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Donatur</h5>
					<p class="mb-0 pt-4">{{ $donatur }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
