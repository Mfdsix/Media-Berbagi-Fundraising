@extends('layouts.mb-app')

@section('title', 'Detail')
@section('css')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61d45af3179d60001978892d&product=inline-share-buttons" async="async"></script>
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
.kabar-terbaru img {
    width: 100% !important;
}
#toast{
    transform: translateY(-200px);
    transition: 0.4s;
}
</style>
@endsection

@section('content')
<nav id="nav-top-secondary">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-2">
                <a href="#" onclick="window.history.back()">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23 9.00024H3.0505L10.6895 1.72424C11.0895 1.34324 11.105 0.710244 10.724 0.310244C10.3435 -0.0892562 9.7105 -0.105256 9.31 0.275744L0.586 8.58574C0.2085 8.96374 0 9.46574 0 10.0002C0 10.5342 0.2085 11.0367 0.6035 11.4312L9.3105 19.7242C9.504 19.9087 9.752 20.0002 10 20.0002C10.264 20.0002 10.528 19.8962 10.7245 19.6897C11.1055 19.2897 11.09 18.6572 10.69 18.2762L3.019 11.0002H23C23.552 11.0002 24 10.5522 24 10.0002C24 9.44824 23.552 9.00024 23 9.00024V9.00024Z" fill="white"/>
                    </svg>
                </a>
            </div>
            <div class="col-8">
                <h1 class="nav-top-secondary__title">{{ $project->title }}</h1>
            </div>
        </div>
    </div>
</nav>
<!-- HEADER -->
<header id="page-header-sedekah" class="bg-white">
<!-- <div class="page-header-sedekah-background" style="background-image: url('{{ asset('storage/'.$project->path_featured) }}');"></div> -->
<img src="{{ getThumb(asset('storage/'.$project->path_featured), 600,900) }}" alt="" class="page-header-image-sedekah">
    <a href="/" class="page-header-sedekah__button__back">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.9999 11H6.41394L11.7069 5.70703L10.2929 4.29303L2.58594 12L10.2929 19.707L11.7069 18.293L6.41394 13H20.9999V11Z" fill="white"/>
        </svg>
    </a>
    <a href="#" class="page-header-sedekah__button__author">
        @if($web_set->path_logo)
        <img class="logo-media-berbagi" src="{{ getThumb(asset('storage/' . $web_set->path_logo),130) }}" alt="Media Berbagi">
        @else
        <img class="logo-media-berbagi" src="{{ getThumb(asset('assets/media-berbagi/assets/images/website/detail-media-berbagi.png'),130) }}" alt="Media Berbagi">
        @endif
        <!-- <img src="{{ asset('assets/media-berbagi/assets/images/website/detail-media-berbagi.png') }}" alt="Media Berbagi"> -->
    </a>
</header>
<!-- MAIN -->
<main id="page-main-sedekah" class="bg-white">
    <div class="container">
        <div class="row margin-b-32px">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <h1 class="page-main-sedekah__title w-75">{{ $project->title }}
                </h1>
                @if(isset($favorite))
                <button onclick="setLove('{{ $project->id }}')" class="page-main-sedekah__button__love">
                    @if($favorite)
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/sedekah-heart-active.svg') }}" alt="Heart">
                    @else
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/sedekah-heart-1.svg') }}" alt="Heart">
                    @endif
                </button>
                @endif
            </div>
        </div>
        <div class="row margin-b-32px">
            <div class="col-12 mb-3">
                <div class="page-main-sedekah__progressbar">
                    {{-- SET WIDTH PROGRESS --}}
                    <span class="page-main-sedekah__progressbar__data" style="width: {{$project->percentage}}%"></span>
                </div>
            </div>
            <div class="col-12 d-flex align-items-start justify-content-between">
                <div>
                    <h6 class="sedekah-section-nominal mb-1">{{ $project->donations }}</h6>
                    <p class="sedekah-section-nominal-hari-bottom">Donasi Terkumpul</p>
                </div>
                <div>
                    <h6 class="sedekah-section-hari mb-2">{{ $project->date_count }} hari</h6>
                    <p class="sedekah-section-nominal-hari-bottom">Sisa hari</p>
                </div>
            </div>
        </div>

        <!-- DESKRIPSI -->
        <div class="row margin-b-32px">
            <div class="col-12 margin-b-16px">
                <h3 class="sedekah-section-title">Deskripsi</h3>
            </div>
            @if ($project->content == null || $project->content == "")
             <!-- NO DATA -->
             <div class="col-12 text-center">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-kabar-terbaru.png') }}" alt="Kabar Terbaru" style="width:100px !important">
                <p class="sedekah-section-text-nodata">Belum ada deskripsi</p>
            </div>
            @else
            <div class="col-12 page-main-sedekah__deskripsi">
                {!! $project->content !!}
            </div>
            <div class="col-12 text-center">
                <button type="button" class="sedekah-section-baca-selengkapnya sedekah-section-baca-selengkapnya__deskripsi">Baca Selengkapnya</button>
            </div>
            @endif
        </div>

        <!-- KABAR TERBARU -->
        <div class="row margin-b-32px kabar-terbaru">
            <div class="col-12 margin-b-16px kabar-terbaru">
                <h3 class="sedekah-section-title">Kabar terbaru</h3>
            </div>
            @if (empty($update))
            <!-- NO DATA -->
            <div class="col-12 text-center margin-t-48px margin-b-16px">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-kabar-terbaru.png') }}" alt="Kabar Terbaru" style="width:100px !important">
                <p class="sedekah-section-text-nodata">Belum ada kabar terbaru di program ini</p>
            </div>
            @else
            <!-- WITH DATA -->
            <div class="margin-b-28px">
                <div class="col-12 d-flex align-items-start">
                    <div class="modal-sedekah-bullet-line">
                        <div class="modal-sedekah-bullet-line__bullet"></div>
                        <div class="modal-sedekah-bullet-line__line-2"></div>
                    </div>
                    <div class="modal-sedekah-bullet-data" style="word-break: break-all;">
                        <div class="modal-sedekah-bullet-kb__date">{{ $update->date }}</div>
                        <p class="modal-sedekah-bullet-kb__text-2">{!! $update->content !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="button" class="sedekah-section-baca-selengkapnya sedekah-section-baca-selengkapnya__kb" data-open="false">Baca Selengkapnya</button>
            </div>
            @endif
        </div>

        <!-- DONATUR -->
        <div class="row margin-b-32px">
            <div class="col-12 d-flex align-items-center justify-content-between margin-b-28px">
                <h3 class="sedekah-section-title">Donatur</h3>
                <button type="button" class="sedekah-section-lihat-semua sedekah-section-lihat-semua__donatur">Lihat Semua</button>
            </div>
            @if(count($donaturs) == 0)
            <!-- NO DATA -->
            <div class="col-12 text-center margin-t-38px margin-b-16px">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-donatur.png') }}" alt="Donatur">
                <p class="sedekah-section-text-nodata">Jadilah donatur pertama di program ini</p>
            </div>
            @else
            <!-- WITH DATA -->
            <div class="col-12">
                @foreach($donaturs->take(3) as $k => $v)
                <div class="page-main-sedekah-donatur-list margin-b-32px">
                    @if ($v->fund_type == 'donation')
                    <div class="page-main-sedekah-profile__circle profile__circle-green">{{ $v->photo }}</div>
                    @elseif ($v->fund_type == 'wakaf')
                    <div class="page-main-sedekah-profile__circle profile__circle-red">{{ $v->photo }}</div>
                    @else
                    <div class="page-main-sedekah-profile__circle profile__circle-blue">{{ $v->photo }}</div>
                    @endif
                    <div class="d-flex align-items-start justify-content-between" style="width: calc(100% - 77px);">
                        <div>
                            <h5 class="page-main-sedekah-profile__nama mb-1 flex-fill">{{ $v->donature_name }}</h5>
                            <p class="page-main-sedekah-donatur-list__waktu">{{ $v->created_at->diffForHumans() }}</p>
                            @if($v->special_message != "")
                            <p class="page-main-sedekah-donatur-list__waktu mt-2"><i>"{{ $v->special_message }}"</i></p>
                            @endif
                        </div>
                        <strong class="page-main-sedekah-donatur-list__nominal">Rp{{ $v->nominal }}</strong>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <!-- FUNDRAISER -->
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between margin-b-28px">
                <h3 class="sedekah-section-title">Fundraiser</h3>
                <button type="button" class="sedekah-section-lihat-semua sedekah-section-lihat-semua__fundraiser">Lihat Semua</button>
            </div>
            @if(count($fundraisers) == 0)
            <!-- NO DATA -->
            <div class="col-12 text-center margin-t-38px margin-b-16px">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-fundraiser.png') }}" alt="Donatur">
                <p class="sedekah-section-text-nodata">Ayo ikutan berkontribusi pada program ini dengan menjadi fundraiser</p>
            </div>
            @else
            <!-- WITH DATA -->
            <div class="col-12">

                @foreach ($fundraisers as $fund)
                    <div class="page-main-sedekah-fundraiser-list margin-b-32px">
                        <div class="page-main-sedekah-profile__circle profile__circle-blue">{{ $fund->photo }}</div>
                        <div>
                            <h5 class="page-main-sedekah-profile__nama mb-1">{{$fund->fullname}} <div class="page-main-sedekah-profile__nama__badge ml-2"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.9738 6.39075C14.991 6.26025 15 6.12975 15 6C15 4.21575 13.3927 2.784 11.6093 3.02625C11.0895 2.1015 10.0995 1.5 9 1.5C7.9005 1.5 6.9105 2.1015 6.39075 3.02625C4.6035 2.784 3 4.21575 3 6C3 6.12975 3.009 6.26025 3.02625 6.39075C2.1015 6.91125 1.5 7.90125 1.5 9C1.5 10.0988 2.1015 11.0887 3.02625 11.6093C3.00895 11.7388 3.00018 11.8693 3 12C3 13.7843 4.6035 15.2122 6.39075 14.9738C6.9105 15.8985 7.9005 16.5 9 16.5C10.0995 16.5 11.0895 15.8985 11.6093 14.9738C13.3927 15.2122 15 13.7843 15 12C15 11.8702 14.991 11.7397 14.9738 11.6093C15.8985 11.0887 16.5 10.0988 16.5 9C16.5 7.90125 15.8985 6.91125 14.9738 6.39075ZM8.21625 12.312L5.466 9.5265L6.534 8.4735L8.22675 10.188L11.472 6.9675L12.528 8.0325L8.21625 12.312Z" fill="#077734"/>
                                </svg></div></h5>
                            <p class="page-main-sedekah-fundraiser-list__text">Berhasil mengajak <strong>{{ $fund->total_donature }}</strong> orang berdonasi</p>
                            <strong class="page-main-sedekah-fundraiser-list__nominal">Rp{{ number_format($fund->total_funding) }}</strong>
                        </div>
                    </div>
                @endforeach
                
            </div>
            @endif
            @if(!$is_referral)
            <div class="col-12 pt-3">
                <a href="/register/fundraiser" class="page-nav-sedekah__fundraiser">Jadi Fundraiser</a>
            </div>
            @endif
        </div>
    </div>
</main>
<!-- MODAL: DESKRIPSI -->
<div id="modal-sedekah-deskripsi" class="modal-lihat-semua">
    <!-- MODAL BUTTON CLOSE -->
    <!-- <button type="button" class="modal-lihat-semua-close-button"></button> -->
    <button class="modal-lihat-semua-close-button d-flex align-items-center"><div class="mr-2">Tutup</div><h3>&times;</h3></button>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="modal-lihat-semua-title pb-3">Deskripsi</h4>
            </div>
        </div>
        <!-- WITH DATA -->
        <div class="modal-lihat-semua-cover row">
            <div class="col-12">
                <p class="page-main-sedekah__deskripsi__text-2 pb-4">{!! $project->content !!}</p>
            </div>
        </div>
    </div>
</div>

@if(isset($update))
<!-- MODAL: KABAR TERBARU -->
<div id="modal-sedekah-kabar-berita" class="modal-lihat-semua">
    <!-- MODAL BUTTON CLOSE -->
    <!-- <button type="button" class="modal-lihat-semua-close-button"></button> -->
    <button class="modal-lihat-semua-close-button d-flex align-items-center"><div class="mr-2">Tutup</div><h3>&times;</h3></button>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="modal-lihat-semua-title pb-3">Kabar Terbaru</h4>
            </div>
        </div>

        @if (empty($update))
        <!-- NO DATA -->
        <div class="modal-lihat-semua-cover row">
            <div class="col-12 text-center margin-t-48px margin-b-16px">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-kabar-terbaru.png') }}" alt="Kabar Terbaru">
                <p class="sedekah-section-text-nodata">Belum ada kabar terbaru di program ini</p>
            </div>
        </div>
        @else
        <!-- WITH DATA -->
        <div class="modal-lihat-semua-cover row">
        @foreach ( $update_all as $update)
            <div class="col-12 d-flex align-items-start">
                <div class="modal-sedekah-bullet-line">
                    <div class="modal-sedekah-bullet-line__bullet"></div>
                    <div class="modal-sedekah-bullet-line__line-2"></div>
                </div>
                <div class="modal-sedekah-bullet-data" style="word-break: break-all;">
                    <div class="modal-sedekah-bullet-kb__date">{{ $update->created_at->format('d M Y') }}</div>
                    <p class="modal-sedekah-bullet-kb__text">{{ $update->title }}</p>
                    <p class="modal-sedekah-bullet-kb__text-2">{!! $update->content !!}</p>
                </div>
            </div>
        @endforeach
        </div>
        @endif
    </div>
</div>
@endif

<!-- MODAL: DONATUR -->
<div id="modal-sedekah-donatur" class="modal-lihat-semua">
    <!-- MODAL BUTTON CLOSE -->
    <button class="modal-lihat-semua-close-button d-flex align-items-center"><div class="mr-2">Tutup</div><h3>&times;</h3></button>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="modal-lihat-semua-title pb-3">Donatur</h4>
            </div>
        </div>
        @if(count($donaturs) == 0)
        <!-- NO DATA -->
        <div class="modal-lihat-semua-cover row">
            <div class="col-12 text-center margin-t-38px margin-b-28px">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-donatur.png') }}" alt="Donatur">
                <p class="sedekah-section-text-nodata">Jadilah donatur pertama di program ini</p>
            </div>
        </div>
        @else
        <!-- DATA -->
        <div class="modal-lihat-semua-cover row">
            <div class="col-12">
                @foreach($donaturs as $k => $v)
                <div class="page-main-sedekah-donatur-list margin-b-32px">
                    @if ($v->fund_type == 'donation')
                    <div class="page-main-sedekah-profile__circle profile__circle-green">{{ $v->photo }}</div>
                    @elseif ($v->fund_type == 'wakaf')
                    <div class="page-main-sedekah-profile__circle profile__circle-red">{{ $v->photo }}</div>
                    @else
                    <div class="page-main-sedekah-profile__circle profile__circle-blue">{{ $v->photo }}</div>
                    @endif
                    <div class="d-flex align-items-start justify-content-between" style="width: calc(100% - 77px);">
                        <div>
                            <h5 class="page-main-sedekah-profile__nama mb-1">{{ $v->donature_name }}</h5>
                            <p class="page-main-sedekah-donatur-list__waktu">{{ $v->created_at->diffForHumans() }}</p>
                            @if($v->special_message != "")
                            <p class="page-main-sedekah-donatur-list__waktu mt-2"><i>"{{ $v->special_message }}"</i></p>
                            @endif
                        </div>
                        <strong class="page-main-sedekah-donatur-list__nominal">Rp{{ $v->nominal }}</strong>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<!-- MODAL: FUNDRAISER -->
<div id="modal-sedekah-fundraiser" class="modal-lihat-semua">
    <!-- MODAL BUTTON CLOSE -->
    <button class="modal-lihat-semua-close-button d-flex align-items-center"><div class="mr-2">Tutup</div><h3>&times;</h3></button>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="modal-lihat-semua-title pb-3">Fundraiser</h4>
            </div>
        </div>
        @if(count($fundraisers) == 0)
        <!-- NO DATA -->
        <div class="modal-lihat-semua-cover row">
            <div class="col-12 text-center margin-t-38px margin-b-28px">
                <img src="{{ asset('assets/media-berbagi/assets/images/website/sedekah-fundraiser.png') }}" alt="Donatur">
                <p class="sedekah-section-text-nodata">Ayo ikutan berkontribusi pada program ini dengan menjadi fundraiser</p>
            </div>
        </div>
        @else
        <!-- DATA -->
        <div class="modal-lihat-semua-cover row">
            <div class="col-12">
                @foreach ($fundraisers as $fund)
                    <div class="page-main-sedekah-fundraiser-list margin-b-32px">
                        <div class="page-main-sedekah-profile__circle profile__circle-blue">{{ $fund->photo }}</div>
                        <div>
                            <h5 class="page-main-sedekah-profile__nama mb-1">{{$fund->fullname}} <div class="page-main-sedekah-profile__nama__badge ml-2"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.9738 6.39075C14.991 6.26025 15 6.12975 15 6C15 4.21575 13.3927 2.784 11.6093 3.02625C11.0895 2.1015 10.0995 1.5 9 1.5C7.9005 1.5 6.9105 2.1015 6.39075 3.02625C4.6035 2.784 3 4.21575 3 6C3 6.12975 3.009 6.26025 3.02625 6.39075C2.1015 6.91125 1.5 7.90125 1.5 9C1.5 10.0988 2.1015 11.0887 3.02625 11.6093C3.00895 11.7388 3.00018 11.8693 3 12C3 13.7843 4.6035 15.2122 6.39075 14.9738C6.9105 15.8985 7.9005 16.5 9 16.5C10.0995 16.5 11.0895 15.8985 11.6093 14.9738C13.3927 15.2122 15 13.7843 15 12C15 11.8702 14.991 11.7397 14.9738 11.6093C15.8985 11.0887 16.5 10.0988 16.5 9C16.5 7.90125 15.8985 6.91125 14.9738 6.39075ZM8.21625 12.312L5.466 9.5265L6.534 8.4735L8.22675 10.188L11.472 6.9675L12.528 8.0325L8.21625 12.312Z" fill="#077734"/>
                                </svg></div></h5>
                            <p class="page-main-sedekah-fundraiser-list__text">Berhasil mengajak <strong>{{ $fund->success_transaction }}</strong> orang berdonasi</p>
                            <strong class="page-main-sedekah-fundraiser-list__nominal">{{ $fund->nominal }}</strong>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
<!-- NAV BOTTOM -->
<nav id="page-nav-sedekah">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <button type="button" class="page-nav-sedekah__share">Share</button>
                <button class="page-nav-sedekah__donasi">{{$project->button_label}}</button>
            </div>
        </div>
    </div>
</nav>
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
            @php
            if(isset(Auth::user()->is_fundraiser)){
                if(Auth::user()->is_fundraiser == 1){
                    $url = Request::fullUrl().'?r='.Auth::user()->fundraiser->referral_code;
                }else{
                    $url = Request::fullUrl();
                }
            }else{
                $url = Request::fullUrl();
            }
            @endphp
            <a href="http://www.facebook.com/sharer.php?u={{ $url }}&t={{ $project->title }}" target="blank" rel="noopener noreferrer" title="Share this on Facebook" class="col-4 text-center">
                <div class="text-center mb-1" style="color: #4267B2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                </div>
                <h6 class="nav-share-section__subtitle">Fecbook</h6>
            </a>
            <a href="http://twitter.com/share?text={{ $project->title }}&url={{ $url }}" target="blank" rel="noopener noreferrer" title="Share this on Twitter"  class="col-4 text-center">
                <div class="text-center mb-1" style="color: #1DA1F2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                    </svg>
                </div>
                <h6 class="nav-share-section__subtitle">Twitter</h6>
            </a>
            <a href="https://wa.me/?text={{ $url }}" rel="noopener noreferrer" target="_blank" class="col-4 text-center nav-share-section__wa__desktop">
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
                    <input class="nav-share-section__input__link" type="text" value="{{ $url }}" readonly>
                </div>
                <button type="button" class="nav-share-section__copy" onclick="copyToClipboard('nav-share-section__input__link')">Salin</button>
            </div>
        </div>
    </div>
</div>

{{-- floating bottom toast --}}
<div class="toast text-white bg-success rounded-pill" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body px-4">
        Link berhasil disalin
    </div>
</div>
<style>
    .toast {
        position: fixed;
        bottom:20px;
        left:50%;
        transform: translateX(-50%);
        z-index: 9999;
    }
</style>
@endsection

@section('js')
@if($web_set->facebook_pixel != null)
<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '{{ $web_set->facebok_pixel }}');
	fbq('track', 'ViewContent');
</script>
<noscript><img loading="lazy" height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $web_set->facebok_pixel }}&ev=ViewContent&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endif
<!-- SEDEKAH JS -->
<script>
    $(document).ready(function() {
        {!! request()->get("kabarterbaru") ? "$('#modal-sedekah-kabar-berita').css({ 'bottom': '0px' });openShadow()" : "" !!}
    })

    $(".page-nav-sedekah__donasi").click(function() {
        var parameters = {
            type: '{{ $type }}',
            id: '{{ $project->id }}',
            nominal: "{{ $project->wakaf_price }}",
            referral_code: getReferralCode(),
        };
        window.location.href = "/nominal/" + btoa(JSON.stringify(parameters));
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
        // toast
        $('#toast').toast('show');
        $("#toast").css({transform:"translateY(0)"})
    }

    function setLove(id){
        window.location.href = "{{ url('/project/save/' . $project->id) }}";
    }
    // let y = getComputedStyle(document.querySelector('.page-header-image-sedekah')).top.replace('px','')
    // window.onscroll = x => {
    //     document.querySelector('.page-header-image-sedekah').style.top = parseInt(y) + (window.scrollY)+'px'
    // }
</script>
<script src="{{ asset('assets/media-berbagi/styles/js/sedekah.js') }}"></script>
@endsection
