@extends('layouts.app')

@section('title', 'Pengaturan')

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
    <link rel="stylesheet" href="./assets/css/global.css">
<link rel="stylesheet" href="./assets/css/variable.css">
    <link rel="stylesheet" href="./assets/css/payment.css">
    <link rel="stylesheet" href="./assets/css/settings.css">

    <title>Pengaturan</title>
@endsection

@section('content')

    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button class="btn-transparent">
            <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                <img src="./assets/img/icons/back-light.svg" alt="">
            </a>
            </button>
            <h4 class="navbar-wrapper-title">Pengaturan</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">

            <div class="col-12">
                <div class="form-section">
                    <h4 class="section-title mt-3">Donasi</h4>
                    <div class="form-slider-group">
                        <h4 class="form-slider-label">Sembunyikan nama saya (Hamba Allah)</h4>
                        <label class="form-slider">
                            <input type="checkbox" name="is_anonymous" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <div class="form-slider-group with-info">
                        <div class="d-flex justify-content-start align-items-start flex-column w-75">

                            <h4 class="form-slider-label">Bersedia dihubungi melalui WhatsApp?</h4>
                            <h4 class="slider-info">Bersedia dihubungi melalui telepon atau WhatsApp untuk bertia program atau ajakan kebaikan lainnya</h4>
                        </div>
                        <label class="form-slider">
                            <input type="checkbox" name="whatsapp" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <h4 class="section-title">Keamanan akun</h4>

                    <div class="settings-choice">
                        <h4 class="settings-label">Ubah password</h4>
                        <a href="{{ url('reset-password') }}">
                            <img src="./assets/img/icons/choose-dark.svg" alt="">
                        </a>
                    </div>

                    <div class="settings-choice">
                        <h4 class="settings-label">Ubah nomor telepon / WhatsApp</h4>
                        <a href="#">
                            <img src="./assets/img/icons/choose-dark.svg" alt="">
                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./assets/js/global.js"></script>
<script src="./assets/js/payment.js"></script>
@endsection