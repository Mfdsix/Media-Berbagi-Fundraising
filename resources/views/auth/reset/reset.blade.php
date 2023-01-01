@extends('layouts.mb-app')

@section('title', 'Lupa Password')
@section('css')
<style type="text/css">
    .text-twelve{
        font-size: 13px;
        font-weight: bold;
        margin-top: 5px;
    }
    .body-section form{
        min-height: calc(100vh - 75px);
    }
    .btn-primary{
        background-color:var(--primary-color);
    }
</style>
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Reset Password'])

<div class="main-width">
    <div class="body-section">

        <form form method="POST" action="{{ url('/reset-password') }}" class="bg-white rounded p-4 mb-2">
            @csrf
            <!-- <img src="{{ asset('images/logo.png') }}" height="80px"> -->
            <h5 class="text-dark-grey mb-3">New Password</h5>
            <p>Kata sandi baru Anda harus berbeda dari kata sandi yang digunakan sebelumnya.</p> <br>
            <input type="hidden" name="email" value="{{ request()->e }}">
            <input type="hidden" name="token" value="{{ request()->t }}">
            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru">
                @error('password')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Ulangi Password Baru">
                @error('password_confirmation')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button class="mt-3 mb-2 py-2 btn btn-primary btn-block font-weight-bold">Reset Password</button>
        </form>

    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    function goBack(){
        window.history.back();
    }
</script>
@endsection