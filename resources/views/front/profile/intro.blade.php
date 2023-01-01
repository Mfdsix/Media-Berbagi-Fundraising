@extends('layouts.mb-app')

@section('title', 'Profil')
@section('css')
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary-2', ['title' => 'Profil'])

@section('content')
<!-- MAIN -->
<main id="main-page-sudah-login" class="min-vh-100 bg-white">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center mb-3">
                <div class="akun-image-circle mx-auto">
                    <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/users/user-2.png') }}" alt="Akun">
                </div>
            </div>
            <div class="col-12 text-center margin-b-24px">
                <div class="position-relative">
                    <input class="akun-login-input-username" type="text" value="{{ $user->name }}">
                    <button type="button" class="akun-login-input-pencil">
                        <img class="h-20px w-20px" src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-pencil.svg') }}" alt="#">
                    </button>
                </div>
                <p class="akun-login-founder">Fundraser Mediaberbagi</p>
            </div>
        </div>
        @if($user->is_fundraiser == 1)
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div class="w-45pc text-center">
                    <p class="akun-text-two-line-title">Pencapian</p>
                    <div class="akun-text-two-line-text">{{ $fundraiser->funnel }}%
                        <!-- <sup class="d-inline-flex align-items-center color-green-2"><svg width="7" height="8" viewBox="0 0 7 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 2.85295L3.47061 1L5.94121 2.85295" stroke="currentColor"/>
                        <path d="M3.4707 1.30884V7.17653" stroke="currentColor"/> -->
                        <!-- </svg>10%</sup> -->
                    </div>
                </div>
                <div class="mx-auto">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-line.svg') }}">
                </div>
                <div class="w-45pc text-center">
                    <p class="akun-text-two-line-title">Total Klik</p>
                    <div class="akun-text-two-line-text">{{ $fundraiser->clicks }}</div>
                </div>
            </div>
        </div>
        @endif
        <div class="row mb-4">
            @if($user->is_fundraiser == 1)
            <a href="/fundraiser" class="col-12 d-flex flex-wrap align-items-center pt-3">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-chart.svg') }}" alt="#">
                </div>
                <span class="akun-label-icon-2">Buka Dashboard</span>
                <div class="ml-auto">
                    <span class="akun-label-new py-1 px-3 mr-4">New</span>
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-right.svg') }}" alt="#">
                </div>
                <div class="w-100 mt-3" style="border-bottom: 0.5px solid #DFDFDF;"></div>
            </a>
            @endif
            <a href="{{ url('help') }}" class="col-12 d-flex flex-wrap align-items-center pt-3">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-help.svg') }}" alt="#">
                </div>
                <span class="akun-label-icon-2">Bantuan</span>
                <div class="ml-auto">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-right.svg') }}" alt="#">
                </div>
                <div class="w-100 mt-3" style="border-bottom: 0.5px solid #DFDFDF;"></div>
            </a>
        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <a href="javascript:void(0)" onclick="$('#form-logout').submit()" class="akun-button-keluar">Keluar</a>
            </div>
        </div>
    </div>
</main>

<form method="post" action="{{ url('logout') }}" style="display: none;" id="form-logout">
    @csrf
</form>
@include('layouts.mb-nav-bottom-primary', ['active' => 'akun'])
@endsection

@section('js')
<script type="text/javascript">
    function goBack(){
        window.location.href = "{{ url('my-account') }}";
    }
</script>
@endsection
