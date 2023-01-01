@extends('layouts.app')

@section('title', 'Konfirmasi Donasi')
@section('css')
<style type="text/css">
	.navbar a, .navbar h6{
		color: var(--white);
	}
	.portfolio-item:hover{
		background: #f7f7f7;
	}
	.text-muted{
		font-size: 14px;
	}
	.nominal-item:hover .card, .nominal-item.active .card{
		cursor: pointer;
		border: 1px solid var(--primary);
	}
	.nominal-item:hover .text-muted, .nominal-item.active .text-muted{
		background: rgb(231, 245, 255);
	}
	.nominal-item h6{
		margin-bottom: 0;
	}
	.input-group-text{
		background: transparent;
		border: none;
		color: #000;
		font-size: 18px;
		font-weight: bold;
	}
	.input-group{
		padding: 10px;
		border-radius: 5px;
		background: #f7f7f7 !important;
	}
	.input-group .form-control{
		background: transparent;
		border: none !important;
		text-align: right;
		font-weight: bold;
		font-size: 20px;
	}
	.input-group .form-control:focus{
		outline: none !important;
		border: none !important !important;
		-webkit-box-shadow: none !important;
		-moz-box-shadow: none !important;
		box-shadow: none !important;
	}
	.text-muted{
		background: #f7f7f7;
		padding: 5px;
		color: var(--darkgrey) !important;
		margin-top: 10px;
		margin-bottom: 0;
	}

	.switch {
		position: relative;
		display: inline-block;
		width: 50px;
		height: 27px;
	}

	.switch input { 
		opacity: 0;
		width: 0;
		height: 0;
	}

	.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.slider:before {
		position: absolute;
		content: "";
		height: 25px;
		width: 23px;
		left: 2px;
		bottom: 2px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
	}

	.switch input:checked + .slider {
		background-color: var(--primary);
	}

	.switch input:focus + .slider {
		box-shadow: 0 0 1px var(--primary);
	}

	.switch input:checked + .slider:before {
		-webkit-transform: translateX(24px);
		-ms-transform: translateX(24px);
		transform: translateX(24px);
	}

	/* Rounded sliders */
	.slider.round {
		border-radius: 27px;
	}

	.slider.round:before {
		border-radius: 50%;
	}
</style>
@endsection

@section('content')
<nav class="navbar bg-danger fixed-top">
	<div class="main-width">
		<div class="flex max-width main-navbar p-3" style="justify-content: flex-start;">
			<a href="javascript:void(0)" onclick="goBack()">
				<i class="fas fa-arrow-left"></i>
			</a>
			<h6 class="ml-3 mb-0">Konfirmasi Donasi</h6>
		</div>
	</div>
</nav>

<div class="main-width">
	<div class="body-section">
		
		<form method="post" id="form-confirm" action="{{ url()->current() }}" class="bg-white rounded p-4 mb-2">
			@csrf
			<h6 class="text-dark-grey mb-3">Masukan Nominal Donasi</h6>

			<div class="input-group mb-3 mt-4">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">Rp</span>
				</div>
				<input type="text" name="nominal" class="form-control rupiah" placeholder="0" aria-label="Username" aria-describedby="basic-addon1" value="{{ $nominal }}">
			</div>
			@error('nominal')
			<span class="text-danger">{{ $message }}</span>
			@enderror
			<hr>
			<div class="form-group">
				<input type="hidden" name="payment" value="{{ session('payment_code') }}">
				<div class="row align-items-center">
					<div class="col-2"><img class="img-fluid" src="{{ asset($payment['icon']) }}"></div>
					<div class="col-7"><b>{{ $payment['payment_method'] }}</b></div>
					<div class="col-3 text-right"><a href="{{ url('project/'.$project->id.'/payment') }}" class="btn btn-primary btn-sm btn-rounded">Ganti <i class="fas fa-chevron-down"></i></a></div>
				</div>
			</div>
			<hr>
			@if(auth()->check())
			<div class="form-group">
				<input class="form-control" type="text" name="donature_name" value="{{ auth()->user()->name }}" readonly="">
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="donature_email" value="{{ auth()->user()->email }}" readonly="">
			</div>
			@else
			<p class="text-center mt-4"><a href="{{ url('login?t='.base64_encode(url()->current())) }}">Masuk</a> atau lengkapi data dibawah ini</p>
			<div class="form-group">
				<input class="form-control" type="text" name="donature_name" value="" required="" placeholder="Nama Lengkap">
				@error('donature_name')
				<span class="text-danger font-weight-bold">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<input class="form-control" type="text" name="donature_phone" value="" @if(session('payment_code') == 'QRIS') required="" @endif placeholder="Nomor Ponsel (wajib untuk metode QRIS)">
				@error('donature_phone')
				<span class="text-danger font-weight-bold">{{ $message }}</span>
				@enderror
			</div>
		
			@endif
				<div class="form-group">
				<input class="form-control" type="text" name="donature_email" value="" required="" placeholder="Email">
				@error('donature_email')
				<span class="text-danger font-weight-bold">{{ $message }}</span>
				@enderror
			</div>
			<hr>
			<div class="form-group">
				<div class="row">
					<div class="col-9">
						<p class="mb-0">Sembunyikan Nama Saya</p>
						<span style="font-size: 12px">* donasi sebagai Hamba Allah</span>
					</div>
					<div class="col-3">
						<label class="switch">
							<input type="checkbox" name="is_anonymous" value="1">
							<span class="slider round"></span>
						</label>
					</div>
				</div>	
			</div>
			<div class="form-group">
				<label>Berikan doa atau dukungan (opsional)</label>
				<textarea class="form-control" placeholder="Bismillah, berkah" name="special_message" style="height: 100px !important"></textarea>
			</div>

			<button id="btn-submit" style="display: none;"></button>
		</form>

		<div class="bg-white rounded p-4 mb-2">
			<div class="row mb-2">
				<div class="col-8">Jumlah Donasi</div>
				<div class="col-4 text-right" id="donation_amount">Rp {{ str_replace(',', '.', number_format(session('nominal'))) }}</div>
			</div>
			<div class="row mb-2">
				<div class="col-8">Kode Unik</div>
				<div class="col-4 text-right" id="donation_code">{{ session('unique_code') }}</div>
			</div>
			<div class="row">
				<div class="col-8">Biaya Tambahan</div>
				<div class="col-4 text-right" id="donation_code">{{ str_replace(',', '.', number_format(session('payment_fee') )) }}</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-8"><h5>Total</h5></div>
				<div class="col-4 text-right font-weight-bold" id="donation_total">Rp {{ str_replace(',', '.', number_format(session('nominal') + session('unique_code') + session('payment_fee'))) }}</div>
			</div>
		</div>
	</div>
</div>


<nav class="footer-menu main-width">
	<div class="flex">
		<button class="btn-next btn btn-donate btn-accent btn-block font-weight-bold">LANJUTKAN PEMBAYARAN</button>
	</div>
</nav>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".payment-item").on("click", function(){
			var payment = $(this).data('payment')+"";
			$("input[name='payment']").val(payment);
			$(".btn-next").prop('disabled', false);
			$(".payment-item.active").removeClass('active');
			$(this).addClass('active');
		});

		$(".btn-next").on("click", function(){
			$("#btn-submit").click();
		});
	});

	$(".rupiah").on("keyup", function(){
		var value = $(this).val();
		var unique = {{ session('unique_code') }};
		var real_number = parseInt(value.replace(/\./g, ''));
		var total = real_number+unique;

		$("#donation_amount").html("Rp "+value);
		$("#donation_total").html("Rp "+convertToRupiah(total));
	});

	function goBack(){
		window.history.back();
	}
</script>
@endsection