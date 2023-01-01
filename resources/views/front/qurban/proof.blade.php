@extends('layouts.app')

@section('title', 'Detail Donasi')
@section('css')
<style type="text/css">
	.navbar a, .navbar h6{
		color: var(--white);
	}
</style>
@endsection

@section('content')
<nav class="navbar bg-primary fixed-top">
	<div class="main-width">
		<div class="flex max-width main-navbar p-3" style="justify-content: flex-start;">
			<a href="javascript:void(0)" onclick="goBack()">
				<i class="fas fa-arrow-left"></i>
			</a>
			<h6 class="ml-3 mb-0">Detail Donasi</h6>
		</div>
	</div>
</nav>

<div class="main-width">
	<div class="body-section">

		<div class="bg-white rounded p-4 mb-2">
			
			<div class="text-center mb-4">
				<h5 class="text-dark-grey">Bukti Pembayaran</h5>
				<p class="mb-3">upload bukti pembayaran</p>
			</div>
			<div class="border rounded p-4 mb-4">
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
					<div class="col-7 text-right font-weight-bold"><img src="{{ asset($payment['icon']) }}" height="30"> {{ $payment['name'] }}</div>
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
						<input type="file" name="file" required="" class="form-control">
					</div>
					<button class="btn btn-primary btn-block">Kirim Bukti Pembayaran</button>
				</form>
			</div>

		</div>

	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	function goBack(){
		window.history.back();
	}
</script>
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
  fbq('init', '290436735690454');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=290436735690454&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endsection