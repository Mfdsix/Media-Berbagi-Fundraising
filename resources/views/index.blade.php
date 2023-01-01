@extends('layouts.mb-app')

@section('title', 'Home')

@section('content')
<!-- NAV TOP -->
@include('layouts.mb-nav-top-primary')
<style>
	#pilih-metode-pembayaran{
		overflow:hidden;
	}
	#pilih-metode-pembayaran-flex{
		display: flex;
		flex-direction:column;
		height:80vh;
	}
	#pilih-metode-pembayaran-payment{
		flex:1;
		overflow:scroll;
	}
	.position-center{
		z-index: 120;
		position:fixed;
		top:50%;
		left:50%;
		transform:translate(-50%, -50%);
		width:100%;
		height:100vh;
		background-color:rgba(0,0,0,0.5);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.text-theme{
		color:var(--primary-color);
	}
</style>

<div class="position-center d-none" id="loading">
	{{-- loading spinner --}}
	<div class="spinner-border text-theme" role="status">
		<span class="sr-only">Loading...</span>
	</div>
</div>

<!-- PILIH METODE PEMBAYARAN -->
<aside id="pilih-metode-pembayaran">
	<div class="container-fluid">
		<div id="pilih-metode-pembayaran-flex">
			<div class="d-flex align-items-center py-3 padding-l-24px">
				<div class="mr-2">
					<button type="button" class="pilih-metode-pembayaran-close">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</button>
				</div>
				<div>
					<h3 class="pilih-metode-pembayaran__title">Pilih Metode Pembayaran</h3>
				</div>
			</div>
			<div id="pilih-metode-pembayaran-payment">

			<!-- BANK -->
			@if(isset($payments['bk']) && count($payments['bk']) > 0)
			<div class="pilih-metode-pembayaran__line">
				<h6 class="pilih-metode-pembayaran__subtitle">Bank Transfer (Verifikasi Manual)</h6>
			</div>
			<div>
				<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
					@foreach($payments['bk'] as $k => $v)
					<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('bank-'+ '{{$v->id}}' + '-{{ $v->bank_name }}')">
						<img class="pilih-metode-pembayaran__image" src="{{ asset('storage/'.$v->path_icon) }}" alt="{{ $v->bank_name }}">
					</a>
					@endforeach
				</div>
			</div>
			@endif
				
			<!-- E-MONEY -->
			@if(isset($payments['ewallet']) && count($payments['ewallet']) > 0)
			<div class="pilih-metode-pembayaran__line">
				<h6 class="pilih-metode-pembayaran__subtitle">E-Wallet</h6>
			</div>
			<div>
				<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
					@foreach($payments['ewallet'] as $k => $v)
					<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('ewallet-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
						<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
					</a>
					@endforeach
				</div>
			</div>
			@endif
			<!-- VA -->
			@if(isset($payments['va']) && count($payments['va']) > 0)
			<div class="pilih-metode-pembayaran__line">
				<h6 class="pilih-metode-pembayaran__subtitle">Virtual Account (Verifikasi Otomatis)</h6>
			</div>
			<div>
				<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
					@foreach($payments['va'] as $k => $v)
					<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('virtualaccount-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
						<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
					</a>
					@endforeach
				</div>
			</div>
			@endif
			<!-- IB -->
			@if(isset($payments['ibank']) && count($payments['ibank']) > 0)
			<div class="pilih-metode-pembayaran__line">
				<h6 class="pilih-metode-pembayaran__subtitle">Internet Banking</h6>
			</div>
			<div>
				<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
					@foreach($payments['ibank'] as $k => $v)
					<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('ibanking-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
						<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
					</a>
					@endforeach
				</div>
			</div>
			@endif
			<!-- QR -->
			@if(isset($payments['qris']) && count($payments['qris']) > 0)
			<div class="pilih-metode-pembayaran__line">
				<h6 class="pilih-metode-pembayaran__subtitle">QRIS</h6>
			</div>
			<div>
				<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
					@foreach($payments['qris'] as $k => $v)
					<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('ibanking-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
						<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
					</a>
					@endforeach
				</div>
			</div>
			@endif
			<!-- STORE -->
			@if(isset($payments['store']) && count($payments['store']) > 0)
			<div class="pilih-metode-pembayaran__line">
				<h6 class="pilih-metode-pembayaran__subtitle">Convenience Store</h6>
			</div>
			<div>
				<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
					@foreach($payments['store'] as $k => $v)
					<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('store-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
						<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
					</a>
					@endforeach
				</div>
			</div>
			@endif
			</div>
		</div>
	</div>
</aside>
<!-- SEDEKAH - WAKAF - ZAKAT -->
<section id="sedekah-wakaf-zakat">
	<div class="container">
		<!-- LOGO -->
		<div class="row">
			<div class="col-12 text-center mb-4">
				@if($web_set->path_logo)
				<img class="logo-media-berbagi" src="{{ getThumb(asset('storage/' . $web_set->path_logo),128) }}" alt="Media Berbagi">
				@else
				<img class="logo-media-berbagi" src="{{ getThumb(asset('assets/media-berbagi/assets/images/website/logo-media-berbagi.png'),128) }}" alt="Media Berbagi">
				@endif
			</div>
		</div>
		<!-- MENU -->
		<div class="row">
			<div class="col-12 d-flex align-items-center justify-content-center">
				@if($instant['sedekah']->is_active == 1)
				<a onclick="setDonationType('sedekah','{{$instant['sedekah']->custom_nominal}}')" href="javascript:void(0)" class="home__button__sedekah home__button__3__active">Sedekah</a>
				@endif
				@if($instant['wakaf']->is_active == 1)
				<a onclick="setDonationType('wakaf','{{$instant['wakaf']->custom_nominal}}')" href="javascript:void(0)" class="home__button__wakaf">Wakaf</a>
				@endif
				@if($instant['zakat']->is_active == 1)
				<a onclick="setDonationType('zakat','{{$instant['zakat']->custom_nominal}}')" href="javascript:void(0)" class="home__button__zakat">Zakat</a>
				@endif
			</div>
		</div>
		<!-- DONASI SELECT -->
		<div class="row margin-b-25px">
			<div class="col-12 d-flex flex-wrap" style="gap: 20px;">
				<button type="button" class="home__pilih__nominal" data-nominal="100000">Rp100,000</button>
				<button type="button" class="home__pilih__nominal" data-nominal="200000">Rp200,000</button>
				<button type="button" class="home__pilih__nominal" data-nominal="300000">Rp300,000</button>
				<button type="button" class="home__pilih__nominal" data-nominal="400000">Rp400,000</button>
			</div>
		</div>
		<!-- ATAU -->
		<div class="row margin-b-25px">
			<div class="col-12 position-relative d-flex align-items-center">
				<div class="atau-line"></div>
				<div class="atau-text">Atau</div>
			</div>
		</div>
		<!-- INPUT DONASI -->
		<div class="row margin-b-25px">
			<div class="col-12">
				<input type="hidden" min="1000" name="nominal_donasi" id="nominal_value">
				<input min="1000" id="donation_nominal" type="text" class="rupiah home__input__nominal__donasi" placeholder="Masukan nominal donasi">
			</div>
		</div>
		<!-- LINE -->
		<div class="row margin-b-25px">
			<div class="col-12">
				<div class="atau-line"></div>
			</div>
		</div>
		@guest
		<!-- INPUT NAMA: IF NOT LOGIN -->
		<div class="row margin-b-42px" id="home-data-diri">
			<div class="col-12">
				<div class="margin-b-14px">
					<input class="input-default-form-50px home-data-diri__nama" type="text" placeholder="Nama Lengkap" id="fullname" value="{{ auth()->check() ? auth()->user()->name : null }}">
				</div>
				<div>
					<input class="input-default-form-50px home-data-diri__handphone" type="number" placeholder="Nomor Handphone" id="phone_number" value="{{ auth()->check() ? auth()->user()->phone : null }}">
				</div>
			</div>
		</div>
		@endguest
		@auth
		<input type="hidden" id="fullname" value="{{ auth()->check() ? auth()->user()->name : null }}">
		<input type="hidden" id="phone_number" value="{{ auth()->check() ? auth()->user()->phone : null }}">
		@endauth
		<!-- SUBMIT -->
		<div class="row">
			<div class="col-12">
				<button type="button" class="home__button__donasi__sekarang">Donasi Sekarang</button>
			</div>
		</div>
	</div>
</section>
<!-- MEMBER OF -->
@if(count($partners) > 0)
<div class="bg-white">
	<div class="container">
		<!-- ATAU -->
		<div class="row margin-b-25px">
			<div class="col-12 position-relative d-flex align-items-center">
				<div class="atau-line"></div>
				<div class="atau-text">MEMBER OF</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 px-4 d-flex flex-wrap align-items-center justify-content-center">
				@foreach($partners as $k => $v)
				<img class="logo-media-berbagi mx-2" src="{{ getThumb(asset('/storage/'. $v->image),300) }}" alt="Member Of">
				@endforeach
			</div>
		</div>
	</div>
</div>
@endif
<!-- SLIDER -->
<section class="bg-white">
	<div id="home-slider" class="swiper bg-white">
		<div class="swiper-wrapper">
			@if(count($sliders) == 0)
				<h5 class="text-dark-grey mb-3 text-left font-weight-bold">
					Slider
				</h5>
				<div class="text-center p-4">
					<img src="{{ asset('images/Slider.svg') }}" class="mb-2">
					<p class="text-icon">Belum Ada Slider !</p>
				</div>
			@endif
			@foreach($sliders as $k => $v)
				<a href="{{ $v->link_target }}" class="home__slider__item swiper-slide">
					<img src="{{ getThumb(asset('storage/'. $v->path_slider), 600) }}" alt="Slider">
				</a>
			@endforeach
		</div>
		<div class="home-slider-pagination"></div>
	</div>
</section>
<!-- TRENDING - NEW RELASE -->
<main class="bg-white">
	<div class="position-relative d-flex align-items-center justify-content-between">
		<button class="position-relative button__menu__2__news button__menu__2__news-trending button__menu__2__news__active" type="button">Trending <sup>New</sup></button>
		<button class="button__menu__2__news button__menu__2__news-new" type="button">New Release</button>
	</div>
	<div class="container-fluid">
		{{-- TRENDING --}}
		<div class="row" id="kegiatan-row-trending">
			@foreach($projects as $k => $v)
			<div class="col-12 p-0">
				<a class="home__trending__link" data-referrable href="{{ url($v->slug) }}">
					@if($v->path_featured != null)
                        <img class="home__trending__image" src="{{ getThumb(asset('/storage/'. $v->path_featured), 600,900) }}" alt="Trending">
                    @else
					<img class="home__trending__image" src="https://images.unsplash.com/photo-1633113093730-47449a1a9c6e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Trending">
					@endif
					<div class="home__tending__cover">
						<h2 class="home__trending__title">{{ $v->title }}</h2>
						<p class="home__trending__text">{{ preg_replace("/&#?[a-z0-9]{2,8};/i","",substr(strip_tags($v->content),0,200)) . "..." }}</p>
						<div class="home__trending__detail float-right">{{$v->button_label}}</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
		{{-- NEW --}}
		<div class="row" id="kegiatan-row-new" style="display: none">
			@foreach($newReleases as $k => $v)
			<div class="col-12 p-0">
				<a class="home__trending__link" data-referrable href="{{ url($v->slug) }}">
					@if($v->path_featured != null)
					<img class="home__trending__image" src="{{ getThumb(asset('/storage/'. $v->path_featured), 600,900) }}" alt="Trending">
					@else
					<img class="home__trending__image" src="https://images.unsplash.com/photo-1640506545701-a0b1b174827d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="Trending">
					@endif
					<div class="home__tending__cover">
						<h2 class="home__trending__title">{{ $v->title }}</h2>
						<p class="home__trending__text">{{ preg_replace("/&#?[a-z0-9]{2,8};/i","",substr(strip_tags($v->content),0,200)) . "..." }}</p>
						<div class="home__trending__detail float-right">{{$v->button_label}}</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="row mt-4 pb-4">
			<div class="col-12">
				<a href="/program" class="button__box__lihat__lebih__banyak" type="button">Lihat Lebih Banyak</a>
			</div>
		</div>
	</div>
</main>
<!-- KEGIATAN - BERITA -->
<main class="bg-white padding-b-100px">
	<div class="position-relative d-flex align-items-center justify-content-between margin-b-25px">
		<button class="button__menu__2__news button__menu__2__news-kegiatan button__menu__2__news__active" type="button">Kegiatan</button>
		<button class="button__menu__2__news button__menu__2__news-berita" type="button">Berita</button>
	</div>
	<div class="container">
		{{-- KEGIATAN --}}
		<div class="row" id="home-row-kegiatan">
			@foreach($activities as $k => $v)
			<article class="col-12 mb-3">
				<a class="home__berita__link" href="{{ url('/activity/'. $v->id) }}">
					<div class="home__berita__card__head">
						@if($v->path == null)
						<img src="https://images.unsplash.com/photo-1633113093730-47449a1a9c6e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Berita">
						@else
						<img src="{{ getThumb(asset('/storage/'.$v->path), 510, 180) }}" alt="Berita">
						@endif
					</div>
					<div class="home__berita__card__body">
						<h2 class="home__berita__card__title">{{ $v->title }}</h2>
						<p class="home__berita__card__text">{{ substr(preg_replace("/&#?[a-z0-9]+;/i","",strip_tags($v->content)),0,140) . "..." }}</p>
					</div>
				</a>
			</article>
			@endforeach
			<div class="col-12 mt-4">
				<a href="/activity" class="button__box__lihat__lebih__banyak" type="button">Lihat Lebih Banyak</a>
			</div>
		</div>
		{{-- BERITA --}}
		<div class="row" id="home-row-berita" style="display: none">
			@foreach($blogs as $k => $v)
			<article class="col-12 mb-3">
				<a class="home__berita__link" href="{{ url('/blog/'. $v->slug) }}">
					<div class="home__berita__card__head">
						@if($v->featured == null)
						<img class="home__trending__image" src="https://images.unsplash.com/photo-1640506545701-a0b1b174827d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="Trending">
						@else
						<img src="{{ asset('/storage/'.$v->featured) }}" alt="Berita">
						@endif
					</div>
					<div class="home__berita__card__body">
						<h2 class="home__berita__card__title">{{ $v->title }}</h2>
						<p class="home__berita__card__text">{{ substr(preg_replace("/&#?[a-z0-9]+;/i","",strip_tags($v->content)),0,140) . "..." }}</p>
					</div>
				</a>
			</article>
			@endforeach
			<div class="col-12 mt-4">
				<a href="/blog" class="button__box__lihat__lebih__banyak" type="button">Lihat Lebih Banyak</a>
			</div>
		</div>
	</div>
</main>
<!-- NAV BOTTOM -->
@include('layouts.mb-nav-bottom-primary', ['active' => 'home'])
@endsection

@section('js')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158121822-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-158121822-1', {
  'linker': {
    'domains': ['{{ env("APP_URL") }}']
  }
});
</script>


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
	fbq('track', 'PageView');
</script>
<noscript><img loading="lazy" height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $web_set->facebook_pixel }}&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endif

<!-- HOME JS -->
<script>
	var donationType = 'sedekah';
	var nominal = 0;
</script>
<script>
	var input = $('.rupiah')[0];
	input.addEventListener('keyup', function(e)
	{
		input.value = formatRupiah(this.value, 'Rp. ');
		$("#nominal_value").val(input.value.replace('Rp. ', '').replace(/\./g, ''));
	});
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString().replace(/^0+/, ''),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
</script>
<script src="{{ asset('assets/media-berbagi/styles/js/home.js') }}"></script>
@endsection
