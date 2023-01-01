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
    <link rel="stylesheet" href="../../assets/css/global.css">
<link rel="stylesheet" href="../../assets/css/variable.css">
    <link rel="stylesheet" href="../../assets/css/detail.css">

    <title>Semua Fundraiser</title>
    <style>
        .img-username{
        width: 55px;
        height: 55px;
        background-color: #e3e6fd;
        border-radius: 6px;
        color: #616267;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        font-weight: bold;
    }
    </style>
@endsection

@section('content')
    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button class="btn-transparent">
                <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                    <img src="../../assets/img/icons/back-light.svg" alt="">
                </a>
            </button>
            <h4 class="navbar-wrapper-title">List Fundraiser</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">

            <div class="col-12">
                <div class="fundraiser-section">
                    @foreach($datas as $k => $v)
                    <div class="donatur-card">
                        <!-- <img src="../../assets/img/detail/donatur.png" alt="" class="donatur-profile"> -->
                        <div class="img-username">{{ $v->photo }}</div>

                        <div class="donatur-info">
                            <h4 class="donatur-name">{{ $v->name }}</h4>
                            @if($v->referred <= 0)
                        <h4 class="donatur-nominal">Belum ada donasi</h4>
                        @else
                        <h4 class="donatur-nominal">Berhasil mengajak {{ $v->referred }} orang untuk berdonasi</h4>
                        @endif
                        <h4 class="donatur-date">Rp {{ $v->collected }}</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <div id="navbar-bottom">
            <a href="/fundraiser/register?p={{ base64_encode($project->slug) }}" class="btn-be-fundraiser">Jadi Fundraiser</a>
        <!-- <a href="#" class="btn-invite-fundraiser">Undang Fundraiser</a> -->
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="../../assets/js/news.js"></script>
<script src="../../assets/js/global.js"></script>
@endsection
