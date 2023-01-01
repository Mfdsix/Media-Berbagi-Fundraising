@extends('layouts.app')

@section('title', 'Detail Donasi')
@section('css')
<style type="text/css">
	.navbar a, .navbar h6{
		color: var(--white);
	}
	.btn-donasi-lagi {
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

.btn-donasi-lagi:hover {
    background-color: var(--primary);
    color: white;
}
</style>
@endsection

@section('content')
<nav class="navbar bg-primary fixed-top">
	<div class="main-width">
		<div class="flex max-width main-navbar p-3" style="justify-content: flex-start;">
			<a href="{{ auth()->check() ? url('donation') : url('') }}">
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
				@if($data->status == 'pending')
				<h5 class="text-dark-grey">Tinggal Sedikit Lagi!</h5>
				<p class="mb-3">Lakukan pembayaran untuk melanjutkan donasi</p>
				@elseif($data->status == 'paid')
				<h5 class="text-dark-grey">Terima Kasih!</h5>
				<p>Donasi telah kami terima dan akan kami salurkan</p>
				@elseif($data->status == 'canceled')
				<h5 class="text-dark-grey">Donasi Dibatalkan</h5>
				<p>Batas waktu pembayaran telah berakhir atau donasi gagal tercatat di sistem</p>
				@elseif($data->status == 'waiting')
				<h5 class="text-dark-grey">Bukti Terkirim</h5>
				<p>Bukti pembayaran telah dikirim dan sedang kami verifikasi</p>
				@endif
			</div>
			<div class="border rounded p-4 mb-4">
				<div class="row">
					<div class="col-5">Nominal</div>
					<div class="col-7 text-right font-weight-bold">{{ $data->nominal }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">Tanggal</div>
					<div class="col-7 text-right font-weight-bold">{{ $data->date }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">Metode Pembayaran</div>
					<div class="col-7 text-right font-weight-bold">{{ $data->payment_method }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">ID Donasi</div>
					<div class="col-7 text-right font-weight-bold">#{{ $data->transaction_id }}</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-5">Status</div>
					<div class="col-7 text-right font-weight-bold">
						@if($data->status == 'canceled')
						<span class="text-danger">Dibatalkan</span>
						@elseif($data->status == 'pending')
						<span class="text-default">Menunggu</span>
						@elseif($data->status == 'waiting')
						<span class="text-primary">Menunggu Verifikasi</span>
						@elseif($data->status == 'rejected')
						<span class="text-danger">Bukti Ditolak</span>
						@elseif($data->status == 'paid')
						<span class="text-primary">Berhasil</span>
						@endif
					</div>
				</div>
			</div>
			<a href="/" class="btn-donasi-lagi">Donasi Lagi</a>
		</div>

	</div>
</div>

@if($data->status == 'pending')
<nav class="footer-menu main-width">
	<div class="flex">
		<a href="{{ url('payment/337/how_to_pay') }}" class="btn btn-primary btn-block">Instruksi Pembayaran</a>
	</div>
</nav>
@endif

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
  fbq('track', 'Purchase', {currency: "IDR", value: {{$data->nominal}}});
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=290436735690454&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endsection