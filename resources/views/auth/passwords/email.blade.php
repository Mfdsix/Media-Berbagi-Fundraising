@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="main-width">
    <div class="body-section px-4 medium-width">

        <div class="card">

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="p-4 radius-20">
                    @csrf
                    <h5>Reset Password</h5>

                    <p>Masukkan email yang terdaftar. Kami akan mengirimkan link verifikasi untuk mengatur ulang kata sandi.</p>
                    <div class="form-group">
                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                       @error('email')
                       <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn-block btn btn-accent">Kirim Link Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
