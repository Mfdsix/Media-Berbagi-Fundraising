@extends('layouts.mb-app')

@section('title', 'Daftar')
@section('css')
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary-2', ['title' => 'Daftar'])
<main id="page-main-daftar" class="min-vh-100 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="nav-top-primary-image_title pr-3 text-left">Yuk bergabung dengan {{envdb('APP_NAME')}} untuk nikmati kemudahan berdonasi dan akses fitur lainnya</h4>
            </div>
        </div>
        <form form method="POST" action="{{ route('register') }}" class="row">
            @csrf
            <div class="col-12 mb-2">
                <input class="nav-top-primary-image__input" type="text" value="{{ old('name') }}" name="name" placeholder="Nama Lengkap">
                @error('name')
                    <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mb-2 mt-1">
                <input class="nav-top-primary-image__input" type="email" value="{{ old('email') }}" name="email" placeholder="Alamat Email">
                @error('email')
                    <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mb-2 mt-1">
                <input class="nav-top-primary-image__input" type="text" value="{{ old('phone') }}" name="phone" placeholder="Nomor Telepon">
                @error('phone')
                    <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mb-2 mt-1">
                <input class="nav-top-primary-image__input" type="password" name="password" placeholder="Kata Sandi">
                @error('password')
                    <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mb-5">
                <input class="nav-top-primary-image__input" type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi">
                @error('password_confirmation')
                    <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mb-4">
                <button type="submit" class="nav-top-primary-image__button__login">Daftar</button>
            </div>
            <div class="col-12 text-center mb-4">
                <p class="nav-top-primary-image__daftar__sekarang">Sudah punya akun? <a href="{{ url('login') }}">Masuk sekarang</a></p>
            </div>
        </form>
    </div>
</main>
@include('layouts.mb-nav-bottom-primary', ['active' => 'akun'])
@endsection

@section('js')
@endsection
