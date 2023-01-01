@extends('layouts.mb-app')

@section('title', 'Terimakasih')

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Terimakasih'])
<style>#nav-top-secondary{position:fixed !important}#timeout{display:none;}.img-warning{width: 120px;}.btn-wrap{position:fixed;bottom:0;width:100%;left:50%;max-width: 576px;transform:translateX(-50%)}.img-ovo{max-width:240px}.btn-next{background:var(--primary-color);color:white;}</style>

<form style="display: none" name="form" id="form-ovo" action="{{ $url }}" method="POST">
<!-- <form name="form" id="form-ovo" action="{{ $url }}" method="POST"> -->
@csrf
<input type="text" name="trx_id" value="{{ $trx_id }}">
<input type="text" name="ovo_number" value="{{ $ovo_number }}">
<input type="text" name="signature" value="{{ $signature }}">
</form>


<div class="p-4 d-flex flex-column justify-content-center" style="background:white;min-height:100vh">
<div id="counting">
    <div class="text-center d-flex flex-column align-items-center">
        <img src="{{ asset('assets/media-berbagi/animation_500_ky8ncbsr.gif') }}" alt="" class="img-fluid mb-2 img-ovo">
        <h5>Selesaikan Pembayaran dalam waktu</h5>
        <h5>00:<span id="count-ovo">55</span> detik</h5>
        <p class="mt-2">Cek notifikasi kamu atau buka aplikasi OVO untuk</p>
        <p>menyelesaikan pebayaran</p>
    </div>
</div>
<div id="timeout">
    <div class="d-flex align-items-center justify-content-center">
        <h1><b>Waktu Habis</b></h1>
        <img src="{{ asset('assets/media-berbagi/38213-error.gif') }}" alt="" class="img-warning">
    </div>
</div>
<div class="btn-wrap p-4">
    <a href="/donation/{{$project_id}}" class="btn btn-block rounded-pill py-3 btn-next">Cek Status Pembayaran</a>
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

<script>
    $(document).ready(function(){
        $("#form-ovo").submit();
        let x = 55;
        let count = setInterval(()=>{
            if(x > 0) {
                x--
                $('#count-ovo').html(x)
            }else{
                console.log('habis')
                $('#counting').css('display', 'none')
                $('#timeout').css('display', 'block')
                clearInterval(count)
            }
        },1000)
    });
</script>
@endsection
