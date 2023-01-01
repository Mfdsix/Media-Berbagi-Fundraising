@extends('layouts.mb-app')

@section('title', 'Detail Donasi')
@section('css')
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Detail Donasi'])
<!-- MAIN PAGE DETAIL DONASI -->
<main id="page-detail-donasi">
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
                        <strong class="page-detail-donasi__box__text__right">#27667502</strong>
                    </div>
                    <div class="page-detail-donasi__box__list">
                        <span class="page-detail-donasi__box__text__left">Tanggal</span>
                        <strong class="page-detail-donasi__box__text__right">04 Okt 2021 - 05:14</strong>
                    </div>
                    <div class="page-detail-donasi__box__list">
                        <span class="page-detail-donasi__box__text__left">Metode Pembayaran</span>
                        <strong class="page-detail-donasi__box__text__right">Dompet Kebaikan</strong>
                    </div>
                    <div class="page-detail-donasi__box__list">
                        <span class="page-detail-donasi__box__text__left">Status</span>
                        <div class="page-detail-donasi__box__text__status page-detail-donasi__box__text__status-green">Berhasil</div>
                    </div>
                    <div class="page-detail-donasi__box__list">
                        <span class="page-detail-donasi__box__text__left">Nominal</span>
                        <strong class="page-detail-donasi__box__text__right">Rp50.000</strong>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button type="button" class="page-detail-donasi__download">Download Sertifikat</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div class="page-detail-donasi__article__left">
                    <img src="{{ asset('assets/media-berbagi/assets/images/articles/detail-donasi-1.png') }}" alt="Histori Transaksi">
                </div>
                <div class="page-detail-donasi__article__right">
                    <h2 class="page-detail-donasi__article__title"><a href="#">Banjir Rendam 31 Desa Hingga 1 Meter!</a></h2>
                    <p class="page-detail-donasi__article__author">BMH Jakarta</p>
                    <a href="./pembayaran-donasi.html" class="page-detail-donasi__article__link">Donasi lagi</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<!-- DONASI SAYA JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/donasi-saya.js') }}"></script>
@endsection