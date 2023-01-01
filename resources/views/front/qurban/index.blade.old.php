@extends('layouts.app')

@section('title', 'Qurban')
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
    <link rel="stylesheet" href="../../assets/css/detail.css">
    <link rel="stylesheet" href="../../assets/css/instruksi.css">
    <link rel="stylesheet" href="../../assets/css/categories-qurban.css">

    <style>
        .hadist {
            background: #fff;
            border: 1px solid #fff;
            box-sizing: border-box;
            border-radius: 15px;
            font-family: Inter;
            font-style: normal;
            font-weight: 300;
            font-size: 14px;
            line-height: 19px;
            color: #363636;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.15);
	    }
        .hadist .text-left {
            font-family: Inter;
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            line-height: 150%;

            color: #363636;
        }
        #btn-next {
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 19px;
            text-align: center;
            color: white;
            border: 1px solid white;
            background-color: var(--primary);
            box-sizing: border-box;
            border-radius: 13px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 52px;
            }

        #btn-next:hover {
            background-color: white;
            color: var(--primary);
            border-color: var(--primary);
            }
    </style>

    <title>Detail Page</title>
@endsection

@section('content')

    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button class="btn-transparent">
                <a href="javascript:void(0)" class="text-white" onclick="goBack()">
                    <img src="../../assets/img/icons/back-light.svg" alt="">
                </a>
            </button>
            <h4 class="navbar-wrapper-title">Pilih Hewan Qurban</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">
            <div class="col-12">
                <div class="main-width">

                <div class="bg-white radius-20 p-4 mb-2 mt-1">
                    <div class="hadist container p-3">
                        <div class="text-left">“Katakanlah: Sesungguhnya shalatku, sembelihanku, hidupku dan matiku hanyalah untuk Allah,
                            Tuhan semesta alam. Tiada sekutu bagi-Nya dan demikian itulah yang diperintahkan kepadaku dan
                            aku adalah orang yang pertama-tama menyerahkan diri (kepada Allah)”<div class="text-primary text-left">Q.S Al-An’am ayat : 162-163</div>
                        </div>
                    </div>

                    <hr class="mb-3 mt-4">

                    <div class="row">
                        @foreach ($datas as $k => $v)
                        <div class="col-9 mb-3">
                            <div class="product">{{ $v->title }}</div>
                            <div class="price font-weight-bold">{{ 'Rp '.str_replace(',', '.', number_format($v->price)) }}</div>
                        </div>
                                
                        <div class="quantity-bar col-3 mb-3 p-1">
                            <div class="quantity-controller">
                                <input type="hidden" class="quantity-id" value="{{ $v->id }}">
                                <button class="quantity-minus"><img src="../../assets/img/icons/minus-blue.svg" alt=""></button>
                                <input type="number" class="quantity-number" value="0" data-amount="{{ $v->price }}">
                                <button class="quantity-plus"><img src="../../assets/img/icons/plus-blue.svg" alt=""></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>  
                    <div class="instruction-alert mt-4 p-3 text-justify"><span>Disclaimer :</span> Penyaluran hewan qurban termurah ditentukan oleh Forfund dengan mengedepankan lokasi dan penerima manfaat yang membutuhkan</div>
                        
                    <div class="footer-menu">   
                        <div class="row mb-3">
                            <div class="col-7">
                                <div class="quantity">Total</div>
                            </div>
                            
                            <div class="col-5"> 
                                <h6 class="quantity-amount d-flex justify-content-end">   
                                </h6>
                            </div>
                        </div>
                        {{--href="qurban/{id}/nominal"--}}

                        {{--<a href="">
                            <button class="btn btn-primary btn-block mb-5 execute" id="btn-next" style="height: 52px; border-radius: 13px;"><b>Masuk Sekarang</b></button>
                        </a>--}}

                        <div class="btn btn-block mb-5 execute" id="btn-next" style="height: 52px; border-radius: 13px;" >Selanjutnya</div>

                        {{--<a href="/login">
                            <button class="btn btn-outline-primary btn-block" id="btn-next" style="height: 52px; border-radius: 13px;"><b>Masuk Sekarang</b></button>
                        </a>--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function goTo() {
        allert("tes")
    }
</script>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./assets/js/news.js"></script>
<script src="./assets/js/qurban.js"></script>
<script src="./assets/js/global.js"></script>
@endsection