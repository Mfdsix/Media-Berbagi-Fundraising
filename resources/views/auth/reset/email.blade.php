@extends('layouts.mb-app')

@section('title', 'Lupa Password')
@section('css')
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Lupa Password'])
<!-- MAIN LOGIN PAGE -->
<main id="page-main-login" class="min-vh-100 bg-white">
    <div class="container">
        <form form method="POST" action="{{ url('/forgot-password') }}" class="row">
            @include('layouts.notif')
            @csrf
            @if(request()->has('t'))
            <input type="hidden" name="url" value="{{ trim(base64_decode(request()->t)) }}">
            @endif
            <div class="col-12 mb-2">
                <input class="nav-top-primary-image__input" type="email" name="email" placeholder="Alamat Email" value="{{old('')}}" required>
                @error('email')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 mb-4">
                <button type="submit" class="nav-top-primary-image__button__login">Kirim Link Reset Password</button>
            </div>
            <div class="col-12 text-center mb-4">
                <p class="nav-top-primary-image__daftar__sekarang">Belum punya akun? <a href="{{ url('register') }}">Daftar sekarang</a></p>
            </div>
            <!-- <div class="line-10px mb-4"></div>
            <div class="col-12 text-center mb-3">
                <p class="nav-top-primary-image__atau__masuk">Atau masuk dengan</p>
            </div>
            <div class="col-12 mb-2">
                <img class="nav-top-primary-image__image__gf" src="{{ asset('assets/media-berbagi/assets/images/website/nav-login-google.png') }}" alt="#">
                <button type="button" class="nav-top-primary-image__button__gf">Google</button>
            </div>
            <div class="col-12 mt-1">
                <img class="nav-top-primary-image__image__gf" src="{{ asset('assets/media-berbagi/assets/images/website/nav-login-facebook.png') }}" alt="#">
                <button type="button" class="nav-top-primary-image__button__gf">Facebook</button>
            </div> -->
        </form>
    </div>
</main>
@endsection

@section('js')
@endsection
