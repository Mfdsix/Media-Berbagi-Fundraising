@extends('layouts.app')

@section('title', 'News')
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

    <title>News</title>
    <style>
        .news-card iframe{
            width: 100%;
            height: auto;
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
            <h4 class="navbar-wrapper-title">Kabar Terbaru</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">

            <div class="col-12">
                <div class="news-section">

                    @if (empty($update))
                    <div class="col-12">
                        <div class="news-section">
                            <div class="news-wrapper-center">
                                <h4 class="section-title">Kabar Terbaru</h4>
                                <div class="text-center p-4">
                                    <img src="{{ asset('images/doc-sleep 1.svg') }}" class="img-blank mb-2">
                                    <p class="text-muted">Belum ada kabar terbaru di program ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    @foreach ($update as $k => $v)
                    <div class="news-card">

                        <h4 class="news-date">{{ $v->date }}</h4>

                        @if($v->update_type == 1)
                    <h4 class="news-nominal">Pencairan dana Rp. {{ $v->nominal }}</h4>
                    @else
                    <h4 class="news-nominal">{{ $v->title ?? 'Update Berita' }}</h4>
                    @endif
                        <div class="news-content">
                            <div class="news-content-text">
                                {!! $v->content !!}
                            </div>
                        </div>
                        <button class="btn-read-more">Read more</button>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="../../assets/js/news.js"></script>
<script src="../../assets/js/global.js"></script>
@endsection
