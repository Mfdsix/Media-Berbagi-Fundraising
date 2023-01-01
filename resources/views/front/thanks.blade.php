@extends('layouts.mb-app')

@section('title', 'Terimakasih')

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Terimakasih'])

<style>#nav-top-secondary{position:fixed !important}.btn-wrap{position:fixed;bottom:0;width:100%;left:50%;max-width: 576px;transform:translateX(-50%)}.img-ovo{max-width:240px}.btn-next{background:var(--primary-color);color:white;}</style>
<div class="p-4 d-flex flex-column justify-content-center align-items-center" id="wrap" style="background:white;height:100vh;">
    <img src="{{ asset('assets/media-berbagi/animation_500_ky8pg8aq.gif') }}" alt="" style="width:100%;max-width:200px;">
	@if($data->status == 'paid')
    <h4 class="text-center">Alhamdulillah transaksi sukses, terimakasih telah melakukan donasi</h4>
	@elseif($data->status == 'pending')
    <h4 class="text-center">Masih ada transaksi menunggu, selesaikan pembayaran anda segera</h4>
	@endif
    <div class="btn-wrap p-4">
        <a href="{{ url('/donation/' . $data->id) }}" class="btn btn-block rounded-pill py-3 btn-next">Lihat Detail</a>
    </div>
</div>
<script>
    document.getElementById('wrap').style.height = window.innerHeight+'px'
</script>
@endsection