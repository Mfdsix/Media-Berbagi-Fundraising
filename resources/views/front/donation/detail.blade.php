@extends('layouts.mb-app')

@section('title', 'Detail Donasi')
@section('css')
@endsection

@section('content')
<nav id="nav-top-secondary">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-2">
                <a {{ request()->get('isback') ? "href=# onclick=history.back()" : "href=/" }}>
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23 9.00024H3.0505L10.6895 1.72424C11.0895 1.34324 11.105 0.710244 10.724 0.310244C10.3435 -0.0892562 9.7105 -0.105256 9.31 0.275744L0.586 8.58574C0.2085 8.96374 0 9.46574 0 10.0002C0 10.5342 0.2085 11.0367 0.6035 11.4312L9.3105 19.7242C9.504 19.9087 9.752 20.0002 10 20.0002C10.264 20.0002 10.528 19.8962 10.7245 19.6897C11.1055 19.2897 11.09 18.6572 10.69 18.2762L3.019 11.0002H23C23.552 11.0002 24 10.5522 24 10.0002C24 9.44824 23.552 9.00024 23 9.00024V9.00024Z" fill="white"></path>
                    </svg>
                </a>
            </div>
            <div class="col-8">
                <h1 class="nav-top-secondary__title">Detail Donasi</h1>
            </div>
        </div>
    </div>
</nav>

    <!-- MAIN PAGE DETAIL DONASI -->
    <main id="page-detail-donasi" class="min-vh-100 bg-white padding-b-50px">
        <div class="container">
            <div class="row py-4">
                <div class="col-12 text-center">
                    <h6 class="main-section-title-primary mb-1">Terima kasih!</h6>
                    <p class="main-section-text-16">Donasimu telah diterima dan akan segera disalurkan</p>
                </div>
            </div>
            <div class="row margin-b-28px">
                <div class="col-12">
                    <div class="page-detail-donasi__box">
                        <div class="page-detail-donasi__box__list">
                            <span class="page-detail-donasi__box__text__left">Id Donasi</span>
                            <strong class="page-detail-donasi__box__text__right">{{ "INV-" . $data->created_at->format('ymd').sprintf("%05d", $data->id) }}</strong>
                        </div>
                        <div class="page-detail-donasi__box__list">
                            <span class="page-detail-donasi__box__text__left">Tanggal</span>
                            <strong class="page-detail-donasi__box__text__right">{{ $data->created_at->format('d F Y') }}</strong>
                        </div>
                        <div class="page-detail-donasi__box__list">
                            <span class="page-detail-donasi__box__text__left">Metode Pembayaran</span>
                            <strong class="page-detail-donasi__box__text__right">{{ $data->payment_method }}</strong>
                        </div>
                        <div class="page-detail-donasi__box__list">
                            <span class="page-detail-donasi__box__text__left">Status</span>
                            <div class="page-detail-donasi__box__text__status page-detail-donasi__box__text__status-green">
                                @if($data->status == 'canceled')
                            <span class="text-danger">Dibatalkan</span>
                            @elseif($data->status == 'pending')
                            <span class="text-default">Menunggu</span>
                            @elseif($data->status == 'waiting')
                            <span class="text-primary">Menunggu Verifikasi</span>
                            @elseif($data->status == 'rejected')
                            <span class="text-danger">Bukti Ditolak</span>
                            @elseif($data->status == 'paid')
                            <span class="text-primary">Berhasil</span>
                            @endif
                            </div>
                        </div>
                        <div class="page-detail-donasi__box__list">
                            <span class="page-detail-donasi__box__text__left">Nominal</span>
                            <strong class="page-detail-donasi__box__text__right">{{ $data->nominal }}</strong>
                        </div>
                    </div>
                </div>

                @if($data->status == 'paid')
                <div class="col-12">
                    <a href="{{ url('/') }}" class="page-detail-donasi__download">Donasi lagi</a>
                    <a href="{{ url('invoice/'.$data->id) }}" class="page-detail-donasi__download">Download Invoice</a>
                </div>
                @elseif($data->status == 'pending'||$data->status == 'waiting')
                <div class="col-12">
                    <button onclick="window.open('{{ url('payment/'.$data->id.'/how_to_pay') }}','_blank','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')" class="page-detail-donasi__download">Instruksi Pembayaran</button>
                </div>
                @endif

            </div>
        </div>
    </main>
@endsection

@section('js')
<!-- DONASI SAYA JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/donasi-saya.js') }}"></script>
@endsection
