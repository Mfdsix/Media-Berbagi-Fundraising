@extends('layouts.app')

@section('title', 'Cara Pembayaran')
@section('css')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/variable.css">
    <link rel="stylesheet" href="../../assets/css/instruksi.css">

    <title>Payment Page</title>
<style type="text/css">
    *:focus{
        border: none !important;
        outline: none !important;
    }
    .navbar a, .navbar h6{
        color: var(--white);
    }
    .nominal{
        position: relative;
    }
    .nominal button{
        position: absolute;
        top: 50%;
        right: 0;
        transform: translate(0, -50%);
    }
    #btn-copy{
		font-family: Inter;
		font-style: normal;
		font-weight: 600;
		font-size: 14px;
		line-height: 17px;
		border: none;
		color: var(--primary);
	}
    #btn-paid {
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

	.btn-paid:hover {
		background-color: var(--primary);
		color: white;
}
</style>
@endsection

@section('content')
<div id="navbar-top">
	<div class="navbar-simple-wrapper">
		<button class="btn-transparent">
			<a href="javascript:void(0)" onclick="goBack()" class="text-white">
				<img src="../../assets/img/icons/back-light.svg" alt="">
			</a>
		</button>
		<h4 class="navbar-wrapper-title">Qurban</h4>
	</div>
</div>

<div class="screen">
	<div class="row">
		<div class="col-12">

            <div class="bg-white rounded p-4 mb-2 text-center">
				<h4 class="section-title text-center mt-3">Instruksi pembayaran</h4>
				<p class="instruction-text">Transfer sesuai nominal dibawah ini:</p>

                <div class="nominal">
                    <h4 class="instruction-nominal">Rp {!! $transaction->nominal_formatted !!}</h4>
                </div>

                <div class="instruction-alert" style="font-size: 14px">
                    <b>PENTING!</b> Mohon transfer tepat sampai 3 angka terakhir agar donasi anda lebih mudah diverifikasi
                </div>
            
                <div class="transfer-detail-box">
                    <div class="transfer-detail-item">
                        <h4 class="transfer-detail-value">Jumlah Donasi</h4>
                        <h4 class="transfer-detail-value">Rp{!! $transaction->nominal_formatted !!}</h4>
                    </div>
                    <div class="transfer-detail-item">
                        <h4 class="transfer-detail-value">Kode Unik</h4>
                        <h4 class="transfer-detail-value">{{$unique_code}}</h4>
                    </div>
                </div>

                <hr class="my-4">

                <h4 class="instruction-transfer-text">Pembayaran dilakukan ke rekening a/n <br><span>{{ $payment->bank_username }} - Cibiru, bandung</span></h4>

                <div class="instruction-account-bar">
                    <img src="{{ asset('storage/'.$payment->path_icon) }}" alt="">
                    
                    <h4 class="instruction-account-number">{{ $payment->bank_number }}</h4>
            
                    <button class="btn-link" id="btn-copy">Salin</button>
                </div>        

                <h4 class="instruction-time-limit">Transfer sebelum <span>{{ $transaction->time_limit }}</span> atau donasi kamu otomatis dibatalkan oleh sistem.</h4>

				<hr class="my-4">

                <nav class="footer-menu main-width">
                    @if($transaction->status == 'pending')
                    <div class="flex">
                        <a href="{{ url('qurban/'.$transaction->id.'/proof') }}" id="btn-paid" class="btn btn-lg btn-accent btn-block">Saya Sudah Transfer</a>
                    </div>
                    @endif
                </nav>
			
			</div>
            
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $("#btn-copy").on("click", function(){
            var text ='{{ $payment->bank_number }}';
            copyToClipboard(text);
        });
    });
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
  fbq('track', 'AddPaymentInfo');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=290436735690454&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<script src="../../assets/js/global.js"></script>
@endsection