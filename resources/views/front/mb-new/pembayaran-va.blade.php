@extends('layouts.mb-app')

@section('title', 'Detail Pembayaran')
@section('css')
@endsection

@section('content')
<!-- NAV TOP -->
@include('layouts.mb-nav-top-secondary', ['title' => 'Detail Pembayaran'])
<!-- MAIN: PEMBAYARAN VIRTUAL ACCOUNT -->
<main id="page-main-va" class="bg-white padding-b-125px">
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-center mb-2">
                <h2 class="main-section-title-primary">Instruksi pembayaran</h2>
            </div>
            <div class="col-12 text-center mb-2">
                <p class="main-section-text-16 px-2">Transfer sesuai nominal dibawah ini:</p>
            </div>
            <div class="col-12 position-relative">
                <input class="page-main-va__input__nominal" type="text" value="Rp1.500.000" disabled>
                <button class="page-main-va__salin__nominal" type="button" onclick="copyToClipboard('page-main-va__input__nominal')">Salin</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 text-center mb-2">
                <p class="main-section-text-16 px-2">ke rekening <strong>Mandiri Virtual Account</strong>:</p>
            </div>
            <div class="col-12 position-relative">
                <img class="page-main-va__image__rekening" src="{{ asset('assets/media-berbagi/assets/images/website/va-mandiri.png') }}" alt="Virtual Account">
                <input class="page-main-va__input__rekening" type="text" value="7007049017774" disabled>
                <button class="page-main-va__salin__rekening" type="button" onclick="copyToClipboard('page-main-va__input__rekening')">Salin</button>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 text-center">
                <p class="main-section-text-14 px-2">Transfer sebelum <strong>18 Jul 2021 21:00 WIB (20:32:22)</strong> atau donasi kamu otomatis dibatalkan oleh sistem.</p>
            </div>
        </div>
        <!-- BOX -->
        <div class="row margin-b-25px">
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
        <!-- LINE -->
        <div class="line-7px-plus-30px margin-b-25px"></div>
        <!-- PANDUAN PEMBAYARAN -->
        <div class="row">
            <div class="col-12">
                <h4 class="page-main-va__panduan__title">Panduan pemabayaran</h4>
            </div>
            <div class="col-12">
                <div class="page-main-va__accordion">
                    <article class="page-main-va__accordion__list">
                        <div class="page-main-va__accordion-trigger d-flex align-items-center justify-content-between p-3" style="cursor: pointer;">
                            <h4 class="page-main-va__panduan__subtitle">Mandiri m-Banking</h4>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_238_4647)">
                                <path d="M7.49963 10.6496L13.7933 4.3539C14.0688 4.07764 14.0688 3.63007 13.7933 3.35312C13.5177 3.07687 13.0701 3.07687 12.7946 3.35312L7.00032 9.14948L1.20605 3.35382C0.930493 3.07756 0.482919 3.07756 0.206666 3.35382C-0.0688888 3.63007 -0.0688888 4.07834 0.206666 4.35459L6.50025 10.6503C6.77296 10.9223 7.22757 10.9223 7.49963 10.6496Z" fill="#363636"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_238_4647">
                                <rect width="14" height="14" fill="white" transform="translate(0 14) rotate(-90)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="page-main-va__accordion__item pt-1 pb-4 px-3">
                            <div class="d-flex align-items-start">
                                <div class="mr-1">1.</div>
                                <p>Login Mandiri Online dengan username dan password kamu.</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">2.</div>
                                <p>Pilih menu "Pembayaran" lalu pilih menu "Multipayment".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">3.</div>
                                <p>Pilih penyedia jasa "Prismalink International".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">4.</div>
                                <p>Masukkan 7007099918674 dan "Nominal" yang akan dibayarkan, lalu pilih "Lanjut".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">5.</div>
                                <p>Setelah muncul tagihan, pilih "Konfirmasi".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">6.</div>
                                <p>Masukkan PIN Mandiri Online.</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">7.</div>
                                <p>Transaksi selesai, simpan bukti bayar kamu.</p>
                            </div>
                        </div>
                    </article>
                    <article class="page-main-va__accordion__list">
                        <div class="page-main-va__accordion-trigger d-flex align-items-center justify-content-between p-3" style="cursor: pointer;">
                            <h4 class="page-main-va__panduan__subtitle">Mandiri Internet Banking</h4>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_238_4647)">
                                <path d="M7.49963 10.6496L13.7933 4.3539C14.0688 4.07764 14.0688 3.63007 13.7933 3.35312C13.5177 3.07687 13.0701 3.07687 12.7946 3.35312L7.00032 9.14948L1.20605 3.35382C0.930493 3.07756 0.482919 3.07756 0.206666 3.35382C-0.0688888 3.63007 -0.0688888 4.07834 0.206666 4.35459L6.50025 10.6503C6.77296 10.9223 7.22757 10.9223 7.49963 10.6496Z" fill="#363636"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_238_4647">
                                <rect width="14" height="14" fill="white" transform="translate(0 14) rotate(-90)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="page-main-va__accordion__item pt-1 pb-4 px-3">
                            <div class="d-flex align-items-start">
                                <div class="mr-1">1.</div>
                                <p>Login Mandiri Online dengan username dan password kamu.</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">2.</div>
                                <p>Pilih menu "Pembayaran" lalu pilih menu "Multipayment".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">3.</div>
                                <p>Pilih penyedia jasa "Prismalink International".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">4.</div>
                                <p>Masukkan 7007099918674 dan "Nominal" yang akan dibayarkan, lalu pilih "Lanjut".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">5.</div>
                                <p>Setelah muncul tagihan, pilih "Konfirmasi".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">6.</div>
                                <p>Masukkan PIN Mandiri Online.</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">7.</div>
                                <p>Transaksi selesai, simpan bukti bayar kamu.</p>
                            </div>
                        </div>
                    </article>
                    <article class="page-main-va__accordion__list">
                        <div class="page-main-va__accordion-trigger d-flex align-items-center justify-content-between p-3" style="cursor: pointer;">
                            <h4 class="page-main-va__panduan__subtitle">Mandiri Internet Banking</h4>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_238_4647)">
                                <path d="M7.49963 10.6496L13.7933 4.3539C14.0688 4.07764 14.0688 3.63007 13.7933 3.35312C13.5177 3.07687 13.0701 3.07687 12.7946 3.35312L7.00032 9.14948L1.20605 3.35382C0.930493 3.07756 0.482919 3.07756 0.206666 3.35382C-0.0688888 3.63007 -0.0688888 4.07834 0.206666 4.35459L6.50025 10.6503C6.77296 10.9223 7.22757 10.9223 7.49963 10.6496Z" fill="#363636"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_238_4647">
                                <rect width="14" height="14" fill="white" transform="translate(0 14) rotate(-90)"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="page-main-va__accordion__item pt-1 pb-4 px-3">
                            <div class="d-flex align-items-start">
                                <div class="mr-1">1.</div>
                                <p>Login Mandiri Online dengan username dan password kamu.</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">2.</div>
                                <p>Pilih menu "Pembayaran" lalu pilih menu "Multipayment".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">3.</div>
                                <p>Pilih penyedia jasa "Prismalink International".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">4.</div>
                                <p>Masukkan 7007099918674 dan "Nominal" yang akan dibayarkan, lalu pilih "Lanjut".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">5.</div>
                                <p>Setelah muncul tagihan, pilih "Konfirmasi".</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">6.</div>
                                <p>Masukkan PIN Mandiri Online.</p>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="mr-1">7.</div>
                                <p>Transaksi selesai, simpan bukti bayar kamu.</p>
                            </div>
                        </div>
                    </article>
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