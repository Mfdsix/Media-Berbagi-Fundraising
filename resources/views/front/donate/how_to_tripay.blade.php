@extends('layouts.mb-app')

@section('title', 'Detail Pembayaran')
@section('css')
<style>
.page-main__nominal-hidden {
	position: absolute;
	visibility: hidden;
	z-index: -10;
}
</style>
@endsection

@section('content')
<!-- NAV TOP -->
@include('layouts.mb-nav-top-secondary', ['title' => 'Detail Pembayaran'])

<!-- MAIN: PEMBAYARAN VIRTUAL ACCOUNT -->
<main id="page-main-va" class="bg-white" style="padding-bottom: 300px">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-center mb-2">
                <h2 class="main-section-title-primary">Instruksi pembayaran</h2>
            </div>
            @if($transaction->payment_type != 'qris' && $transaction->payment_method != 'QRIS')
                @if(isset($payment["payment"]->qr_url))
                <div class="col-12 text-center mb-2">
                        <p class="main-section-text-16 px-2">Scan Qr Code dibawah ini:</p>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                       <img src="{{$payment['payment']->qr_url}}" alt="qrcode" style="width:100%;max-width:300px">
                    </div>
                @else
                    <div class="col-12 text-center mb-2">
                        <p class="main-section-text-16 px-2">Transfer sesuai nominal dibawah ini:</p>
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <div class="page-main__nominal-hidden">{!! $transaction->nominal_formatted !!}</div>
                        <input class="page-main-va__input__nominal" type="text" value="" disabled>
                        <div>
                            <button class="page-main-va__salin__nominal" type="button" onclick="copyToClipboard('page-main-va__input__nominal')">Salin</button>
                            <div class="disalin toast position-absolute" style="width:200px;right: 0;bottom: -20px;">
                                <div class="toast-body">
                                    Teks telah di salin
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="row mb-3">
            @if($transaction->payment_type == 'qris' || $transaction->payment_method == "QRIS")
                <div class="col-12 text-center mb-2">
                    <p class="main-section-text-16 px-2">Pembayaran QRIS dapat dilakukan melalui aplikasi Gopay, OVO, LinkAja dan semua E-Wallet.</p>
                </div>
            @else
                <div class="col-12 text-center mb-2">
                    <p class="main-section-text-16 px-2">Pembayaran dilakukan ke <b>{{ $transaction->payment_method }}</b> dengan nomor pembayaran</p>
                </div>
            @endif

            @if($transaction->payment_type == 'qris'||$transaction->payment_method == 'QRIS')
            <div class="col-12 mt-2 mb-2">
                <center>
                    <img src="{{ $transaction->reference }}" class="img-fluid" style="max-width: 280px;">
                </center>
            </div>
            @endif

            @if($transaction->payment_method != "QRIS" && $transaction->payment_type != 'ewallet')
			@if($transaction->payment_type != 'emoney' && $transaction->payment_type != 'qris')
            <div class="col-12 d-flex justify-content-between">
				<img class="page-main-va__image__rekening" src="{{ asset($payment['icon']) }}" alt="Virtual Account">
				<input class="page-main-va__input__rekening" type="text" value="{{ $payment['pay_code'] }}" disabled>
				<div class="position-relative">
                    <button class="page-main-va__salin__rekening" type="button" onclick="copyToClipboard('page-main-va__input__rekening')">Salin</button>
                    <div class="nomorva toast position-absolute" style="width:200px;right: 0;bottom: -20px;">
                        <div class="toast-body">
                            Teks telah di salin
                        </div>
                    </div>
                </div>
			</div>
			@else
			<div class="col-12">
                @if($transaction->payment_type != 'qris')
                    <div class="text-center mt-2">
                        <img style="height: 60px; width: auto" src="{{ asset($transaction->icon) }}" alt="Virtual Account">
                    </div>
                @else
                    <div class="text-center mt-2">
                        <img style="height: 60px; width: auto" src="{{ asset('assets/media-berbagi/qris.webp') }}" alt="Virtual Account">
                    </div>
                @endif
			</div>
			@endif
            @endif
        </div>
        <div class="row mb-2">
            <div class="col-12 text-center">
                <p class="main-section-text-14 px-2">Lakukan Pembayaran sebelum <strong>1 x 24 jam</strong> atau donasi kamu otomatis dibatalkan oleh sistem.</p>
            </div>
            @if($transaction->payment_type == 'emoney'||$transaction->payment_type == 'ewallet')
            <div class="col-12 mb-2 text-center">
                <hr>
                <a class="btn btn-primary" target="_blank" href="{{ $transaction->pay_url != null ? $transaction->pay_url : $transaction->reference }}">Lanjutkan Pembayaran</a>
            </div>
            @endif
        </div>
        <!-- BOX -->
        <div class="row margin-b-25px">
            <div class="col-12">
                <div class="page-main-ewallet__box">
                    <div class="mr-2">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_238_4901)">
                            <path d="M8.9817 1.56595C8.88271 1.39352 8.73998 1.25025 8.56791 1.15062C8.39584 1.051 8.20053 0.998535 8.0017 0.998535C7.80287 0.998535 7.60756 1.051 7.43549 1.15062C7.26343 1.25025 7.12069 1.39352 7.0217 1.56595L0.164702 13.233C-0.292298 14.011 0.255702 15 1.1447 15H14.8577C15.7467 15 16.2957 14.01 15.8377 13.233L8.9817 1.56595ZM7.9997 4.99995C8.5347 4.99995 8.9537 5.46195 8.8997 5.99495L8.5497 9.50195C8.53794 9.63972 8.4749 9.76806 8.37306 9.86159C8.27121 9.95511 8.13797 10.007 7.9997 10.007C7.86143 10.007 7.72819 9.95511 7.62635 9.86159C7.5245 9.76806 7.46146 9.63972 7.4497 9.50195L7.0997 5.99495C7.08713 5.86919 7.10105 5.74218 7.14055 5.62212C7.18005 5.50206 7.24426 5.3916 7.32905 5.29786C7.41383 5.20413 7.51731 5.12919 7.63282 5.07788C7.74833 5.02657 7.87331 5.00002 7.9997 4.99995ZM8.0017 11C8.26692 11 8.52127 11.1053 8.70881 11.2928C8.89634 11.4804 9.0017 11.7347 9.0017 12C9.0017 12.2652 8.89634 12.5195 8.70881 12.7071C8.52127 12.8946 8.26692 13 8.0017 13C7.73649 13 7.48213 12.8946 7.2946 12.7071C7.10706 12.5195 7.0017 12.2652 7.0017 12C7.0017 11.7347 7.10706 11.4804 7.2946 11.2928C7.48213 11.1053 7.73649 11 8.0017 11Z" fill="#FDB504"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_238_4901">
                            <rect width="16" height="16" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div>
                        <p class="main-section-text-14">Dana yang di donasikan melalui {{envdb('APP_NAME')}} bukan bersumber dan bukan untuk tujuan praktik pencucian uang (money laundry), termasuk teroris dan kejahatan keuangan lainnya.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- instruction -->
        @if($payment['instruction'] && count($payment['instruction']) > 0)
        <div class="row margin-b-25px">
            <div class="col-12">
                <div class="mr-2">
                    <h5>Instruksi Pembayaran</h5>
                    <hr>
                    @foreach($payment['instruction'] as $k => $v)
                    <div>
                        <b>{{ $v->title }}</b>
                        <div>
                            <ul>
                            @foreach($v->steps as $k2 => $v2)
                            <li>{!! $v2 !!}</li>
                            @endforeach
                            </ul>
                        </div>
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        @if(isset($payment["payment"]->checkout_url) && $payment["payment"]->payment_method == "OVO")
        <div class="col-12 mb-2 text-center">
                <hr>
                <a class="btn btn-primary" target="_blank" href="{{ $payment['payment']->checkout_url }}">Lanjutkan Pembayaran</a>
            </div>
        @endif
        <!-- end of instruction -->
    </div>
</main>

@include('layouts.mb-nav-bottom-share-penggalangan')
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
    fbq('track', 'Purchase', {currency: "IDR", value: {{ $transaction->nominal }} });
</script>
<noscript><img loading="lazy" height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $web_set->facebook_pixel }}&ev=InitiateCheckout&noscript=1"
/></noscript>
<noscript><img loading="lazy" height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id={{ $web_set->facebook_pixel }}&ev=Purchase&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->
@endif
<!-- PEMBAYARAN JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/pembayaran.js') }}"></script>
<script>
	let nominal = $('.page-main__nominal-hidden').text();
	$('.page-main-va__input__nominal').val(nominal)
</script>
@endsection
