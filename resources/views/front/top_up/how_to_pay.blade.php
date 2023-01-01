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
    <link rel="stylesheet" href="../../assets/css/campaign.css">

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
</style>
@endsection

@section('content')
<div id="navbar-top">
	<div class="navbar-simple-wrapper">
		<button class="btn-transparent">
			<a href="{{ auth()->check() ? url('top_up') : url('') }}" class="text-white">
				<img src="../../assets/img/icons/back-light.svg" alt="">
			</a>
		</button>
		<h4 class="navbar-wrapper-title">Isi Saldo Dompet</h4>
	</div>
</div>

<div class="screen">
	<div class="row">
		<div class="col-12">

			<div class="bg-white rounded p-4 mb-2 text-center">
				<h4 class="section-title text-center mt-3">Instruksi pembayaran</h4>
				<p class="instruction-text">Transfer sesuai nominal dibawah ini:</p>
				
				{{--@if($transaction->payment_method == 'QRIS')
					<div class="text-center">
						<img src="{{ $transaction->qr_url }}" class="img-fluid">
					</div>
					<hr>
				@endif--}}

				<div class="nominal">
					<h4 class="instruction-nominal">Rp{{ number_format($transaction->grand_total, 0, ',', '.') }}</h4>
					{{--<button type="button" id="btn-copy2" style="background: none; border: none;" class="btn-link text-primary font-weight-bold">Salin</button>--}}
				</div>
				{{--<p class="mb-3"><b>{{ $transaction->payment_method }}</b></p>--}}
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

				<h4 class="instruction-transfer-text">Pembayaran dilakukan ke rekening a/n <br><span>{{ $bank['username'] }} - Cibiru, bandung</span></h4>

				<div class="instruction-account-bar">
					<img src="{{ asset($bank['icon']) }}" alt="">
					
					<h4 class="instruction-account-number">{{ $bank['number'] }}</h4>
			
					<button class="btn-link" id="btn-copy">Salin</button>
				</div>
			
				{{--<div class="row mt-4">
					<div>
						<div class="form-group p-2" style="background: #f7f7f7; border-radius: 5px;">
							<div class="row align-items-center">
								<div class="col-3"><img class="img-fluid" src="{{ asset($bank['icon']) }}"></div>
								<div class="col-6"><b id="payment-number">{{ $transaction->pay_code }}</b>
									<p>{{ $transaction->payment_method }}</p>
								</div>
								<div class="col-3 text-right"><button id="btn-copy" class="btn btn-primary btn-sm">Salin</button></div>
							</div>
						</div>	
						<p class="mb-3 mt-4">Silahkan melakukan transfer sebelum <b class="text-primary">{{ $transaction->time_limit }} WIB</b>, atau donasi akan otomatis dibatalkan oleh sistem kami.</p>
					</div>
				</div>--}}

				<h4 class="instruction-time-limit">Transfer sebelum<span>{{ $transaction->time_limit }}</span> atau donasi kamu otomatis dibatalkan oleh sistem.</h4>

				<hr class="my-4">

				<button class="btn-cancel-topup">Batalkan Isi Saldo</button>
			
			</div>

				{{--@if(count($transaction->instructions) > 0)
					<div class="bg-white rounded p-4 mb-2">
						<h5 class="text-dark-grey">Cara Bayar</h5>
						<hr>
						@foreach($transaction->instructions as $k => $v)
						<b>{{ $v->title }}</b>
						<ol type="1" style="padding-left: 17px">
							@foreach($v->steps as $k2 => $v2)
							<li>{!! $v2 !!}</li>
							@endforeach
						</ol>
						<hr>
						@endforeach
					</div>
				@endif--}}
		
		</div>
	</div>
</div>

<nav class="footer-menu main-width">
	@if($transaction->status == 1)
	<div class="flex">
		<a href="{{ url('top_up/'.$transaction->id.'/proof') }}" id="btn-paid" class="btn btn-lg btn-accent btn-block">Saya Sudah Transfer</a>
	</div>
	@endif
</nav>

@endsection

@section('js')
<script type="text/javascript">

	$(document).ready(function(){
		$("#btn-copy").on("click", function(){
			var text ='{{ $bank['number'] }}';
			copyToClipboard(text);
		});
	});

</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="../../assets/js/global.js"></script>
<script src="../../assets/js/toast/toast.js"></script>
<script src="../../assets/js/instruksi.js"></script>
@endsection