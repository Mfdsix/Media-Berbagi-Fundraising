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
                        @if($v->path)
                        <img class="article-main-list__image" src="{{ asset('/storage/'.$v->path) }}" alt="{{ $v->title }}">
                        @else
                        <img class="article-main-list__image" src="https://images.unsplash.com/photo-1640174177278-626c26144e80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="{{ $v->title }}">
                        @endif
                    </div>
                    <div class="article-main-list__body">
                        <h2 class="article-main-list__title"><a href="/blog/{{ $v->slug }}">{{ $v->title }}</a></h2>
                        <p class="article-main-list__text">{{ substr(preg_replace("/&#?[a-z0-9]+;/i","",strip_tags($v->content)), 0, 30) }}...</p>
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
