@extends('layouts.mb-app')

@section('title', 'Detail Article')
@section('css')
<style>
    .swiper-slide{
        width: auto !important;
    }
</style>
@endsection

@section('content')
<!-- NAV TOP -->
@include('layouts.mb-nav-top-secondary', ['title' => 'Ruang Edukasi Yayasan'])
<!-- ARTICLE MENU -->
<div id="page-article-menu" class="bg-white pt-5 padding-b-25px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pr-0" style="border-bottom: 1px solid #E5E5E5">
                <div id="aritcle-slider-menu" class="swiper">
                    <div class="swiper-wrapper">
                        <a href="/blog" class="aritcle-slider-menu aritcle-slider-menu__active swiper-slide">Semua</a>
                        @foreach($categories as $k => $v)
                        <a href="/blog/c/{{ $v->id }}" class="aritcle-slider-menu swiper-slide">{{ $v->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ARTICLE SLIDE -->
<section id="page-article-slide" class="bg-white padding-b-32px">
    <div id="page-article-slide-swiper" class="swiper">
        <div class="swiper-wrapper">
            @foreach($datas as $k => $v)
                <a href="/blog/{{ $v->slug }}" class="page-article__slider__item swiper-slide">
                    @if($v->featured)
                    <img src="{{ asset('/storage/' . $v->featured) }}" alt="{{ $v->title }}">
                    @else
                    <img src="https://images.unsplash.com/photo-1639581160409-daa56967e828?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="{{ $v->title }}">
                    @endif
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="page-article__slider__item__date__read">{{ Date('d M Y', strtotime($v->created_at)) }}</span>
                        <span class="page-article__slider__item__date__read">{{ $v->views }} read</span>
                    </div>
                    <h2 class="page-article__slider__item__title">{{ $v->title }}</h2>
                </a>
            @endforeach
        </div>
        <div class="page-article-slide-swiper-pagination"></div>
    </div>
</section>
<!-- ARTICLE POPULER -->
<main id="page-article-main" class="bg-white padding-b-100px">
    <div class="container-fluid p-4">
        <div class="row">
            <div class="col-12 margin-b-20px">
                <div class="line-1px"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="main-section-title-primary margin-b-20px">Artikel Populer</h3>
            </div>
        </div>
        <div class="row">
            @foreach($popular as $k => $v)
                <div class="col-12 article-main-list">
                    <div class="article-main-list__head">
                        @if($v->featured)
                        <img class="article-main-list__image" src="{{ asset('/storage/'.$v->featured) }}" alt="{{ $v->title }}">
                        @else
                        <img class="article-main-list__image" src="https://images.unsplash.com/photo-1640174177278-626c26144e80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="{{ $v->title }}">
                        @endif
                    </div>
                    <div class="article-main-list__body">
                        <h2 class="article-main-list__title"><a href="/blog/{{ $v->slug }}">{{ $v->title }}</a></h2>
                        <p class="article-main-list__text">{{ substr(strip_tags($v->content), 0, 30) }}...</p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- <div class="row">
            <a href="#" class="article-main-baca-selanjutnya">Baca Selanjutnya</a>
        </div> -->
    </div>
</main>
@include('layouts.mb-nav-bottom-primary', ['active' => 'home'])
@endsection

@section('js')
<!-- ARTICLE JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/article.js') }}"></script>
@endsection
