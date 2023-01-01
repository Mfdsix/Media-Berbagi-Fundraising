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
	<div class="col-md-7">
		<div class="box">
			<div class="box-body">
				<h3>Link Kamu</h3>
				<div class="input-group">
					<input id="referral-link" type="text" class="form-control" value="{{ request()->getSchemeAndHttpHost().'?r=' . $fundraiser->referral_code }}">
					<span onclick="copyLink()" class="input-group-text bg-primary text-white" id="copy-link">COPY</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<div class="box p-2rem">
			<div class="row">
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Klik Link</h5>
					<p class="mb-0 pt-4">{{ number_format($fundraiser->clicks, 0, null, '.') }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Transaksi</h5>
					<p class="mb-0 pt-4">{{ number_format($fundraiser->transaction, 0, null, '.') }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 bb">
					<h5 class="title-box">Transaksi Berhasil</h5>
					<p class="mb-0 pt-4">{{ number_format($fundraiser->success_transaction, 0, null, '.') }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Total Dana Online</h5>
					<p class="mb-0 pt-4">{{ number_format($online, 0, null, '.') }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Total Dana Offline</h5>
					<p class="mb-0 pt-4">{{ number_format($offline, 0, null, '.') }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Total Dana</h5>
					<p class="mb-0 pt-4">{{ number_format($offline+$online, 0, null, '.') }}</p>
				</div>
				<div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
					<h5 class="title-box">Komisi</h5>
					<p class="mb-0 pt-4">{{ number_format($fundraiser->commissions, 0, null, '.') }}</p>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script>
	function copyLink() {
		var copyText = document.getElementById("referral-link");

		copyText.select();
		copyText.setSelectionRange(0, 99999);
		navigator.clipboard.writeText(copyText.value);
	}
</script>
@endsection
