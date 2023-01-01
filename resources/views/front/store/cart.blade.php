@extends('layouts.app')

@section('title', 'Detail Page')
@section('css')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">

    <!-- Bootstrap CSS -->
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">--}}

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/detail.css">
    <link rel="stylesheet" href="/assets/css/detail-order.css">
    <link rel="stylesheet" href="/assets/css/rincian.css">
    <link rel="stylesheet" href="/assets/css/payment.css">
    <link rel="stylesheet" href="/assets/css/detail-cart.css">
    <link rel="stylesheet" href="/assets/css/variable.css">
    <link rel="stylesheet" href="/assets/js/swiper/swiper.css">

    <title>Detail Page</title>
@endsection

@section('content')
    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button class="btn-transparent">
                <a href="javascript:void(0)" onclick="window.location.href = '/official-store'" class="text-white">
                    <img src="/assets/img/icons/back-light.svg" alt="">
                </a>
            </button>
            <h4 class="navbar-wrapper-title">Keranjang</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">
            <div class="col-12">
                <div class="cart-action-wrapper">
                    <input type="checkbox" class="check-item" id="check-all">
                    <h4 class="choose-all-label">Pilih Semua</h4>
                </div>
            </div>

            <div class="col-12">
                <div class="order-items-group">
                    @if ($carts == null)
                    <div class="text-center p-4">
                        <img src="{{ asset('images/blank.png') }}" class="img-blank mb-2">
                        <p><b>Belum Ada Item Barang yang Dipilih</b></p>
                    </div>
                    @else
                    @php
                        $a=0;
                    @endphp
                    @foreach($carts as $i => $cart)
                    @php
                        $a=$a+1;
                    @endphp
                    @php
                        $key = array_keys($cart)[0];
                        $product = \App\Models\Product::findOrFail($key);
                    @endphp

                    <div class="order-item-wrapper w-100">
                        <div class="order-item w-100">
                            <input type="checkbox" class="check-item check-product">
                            <img src="{{asset('storage/'.$product->thumbnail)}}" alt="">
                            <div class="order-item-info">
                                <h4 class="order-item-name">{{strlen($product->name) > 25 ? substr($product->name, 0, 25).'...' : $product->name}}</h4>

                                <div class="order-item-prices">

                                    <h4 class="order-item-price order-variations">{{join(", ", array_values($cart)[0])}}</h4>
                                </div>

                                <h4 class="order-item-green">{{"Rp ".str_replace(',', '.', number_format($product->price))}}</h4>
                            </div>
                            <div class="order-item-quantity">
                                <div class="quantity-bar">
                                    <div class="quantity-controller">
                                        <button class="quantity-minus"><img src="/assets/img/icons/minus-blue.svg" class="img-fluid" alt=""></button>
                                        <input type="number" oninput="count()" oninput="count()" id="tes{{$a}}" class="quantity-number" value="1">
                                        <button class="quantity-plus"><img src="/assets/img/icons/plus-blue.svg" class="img-fluid" alt=""></button>
                                        <a href="{{ url('product/cart/'.$i.'/delete') }}" class="btn"><i class="fa fa-trash text-danger"></i></A>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endif
                    

                </div>
            </div>
        </div>

    </div>

    <div id="navbar-bottom">
        <div class="zakat-value-group">
            <h4 class="zakat-main-label">Total</h4>
            <h4 class="zakat-main-value">Rp0</h4>
        </div>
        @if(isset($product))
        <button class="btn-pay-donation" data-whatsapp="{{$product->url}}">
            <img src="/assets/img/icons/whatsapp-light.svg" class="mr-1" alt="">
            Beli Sekarang</button>
        @endif
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
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns " crossorigin="anonymous "></script>
    <script src="/assets/js/swiper/swiper.js "></script>
    <script src="/assets/js/news.js "></script>
    <script src="/assets/js/detail.js "></script>
    <script src="/assets/js/all-products.js "></script>
    <script src="/assets/js/cart.js "></script>
    <script src="/assets/js/global.js"></script>
@endsection