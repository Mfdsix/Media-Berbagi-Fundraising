@extends('layouts.mb-app')

@section('title', 'Detail Donasi')
@section('css')
<!-- <link rel="stylesheet" href="/assets/css/instruksi.css"> -->
<style type="text/css">
	.navbar a, .navbar h6{
		color: var(--white);
	}
	#btn-proof {
		font-family: Inter;
		font-style: normal;
		font-weight: 600;
		font-size: 16px;
		line-height: 19px;
		text-align: center;
		color: var(--primary);
		border: 1px solid var(--primary);
		box-sizing: border-box;
		border-radius: 13px;
		display: flex;
		justify-content: center;
		align-items: center;
		height: 52px;
	}
	#btn-proof:hover {
		background-color: var(--primary);
		color: white;
	}
	#detail-form{
		border-radius: 13px;
	}
</style>
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Detail Donasi'])

<div class="screen">
	<div class="row">
		<div class="col-12">

		<div class="bg-white rounded p-4 mb-2" style="min-height:100vh">
			
			<div class="text-center mb-4">
				<h4 class="section-title text-center mt-3">Bukti Pembayaran</h4>
				<p class="instruction-text">Upload Bukti Pembayaran</p>
			</div>
			<div class="border p-4 mb-4" id="detail-form">
				<div class="row">
					<div class="col-5">Total</div>
					<div class="col-7 text-right font-weight-bold">Rp{{ number_format($data->total, 0, ',', '.') }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">Batas Tanggal</div>
					<div class="col-7 text-right font-weight-bold">{{ $data->time_limit }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">Metode Pembayaran</div>
					<div class="col-7 text-right font-weight-bold"><img src="{{ asset($payment['icon']) }}" height="30"></div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">Status</div>
					<div class="col-7 text-right font-weight-bold">
						@if($data->status == 'canceled')
						<span class="label label-danger">Dibatalkan</span>
						@elseif($data->status == 'pending')
						<span class="label label-default">Belum Bayar</span>
						@elseif($data->status == 'paid')
						<span class="label label-primary">Berhasil</span>
						@elseif($data->status == 'rejected')
						<span class="label label-default">Ditolak</span>
						@elseif($data->status == 'waiting')
						<span class="label label-default">Menunggu</span>
						@endif
					</div>
				</div>
			</div>

			<div class="mb-4">
				<form method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Bukti Pembayaran</label>
						<input type="file" name="file" required="" accept="image/*" class="form-control p-2">
					</div>
					<button class="btn btn-proof btn-block" id="btn-proof">Kirim Bukti Pembayaran</button>
				</form>
			</div>

		</div>

		</div>
	</div>
</div>
@endsection

@section('js')
@if($web_set->facebook_pixel != null)
<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '{{ $web_set->facebook_pixel }}');
	fbq('track', 'InitiateCheckout');
</script>
<noscript><img loading="lazy" height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $web_set->facebook_pixel }}&ev=InitiateCheckout&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endif 
<script src="../../assets/js/global.js"></script>
@endsection