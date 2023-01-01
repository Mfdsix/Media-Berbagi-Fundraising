@extends('layouts.app')

@section('title', 'Detail Page')
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
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/detail-product.css">
    <link rel="stylesheet" href="/assets/js/swiper/swiper.css">
    <link rel="stylesheet" href="/assets/css/variable.css">
    <link rel="stylesheet" href="/assets/css/payment.css">

    <title>Detail Page</title>
@endsection

@section('content')

    <div id="navbar-top">
        <div class="navbar-wrapper">
            <button class="btn-transparent">
                <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                    <img src="/assets/img/icons/back-light.svg" alt="">
                </a>
            </button>
            <h4 class="navbar-wrapper-title">{{strlen($product->name) > 25 ? substr($product->name, 0, 25).'...' : $product->name}}</h4>
            <button class="btn-transparent" id="btn-share">
                <img src="/assets/img/icons/share-light.svg" alt="">
            </button>
        </div>
    </div>

    <div class="screen">
        <div class="screen-cover d-none"></div>
        <div class="popup-notification-wrapper d-none">
            <div class="popup-notification">
                <button class="close-popup-notification">
                <img src="/assets/img/icons/close-small-grey.svg" alt="">
            </button>

                <h4 class="popup-title">Berhasil ditambahkan</h4>
                <h4 class="popup-content"> <span>{{strlen($product->name) > 25 ? substr($product->name, 0, 25).'...' : $product->name}} </span>berhasil ditambahkan ke dalam keranjang.</h4>

                <a href="{{'cart'}}" class="btn-view-cart">Lihat Keranjang</a>
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <img src="{{asset('storage/'.$product->thumbnail)}}" alt="{{asset('storage/'.$product->thumbnail)}}" class="img-fluid" style="width: 420px; height: 371px;">
            </div>

            <div class="col-12">
                <div class="products-detail-info">
                    <span class="d-none product-detail-id">{{$product->id}}</span>
                    <h4 class="products-detail-name">{{$product->name}}</h4>

                    <h4 class="products-price">{{"Rp ".str_replace(',', '.', number_format($product->price))}}</h4>
                </div>
            </div>

            <div class="col-12">
                <div class="products-detail-variant">
                @if ($product->custom)
                @foreach(json_decode($product->custom) as $key => $item)
                <h4 class="products-variant-title my-3">Pilih {{$key}}:</h4>
                <div class="category-section swiper-container" id="swiper-category">
                    <div class="swiper-wrapper">
                        @foreach($item as $variant)
                            <div class="swiper-slide">
                                <button class="variant-block" data-variant="{{$key}}">{{$variant}}</button>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
                </div>
            </div>

            <div class="col-12">
                <div class="product-detail-content">
                    <h4 class="products-variant-title mb-4">Detail Produk</h4>
                    <div class="products-content-text short">{!! $product->detail !!}</div>

                    {{-- <button class="btn-view-more-detail">Lihat Selengkapnya</button> --}}
                </div>
            </div>

        </div>
    </div>

    <div class="navbar-bottom-cart">
        <div class="navbar-bottom-navigation">
            @if (auth::user())
            <button class="navbar-bottom-link cart" id="add-to-cart">+Keranjang
            </button>
            
            <button class="navbar-bottom-link whatsapp buy-now" data-whatsapp="{{ $product->url }}">
                <span>Beli Sekarang</span>
                <img src="/assets/img/icons/whatsapp-light.svg" alt="">
            </button>
            @else
            <button class="btn btn-pay-donation btn-accent btn-block font-weight-bold btn-donate radius-10" data-whatsapp="{{ $product->url }}">
                <img src="/assets/img/icons/whatsapp-light.svg" alt="">
                <span>Beli Sekarang</span>
            </button>
            @endif

            
        </div>
    </div>

    <div id="bottom-share" class="d-none">
        <h4 class="share-title">Bagikan ke orang baik lainnya</h4>

        <div class="share-bar">
            <a href="#" class="share-button">
                <div class="share-img-wrapper">
                    <img src="/assets/img/icons/instagram-purple.svg" alt="">
                </div>
                <h4 class="share-text">Instagram</h4>
            </a>
            <a href="#" class="share-button">
                <div class="share-img-wrapper">
                    <img src="/assets/img/icons/whatsapp-purple.svg" alt="">
                </div>
                <h4 class="share-text">Whatsapp</h4>
            </a>
            <a href="#" class="share-button ">
                <div class="share-img-wrapper ">
                    <img src="/assets/img/icons/facebook-purple.svg " alt=" ">
                </div>
                <h4 class="share-text ">Facebook</h4>
            </a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @auth
            let token = "{{JWTAuth::fromUser(Auth::user())}}"
        @endauth

        @guest
            let token = null
        @endguest
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns " crossorigin="anonymous "></script>
    <script src="/assets/js/swiper/swiper.js "></script>
    <script src="/assets/js/news.js "></script>
    <script src="/assets/js/detail.js "></script>
    <script src="/assets/js/all-products.js "></script>
    <script src="/assets/js/global.js"></script>
@endsection