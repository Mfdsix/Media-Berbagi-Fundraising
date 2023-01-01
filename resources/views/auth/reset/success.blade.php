@extends('layouts.mb-app')

@section('title', 'Lupa Password')
@section('css')
<!-- Required meta tags -->
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style type="text/css">
    .text-twelve{
        font-size: 13px;
        font-weight: bold;
        margin-top: 5px;
    }
    .h-full{
        height:calc(100vh - 75px);
    }
</style>
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Konfirmasi Password Baru'])
<div class="screen">
	<div class="row">
        <div class="col-12">

        <div class="bg-white rounded p-4 mb-2 h-full">
            <h5 class="text-dark-grey mb-3">Link verifikasi untuk atur ulang password sudah dikirim</h5>
            <p>Instruksi dan link verifikasi untuk mengatur ulang password anda sudah dikirim. Tolong cek email anda.</p>

            <a href="{{ url('/') }}" class="text-primary">Kembali ke halaman utama</a>
        </div>

        </div>
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