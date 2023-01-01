@extends('layouts.mb-app')

@section('title', 'Akun Saya')
@section('css')
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary-2', ['title' => 'Akun Saya'])

<!-- MAIN -->
<main id="main-page-belum-login" class="min-vh-100 bg-white padding-b-100px">
    <div class="container">
        @if($user && $user->level == 'user')
        <div class="row mb-4">
            <div class="col-12 text-center mb-3">
                <div class="akun-image-circle mx-auto">
                    @if(Auth::user()->path_foto == null)
                    <img class="h-20px w-20px" src="{{ getThumb(asset('images/user.png'),128,128) }}" alt="Akun">
                    @else
                    <img class="h-20px w-20px" src="{{ getThumb( asset('/storage/'.Auth::user()->path_foto),128,128) }}" alt="Akun">
                    @endif
                </div>
            </div>
            <div class="col-12 text-center margin-b-24px">
                <div class="position-relative">
                    <b>{{ $user->name }}</b>
                    <a href="{{ url('my-account/edit') }}" class="akun-login-input-pencil">
                        <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-pencil.svg') }}" alt="#">
                    </a>
                </div>
                @if(Auth::user()->is_fundraiser == 0)
                <p class="akun-login-founder">Donatur {{ envdb('APP_NAME') }}</p>
                @else
                <p class="akun-login-founder">Fundraiser {{ envdb('APP_NAME') }}</p>
                @endif
            </div>
            <style>
                .fundraiser{
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    background-color:#F2994A;
                    padding: 16px 24px;
                    border-radius:4px;
                    font-weight:bold;
                    color:white;
                    filter: drop-shadow(0px 4px 12px rgba(242, 153, 74, 0.4));
                }
                .fundraiser:hover{
                    color:white;
                    background-color:#d37e33;
                }
            </style>
            @if(Auth::user()->is_fundraiser == 0)
            <div class="col-12">
                <a href="{{ url('register/fundraiser') }}" class="fundraiser">
                    <div>Jadi Fundraiser Sekarang</div>
                    <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L9 8.5L1 16" stroke="white" stroke-width="2" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            @endif
        </div>
        <div class="line-7px-plus-30px margin-b-25px"></div>
        <div class="row py-2">
		@if(Auth::user()->email_verified_at == null)
        {{-- show session message success --}}
        @if(session()->has('success'))
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
		<div class="col-12 margin-b-28px">
		<div class="alert alert-warning">
                	Email anda belum di verikasi! <a href="?resend=1" style="text-decoration: underline !important">Resend Email</a>
                </div>
		</div>
		@endif
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-user.svg') }}" alt="#">
                </div>
                <a href="{{ url('my-account/edit') }}" class="akun-label-icon">Profil Saya</a>
            </div>
            @if(Auth::user()->is_fundraiser == 1)
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-fundraiser.svg') }}" alt="#">
                </div>
                <a href="{{ url('fundraiser/transaction') }}" class="akun-label-icon">Histori Transaksi Fundraiser</a>
            </div>
            @endif
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-history.svg') }}" alt="#">
                </div>
                <a href="{{ url('donation') }}" class="akun-label-icon">Histori Transaksi</a>
            </div>
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-favorit.svg') }}" alt="#">
                </div>
                <a href="{{ url('program/favourite') }}" class="akun-label-icon">Program Favorit</a>
            </div>
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-laporan.svg') }}" alt="#">
                </div>
                <a href="#" class="akun-label-icon">Laporan</a>
            </div>
        </div>
        <div class="line-7px-plus-30px margin-b-25px"></div>
        @else
        <div class="row">
            <div class="col-12">
                <h2 class="main-page-belum-login__title text-center">Yuk, masuk untuk menikmati kemudahan berdonasi dan fitur lainnya</h2>
            </div>
            <div class="col-12">
                <a href="/login" class="main-page-belum-login__button__masuk">Masuk Sekarang</a>
            </div>
            <div class="col-12 text-center main-page-belum-login__belum__punya__akun">Belum punya akun? <a href="/register" class="color-green-1">Daftar Sekarang</a></div>
        </div>
        @endif
        @if($user && $user->level == 'user')
        @else
        <div class="line-1px my-4"></div>
        @endif
        <div class="row">
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img style="width: 26px;height: 26px" src="{{ asset('images/calculator.svg') }}" alt="#">
                </div>
                <a href="{{ url('kalkulator') }}" class="akun-label-icon">Kalkulator zakat</a>
            </div>
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-edukasi.svg') }}" alt="#">
                </div>
                <a href="#" class="akun-label-icon">Ruang Edukasi</a>
            </div>
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-bantuan.svg') }}" alt="#">
                </div>
                <a href="{{ url('help') }}" class="akun-label-icon">Bantuan</a>
            </div>
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-tentang.svg') }}" alt="#">
                </div>
                <a href="{{ url('about-us') }}" class="akun-label-icon">Tentang {{envdb('APP_NAME')}}</a>
            </div>
            <div class="col-12 d-flex align-items-center margin-b-28px">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-syarat.svg') }}" alt="#">
                </div>
                <a href="{{ url('term-condition') }}" class="akun-label-icon">Syarat & Ketentuan</a>
            </div>
            <div class="col-12 d-flex align-items-center">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-review.svg') }}" alt="#">
                </div>
                <a href="#" class="akun-label-icon">Berikan Rating untuk aplikasi</a>
            </div>
        </div>
        @if($user && $user->level == 'user')
        <div class="row">
            <div class="col-12 mt-5">
                <a href="javascript:void(0)" onclick="$('#form-logout').submit()" class="akun-button-keluar">Keluar</a>
            </div>
        </div>
        @else
        <div class="line-1px my-4"></div>
        <div class="row">
            <div class="col-12">
                <p class="main-page-belum-login__versi">Versi {{exec("git tag")}}</p>
            </div>
        </div>
        @endif
    </div>
</main>
            
<form method="post" action="{{ url('logout') }}" style="display: none;" id="form-logout">
    @csrf
</form>
@include('layouts.mb-nav-bottom-primary', ['active' => 'akun'])
@endsection

@section('js')

@endsection
