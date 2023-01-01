@extends('layouts.mb-app')

@section('title', 'Create Fundraiser')
@section('css')
@endsection

@section('content')
<!-- NAV TOP -->
<nav id="nav-top-secondary">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-2">
                <a href="/">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23 9.00024H3.0505L10.6895 1.72424C11.0895 1.34324 11.105 0.710244 10.724 0.310244C10.3435 -0.0892562 9.7105 -0.105256 9.31 0.275744L0.586 8.58574C0.2085 8.96374 0 9.46574 0 10.0002C0 10.5342 0.2085 11.0367 0.6035 11.4312L9.3105 19.7242C9.504 19.9087 9.752 20.0002 10 20.0002C10.264 20.0002 10.528 19.8962 10.7245 19.6897C11.1055 19.2897 11.09 18.6572 10.69 18.2762L3.019 11.0002H23C23.552 11.0002 24 10.5522 24 10.0002C24 9.44824 23.552 9.00024 23 9.00024V9.00024Z" fill="white"/>
                    </svg>
                </a>
            </div>
            <div class="col-8">
                <h1 class="nav-top-secondary__title">Create Fundraiser</h1>
            </div>
        </div>
    </div>
</nav>
<!-- PAGE FUNDRAISER SEBELUM LOGIN MAIN -->
<main id="page-fundraiser-belum-login" class="bg-white">
    <div class="container">
        <div class="row margin-b-24px">
            <div class="col-12 text-center">
                <h2 class="main-section-title-primary margin-b-8px">Galang Dana Sebagai Fundraiser</h2>
                <p class="p-fundraiser-text margin-b-16px">Dengan menjadi Fundraiser, kamu membantu menggalang dana ke penggalangan “Penggalangan Dana untuk Amin”.</p>
                <div class="line-1px"></div>
            </div>
        </div>
        <form method="post" class="row">
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="target_donasi">Target Donasi</label>
                <div class="position-relative">
                    <span id="input-fundraiser-id-rp">Rp.</span>
                    <input id="input-fundraiser-id-nominal" class="input-fundraiser-form font-weight-bold" type="number" value="0" required>
                </div>
                <small class="page-fundraiser__small__text">*minimal Rp.10.000.000</small>
            </div>
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="target_donasi">Judul Penggalangan</label>
                <input class="input-fundraiser-form" type="text" placeholder="Contoh : Penggalangan Dana untuk Amin" required>
            </div>
            <div class="col-12 margin-b-20px">
                <label class="label-fundraiser-text" for="target_donasi">Link Penggalangan</label>
                <div class="d-flex">
                    <span class="page-fundraiser__cover__link">kitabisa.com/</span>
                    <input class="input-fundraiser-form input-fundraiser-form__link" type="text" value="bantu-penggalangan-amin" required>
                </div>
            </div>
            <div class="col-12 margin-b-24px">
                <div class="page-fundraiser__box__green">
                    <div>
                        <label for="radio_setuju" class="page-fundraiser__box__checklist" data-input="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </label>
                        <input type="hidden" id="radio_setuju" value="yes">
                    </div>
                    <p class="p-fundraiser-text">Saya mengerti bahwa saya tidak bisa mencairkan dana yang terkumpul di penggalangan ini.</p>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="button-fundraiser-submit" disabled>Jadi Fundraiser</button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('js')
<!-- FUNDRAISER JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/fundraiser.js') }}"></script>
@endsection