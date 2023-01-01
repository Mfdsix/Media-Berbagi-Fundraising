@extends('layouts.app')

@section('title', 'Jadi Fundraiser')
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
<link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/variable.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/all-products.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

<style type="text/css">
    .text-twelve{
        font-size: 13px;
        font-weight: bold;
        margin-top: 5px;
    }
    .mb-3 .fc{
        left: 25px;
        top: 100px;
        background: #F1F1F1;
        border-radius: 13px;
    }
    .field-icon {
        position: absolute;
        right: 15px;
        top: 16px;
        bottom: 78.5%;
        color: #C4C4C4;
    }
    #btn-login  {
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
        margin-bottom: 31px;
    }

    #btn-login:hover {
        background-color: white;
        color: var(--primary);
        border-color: var(--primary);
    }
</style>
@endsection

@section('content')
@section('title', 'Masuk')

<div id="navbar-top">
    <div class="navbar-simple-wrapper">
        <button class="btn-transparent">
            <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                <img src="{{ asset('assets/img/icons/back-light.svg') }}" alt="">
            </a>
        </button>
        <h4 class="navbar-wrapper-title">Jadi Fundraiser</h4>
    </div>
</div>

<div class="screen">
    <div class="row">
        <div class="col-12">
            <div class="mt-0 main-width">

                <form form method="POST" action="{{ url('/fundraiser/register') }}" class="bg-white radius-20 p-4 mb-2">
                    @include('layouts.notif')
                    @csrf
                    <input type="hidden" name="project_slug" value="{{ $project->slug }}">
                    <div class="mb-3">
                        <label for="title">Judul Campaign</label>
                        <input type="text" required name="title" class="fc form-control @error('title') is-invalid @enderror radius-10" placeholder="{{ $project->title }}">
                        @error('title')
                        <div class="text-twelve text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="target">Target Donasi</label>
                        <input type="number" required min="10000" name="target" class="fc form-control @error('target') is-invalid @enderror radius-10" placeholder="10.000">
                        @error('target')
                        <div class="text-twelve text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug">Slug URL</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">{{ request()->getSchemeAndHttpHost() }}</span>
                            </div>
                            <input required type="text" name="slug" class="form-control @error('target') is-invalid @enderror" placeholder="{{ $project->slug }}" aria-describedby="basic-addon1">
                        </div>
                        @error('slug')
                        <div class="text-twelve text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-block" id="btn-login">Simpan</button>

                    <!-- <p class="text-secondary text-center">Belum punya akun ? <a class="text-primary" href="{{ url('register') }}">Daftar Sekarang</a></p> -->
                </form>
            </div>
        </div>
    </div>
    @endsection

    @section('js')
    <script>
        function goBack(){
            window.history.back();
        }
    </script>
    @endsection
