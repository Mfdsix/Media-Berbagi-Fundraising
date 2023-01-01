@extends('layouts.mb-app')

@section('title', 'Program Donasi')
@section('css')
<style>
	.page-category-menu__image{
		width: 60px;
		height: 60px;
		border-radius: 100%;
		object-fit: cover;
	}
</style>
@endsection


@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => $title])
<!-- SECTION CATEGORY -->
<section id="page-category-menu" class="bg-white">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 pr-0">
				@if ($categories)
				<div id="page-category-menu-container" class="swiper">
					<div class="swiper-wrapper">
						@foreach ($categories as $k => $v)
							<a href="/program/c/{{ $v->id }}" class="page-category-menu__list swiper-slide @if($cid == $v->id) page-category-menu__list__active @endif" style="width:auto">
								<div class="page-category-menu__cover">
									@if($v->path_icon != null)
									<img class="page-category-menu__image" src="{{ asset('/storage/'. $v->path_icon) }}">
									@else
									<img class="page-category-menu__image" src="{{ asset('/assets/media-berbagi/assets/images/website/category-1.png') }}">
									@endif
								</div>
								<h2 class="page-category-menu__title">{{$v->category}}</h2>
							</a>
						@endforeach
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</section>
<!-- TRENDING - NEW RELASE -->
<main class="bg-white padding-b-75px">
	<div class="position-relative d-flex align-items-center justify-content-between">
		<button class="position-relative button__menu__2__news button__menu__2__news-trending button__menu__2__news__active" type="button">Trending <sup>New</sup></button>
		<button class="button__menu__2__news button__menu__2__news-new" type="button">New Release</button>
	</div>
	<div class="container-fluid">
		{{-- TRENDING --}}
		<div class="row" id="kegiatan-row-trending">
			@if ($projects != null)
				@foreach ($projects as $key => $item)
					<div class="col-12 p-0">
						<a class="home__trending__link" data-referrable href="{{ url($item->slug) }}">
							@if($item->path_featured)
							<img class="home__trending__image" src="{{ getThumb(asset('/storage/'. $item->path_featured), 600,900) }}" alt="Trending">
							@else
							<img class="home__trending__image" src="https://images.unsplash.com/photo-1633113093730-47449a1a9c6e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Trending">
							@endif
							<div class="home__tending__cover">
								<h2 class="home__trending__title">{{ $item->title }}</h2>
								<p class="home__trending__text">{{ $item->title }}</p>
								<div class="home__trending__detail float-right">Lihat Detail</div>
							</div>
						</a>
					</div>
				@endforeach
			@else
				<div class="text-center p-4">
					<p class="main-section-title-primary">Belum Ada Program</p>
				</div>
			@endif
		</div>
		{{-- NEW RELASE --}}
		<div class="row" id="kegiatan-row-new" style="display: none">
			@if ($new != null)
				@foreach ($new as $key => $item)
					<div class="col-12 p-0">
						<a class="home__trending__link" data-referrable href="{{ url($item->slug) }}">
							@if($item->path_featured)
							<img class="home__trending__image" src="{{ getThumb(asset('/storage/'. $item->path_featured), 600,900) }}" alt="Trending">
							@else
							<img class="home__trending__image" src="https://images.unsplash.com/photo-1640506545701-a0b1b174827d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="Trending">
							@endif
							<div class="home__tending__cover">
								<h2 class="home__trending__title">{{ $item->title }}</h2>
								<p class="home__trending__text">{{ $item->title }}</p>
								<div class="home__trending__detail float-right">Lihat Detail</div>
							</div>
						</a>
					</div>
				@endforeach
			@else
				<div class="text-center p-4">
					<p class="main-section-title-primary">Belum Ada Program</p>
				</div>
			@endif
		</div>
	</div>
	<!-- <div class="container">
		<div class="row mt-4 margin-b-14px">
			<div class="col-12">
				<a href="./category.html" class="button__box__lihat__lebih__banyak" type="button">Lihat Lebih Banyak</a>
			</div>
		</div>
	</div> -->
</main>
@include('layouts.mb-nav-bottom-primary', ['active' => 'program'])
<!--End Footer-->
@endsection

@section('js')
<!-- CATEGORY JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/category.js') }}"></script>
@endsection
