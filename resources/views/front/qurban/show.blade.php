@extends('layouts.app')

@section('title', 'Donasi Saya Page')
@section('css')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link hrezf="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="../../assets/js/swiper/swiper.css">
    <link rel="stylesheet" href="../../assets/css/global.css">
<link rel="stylesheet" href="../../assets/css/variable.css">
    <link rel="stylesheet" href="../../assets/css/my-donation.css">

    <title>Donasi Saya Page</title>
@endsection

@section('content')
    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button class="btn-transparent">
                <a href="javascript:void(0)" class="text-white" onclick="goBack()">
                    <img src="../../assets/img/icons/back-light.svg" alt="">
                </a>
            </button>
            <h4 class="navbar-wrapper-title">Qurban Saya</h4>
        </div>
    </div>

    <div class="screen">
        <div class="screen-cover d-none"></div>
        <div class="row">
            <div class="col-12">
                <div class="swiper-container" id="swiper-status">
                    <div class="status-section swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="status-block active">Semua</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="status-block ">Menunggu Pembayaran</div>
                        </div>
                        <div class="swiper-slide">
                            <div class="status-block ">Berhasil</div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-12">
                <div class="history-section">
                    <div class="line-separator mb-4"></div>
                    <h4 class="section-title mb-3">Catatan Qurban</h4>

                    <div class="history-card">
                        <img src="../../assets/img/donation-history/1.png" alt="" class="history-image">

                        <div class="history-content-wrapper">
                            <h4 class="history-title">PPKM Diperpanjang, Bantu UMKM dan Warga..</h4>
                            <h4 class="history-detail-text">22 july 2022 • <span> Rp50.000</span></h4>
                        </div>

                        <div class="history-status">Berhasil</div>
                    </div>

                    <div class="history-card">
                        <img src="../../assets/img/donation-history/1.png" alt="" class="history-image">

                        <div class="history-content-wrapper">
                            <h4 class="history-title">PPKM Diperpanjang, Bantu UMKM dan Warga..</h4>
                            <h4 class="history-detail-text">22 july 2022 • <span> Rp50.000</span></h4>
                        </div>

                        <div class="history-status">Berhasil</div>
                    </div>

                    <div class="history-card">
                        <img src="../../assets/img/donation-history/1.png" alt="" class="history-image">

                        <div class="history-content-wrapper">
                            <h4 class="history-title">PPKM Diperpanjang, Bantu UMKM dan Warga..</h4>
                            <h4 class="history-detail-text">22 july 2022 • <span> Rp50.000</span></h4>
                        </div>

                        <div class="history-status">Berhasil</div>
                    </div>


                    <div class="history-card">
                        <img src="../../assets/img/donation-history/1.png" alt="" class="history-image">

                        <div class="history-content-wrapper">
                            <h4 class="history-title">PPKM Diperpanjang, Bantu UMKM dan Warga..</h4>
                            <h4 class="history-detail-text">22 july 2022 • <span> Rp50.000</span></h4>
                        </div>

                        <div class="history-status">Berhasil</div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js " integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj " crossorigin="anonymous "></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js " integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns " crossorigin="anonymous "></script>
<script src="../../assets/js/swiper/swiper.js "></script>
<script src="../../assets/js/my-donation.js "></script>
@endsection