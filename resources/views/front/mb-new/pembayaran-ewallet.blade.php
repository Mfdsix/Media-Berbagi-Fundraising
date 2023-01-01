@extends('layouts.mb-app')

@section('title', 'Instruksi Pembayaran')
@section('css')
@endsection

@section('content')
<!-- NAV TOP -->
@include('layouts.mb-nav-top-secondary-2', ['title' => 'Instruksi Pembayaran'])
<!-- MAIN: PEMBAYARAN EWALLET -->
<main id="page-main-ewallet" class="bg-white padding-b-125px">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-center mb-2">
                <h2 class="main-section-title-primary">Instruksi pembayaran</h2>
            </div>
            <div class="col-12 text-center">
                <p class="main-section-text-16 px-2">Segera buka <strong>Aplikasi E-Wallet</strong> di ponsel kamu lalu scan kode QR di bawah</p>
            </div>
        </div>
        <!-- BARCODE -->
        <div class="row mb-2">
            <div class="col-12 text-center">
                <img class="page-main-ewallet__barcode" src="{{ asset('assets/media-berbagi/assets/images/website/barcode.png') }}" alt="Barcode">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center px-2">
                <p class="main-section-text-14">Masa aktif pembayaran donasi kamu <strong>10 menit</strong> atau donasi kamu otomatis dibatalakan oleh sistem.</p>
            </div>
        </div>
        <!-- BOX -->
        <div class="row">
            <div class="col-12">
                <div class="page-main-ewallet__box">
                    <div class="mr-2">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_238_4901)">
                            <path d="M8.9817 1.56595C8.88271 1.39352 8.73998 1.25025 8.56791 1.15062C8.39584 1.051 8.20053 0.998535 8.0017 0.998535C7.80287 0.998535 7.60756 1.051 7.43549 1.15062C7.26343 1.25025 7.12069 1.39352 7.0217 1.56595L0.164702 13.233C-0.292298 14.011 0.255702 15 1.1447 15H14.8577C15.7467 15 16.2957 14.01 15.8377 13.233L8.9817 1.56595ZM7.9997 4.99995C8.5347 4.99995 8.9537 5.46195 8.8997 5.99495L8.5497 9.50195C8.53794 9.63972 8.4749 9.76806 8.37306 9.86159C8.27121 9.95511 8.13797 10.007 7.9997 10.007C7.86143 10.007 7.72819 9.95511 7.62635 9.86159C7.5245 9.76806 7.46146 9.63972 7.4497 9.50195L7.0997 5.99495C7.08713 5.86919 7.10105 5.74218 7.14055 5.62212C7.18005 5.50206 7.24426 5.3916 7.32905 5.29786C7.41383 5.20413 7.51731 5.12919 7.63282 5.07788C7.74833 5.02657 7.87331 5.00002 7.9997 4.99995ZM8.0017 11C8.26692 11 8.52127 11.1053 8.70881 11.2928C8.89634 11.4804 9.0017 11.7347 9.0017 12C9.0017 12.2652 8.89634 12.5195 8.70881 12.7071C8.52127 12.8946 8.26692 13 8.0017 13C7.73649 13 7.48213 12.8946 7.2946 12.7071C7.10706 12.5195 7.0017 12.2652 7.0017 12C7.0017 11.7347 7.10706 11.4804 7.2946 11.2928C7.48213 11.1053 7.73649 11 8.0017 11Z" fill="#FDB504"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_238_4901">
                            <rect width="16" height="16" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div>
                        <p class="main-section-text-14">Dana yang di donasikan melalui Media Berbagi bukan bersumber dan bukan untuk tujuan praktik pencucian uang (money laundry), termasuk teroris dan kejahatan keuangan lainnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- NAV BOTTOM -->
@include('layouts.mb-nav-bottom-share-penggalangan')
@endsection

@section('js')
<!-- PEMBAYARAN JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/pembayaran.js') }}"></script>
@endsection