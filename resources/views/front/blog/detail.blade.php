@extends('layouts.mb-app')

@section('title', 'Detail Article')
@section('css')
<style>
    #nav-top-secondary {
        position: fixed;
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        transition: 0.2s ease-in;
    }
    .nav-top-secondary__title {
        /* width: 250px; */
        text-overflow: ellipsis;
        overflow: hidden; 
        white-space: nowrap;
    }
    </style>
@endsection

@section('content')
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
                <h1 class="nav-top-secondary__title">{{ $blog->title }}</h1>
            </div>
            <div class="col-2 text-right">
                <button type="button" class="header-button-share">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.3528 15.5662C17.895 15.5662 16.59 16.2313 15.7241 17.2737L10.0913 14.0756C10.2665 13.5827 10.3628 13.0527 10.3628 12.5003C10.3628 11.9481 10.2665 11.4181 10.0913 10.9252L15.7236 7.72635C16.5894 8.76908 17.8947 9.43431 19.3526 9.43431C21.953 9.43431 24.0686 7.31793 24.0686 4.71644C24.0688 2.11572 21.9532 0 19.3528 0C16.7521 0 14.6362 2.11572 14.6362 4.71633C14.6362 5.26867 14.7324 5.79878 14.9077 6.29181L9.27505 9.49075C8.40924 8.44857 7.10432 7.78378 5.64689 7.78378C3.04584 7.78378 0.929688 9.8995 0.929688 12.5002C0.929688 15.1008 3.04584 17.2165 5.64689 17.2165C7.10432 17.2165 8.40913 16.5518 9.27494 15.5097L14.9077 18.7079C14.7324 19.2009 14.6361 19.7311 14.6361 20.2836C14.6361 22.8842 16.752 24.9999 19.3527 24.9999C21.9531 24.9999 24.0687 22.8841 24.0687 20.2836C24.0688 17.6825 21.9532 15.5662 19.3528 15.5662ZM19.3528 1.65041C21.0431 1.65041 22.4184 3.02576 22.4184 4.71633C22.4184 6.40778 21.0431 7.78378 19.3528 7.78378C17.6621 7.78378 16.2867 6.40778 16.2867 4.71633C16.2867 3.02576 17.6621 1.65041 19.3528 1.65041ZM5.647 15.5662C3.95599 15.5662 2.58021 14.1908 2.58021 12.5003C2.58021 10.8096 3.95599 9.43431 5.647 9.43431C7.33735 9.43431 8.71248 10.8096 8.71248 12.5003C8.71248 14.1908 7.33724 15.5662 5.647 15.5662ZM19.3528 23.3496C17.6621 23.3496 16.2867 21.9741 16.2867 20.2837C16.2867 18.5926 17.6621 17.2167 19.3528 17.2167C21.0431 17.2167 22.4184 18.5926 22.4184 20.2837C22.4184 21.9741 21.0431 23.3496 19.3528 23.3496Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
<!-- HEADER DETAIL-ARTICLE -->
<header id="page-detail-article-header" style="background-image: url('{{ asset('storage/'.$blog->featured) }}');">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <a href="/blog">
                    <svg width="23" height="19" viewBox="0 0 23 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.0417 8.55007H2.9234L10.2441 1.63795C10.6274 1.27601 10.6423 0.674662 10.2772 0.294667C9.91252 -0.0848534 9.3059 -0.100053 8.92208 0.261892L0.561583 8.1563C0.199812 8.51539 0 8.99229 0 9.50006C0 10.0073 0.199812 10.4847 0.578354 10.8595L8.92256 18.7377C9.108 18.913 9.34567 18.9999 9.58333 18.9999C9.83633 18.9999 10.0893 18.9011 10.2776 18.705C10.6428 18.325 10.6279 17.7241 10.2446 17.3622L2.89321 10.45H22.0417C22.5707 10.45 23 10.0244 23 9.50006C23 8.97566 22.5707 8.55007 22.0417 8.55007Z" fill="white"/>
                    </svg>
                </a>
                <button type="button" class="header-button-share">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.3528 15.5662C17.895 15.5662 16.59 16.2313 15.7241 17.2737L10.0913 14.0756C10.2665 13.5827 10.3628 13.0527 10.3628 12.5003C10.3628 11.9481 10.2665 11.4181 10.0913 10.9252L15.7236 7.72635C16.5894 8.76908 17.8947 9.43431 19.3526 9.43431C21.953 9.43431 24.0686 7.31793 24.0686 4.71644C24.0688 2.11572 21.9532 0 19.3528 0C16.7521 0 14.6362 2.11572 14.6362 4.71633C14.6362 5.26867 14.7324 5.79878 14.9077 6.29181L9.27505 9.49075C8.40924 8.44857 7.10432 7.78378 5.64689 7.78378C3.04584 7.78378 0.929688 9.8995 0.929688 12.5002C0.929688 15.1008 3.04584 17.2165 5.64689 17.2165C7.10432 17.2165 8.40913 16.5518 9.27494 15.5097L14.9077 18.7079C14.7324 19.2009 14.6361 19.7311 14.6361 20.2836C14.6361 22.8842 16.752 24.9999 19.3527 24.9999C21.9531 24.9999 24.0687 22.8841 24.0687 20.2836C24.0688 17.6825 21.9532 15.5662 19.3528 15.5662ZM19.3528 1.65041C21.0431 1.65041 22.4184 3.02576 22.4184 4.71633C22.4184 6.40778 21.0431 7.78378 19.3528 7.78378C17.6621 7.78378 16.2867 6.40778 16.2867 4.71633C16.2867 3.02576 17.6621 1.65041 19.3528 1.65041ZM5.647 15.5662C3.95599 15.5662 2.58021 14.1908 2.58021 12.5003C2.58021 10.8096 3.95599 9.43431 5.647 9.43431C7.33735 9.43431 8.71248 10.8096 8.71248 12.5003C8.71248 14.1908 7.33724 15.5662 5.647 15.5662ZM19.3528 23.3496C17.6621 23.3496 16.2867 21.9741 16.2867 20.2837C16.2867 18.5926 17.6621 17.2167 19.3528 17.2167C21.0431 17.2167 22.4184 18.5926 22.4184 20.2837C22.4184 21.9741 21.0431 23.3496 19.3528 23.3496Z" fill="white"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>
<!-- SECTION DETAIL ARTICLE -->
<section id="page-detail-article-section" class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article class="page-detail-article-section__article mb-4 pb-5">
                    <h1 class="page-detail-article-section__title">{{ $blog->title }}</h1>
                    <p class="page-detail-article-section__date__read">{{ Date('d M Y', strtotime($blog->created_at)) }} • {{ $blog->views }} pembaca</p>
                </article>
                <!-- LINE -->
                <div class="line-1px margin-b-28px"></div>
            </div>
        </div>
    </div>
</section>
<!-- MAIN DETAIL ARTICLE -->
<main id="page-detail-article-main" class="min-vh-50 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article class="page-detail-article-main__article">
                    {!! $blog->content ?? '<i>Konten Belum Tersedia</i>' !!}
                </article>
            </div>
        </div>
    </div>
</main>
<!-- NAV SHARE DAFTAR KEGIATAN -->
<!-- <nav id="nav-bottom-share-daftar-kegiatan">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <button type="button" class="nav-bottom-share-daftar-kegiatan__share">
                    <svg class="mr-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 12C3 13.654 4.346 15 6 15C6.794 15 7.512 14.685 8.049 14.18L14.04 17.604C14.022 17.734 14 17.864 14 18C14 19.654 15.346 21 17 21C18.654 21 20 19.654 20 18C20 16.346 18.654 15 17 15C16.206 15 15.488 15.315 14.951 15.82L8.96 12.397C8.978 12.266 9 12.136 9 12C9 11.864 8.978 11.734 8.96 11.603L14.951 8.18C15.488 8.685 16.206 9 17 9C18.654 9 20 7.654 20 6C20 4.346 18.654 3 17 3C15.346 3 14 4.346 14 6C14 6.136 14.022 6.266 14.04 6.397L8.049 9.82C7.496 9.29468 6.76273 9.00123 6 9C4.346 9 3 10.346 3 12Z" fill="#077734"/>
                    </svg>
                    Share
                </button>
                <a href="#" class="nav-bottom-share-daftar-kegiatan__kegiatan">Daftar Kegiatan</a>
            </div>
        </div>
    </div>
</nav> -->
<!-- SHARE SECTION -->
<div id="nav-share-section">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <h6 class="nav-share-section__title">Bagikan lewat</h6>
                <button type="button" class="nav-share-section__close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="row mb-4">
            <a href="http://www.facebook.com/sharer.php?u={{ Request::url() }}&t={{ $blog->title }}" target="blank" rel="noopener noreferrer" title="Share this on Facebook" class="col-4 text-center">
                <div class="text-center mb-1" style="color: #4267B2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </div>
                <h6 class="nav-share-section__subtitle">Fecbook</h6>
            </a>
            <a href="http://twitter.com/share?text={{ $blog->title }}&url={{ Request::url() }}" target="blank" rel="noopener noreferrer" title="Share this on Twitter"  class="col-4 text-center">
                <div class="text-center mb-1" style="color: #1DA1F2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                </div>
                <h6 class="nav-share-section__subtitle">Twitter</h6>
            </a>
            <a href="https://web.whatsapp.com/send?text={{ Request::url() }}" rel="noopener noreferrer" target="_blank" class="col-4 text-center nav-share-section__wa__desktop">
                <div class="text-center mb-1" style="color: #25D366">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                </div>
                <h6 class="nav-share-section__subtitle">WhatsApp</h6>
            </a>
            <a href="whatsapp://send?text={{ Request::url() }}" target="_blank" rel="noopener noreferrer" class="col-4 text-center nav-share-section__wa__mobile">
                <div class="text-center mb-1" style="color: #25D366">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>
                </div>
                <h6 class="nav-share-section__subtitle">WhatsApp</h6>
            </a>
        </div>
        <div class="row">
            <div class="col-12 d-flex aling-items-center">
                <div class="position-relative nav-share-section__input">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg nav-share-section__input-svg" viewBox="0 0 16 16">
                        <path d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.002 1.002 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z"/>
                        <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243L6.586 4.672z"/>
                    </svg>
                    <input class="nav-share-section__input__link" type="text" value="{{ Request::url() }}" readonly>
                </div>
                <button type="button" class="nav-share-section__copy" onclick="copyToClipboard('nav-share-section__input__link')">Salin</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function() {
         // SHARE
         $(".header-button-share").each((i,e)=>{
            $(e).click(function() {
                $('#nav-share-section').css({ 'bottom': '0px' });
                openShadow()
            })
            $('.nav-share-section__close').click(function(e) {
                $('#nav-share-section').css({ 'bottom': '-200%' });
                closeShadow()
            })
        })
    })

    let scrollDoct = $(document).scrollTop();
    $(document).scroll(function () {
        scrollDoct = $(document).scrollTop();
        if (scrollDoct < 100) {
            $('#nav-top-secondary').css({ top: '-100px' })
        } else {
            $('#nav-top-secondary').css({ top: '0px' })
        }
    })

    // COPY LINK SHARE
    function copyToClipboard(inputClass) {
        const copyText = document.querySelector(`.${inputClass}`);
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }
</script>
<!-- ARTICLE JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/article.js') }}"></script>
@endsection
