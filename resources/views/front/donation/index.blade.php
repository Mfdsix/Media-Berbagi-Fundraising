@extends('layouts.mb-app')

@section('title', 'Histori Transaksi')
@section('css')
<style>
    .swiper-slide{
        width: auto !important;
        height: 45px !important;
    }
</style>
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Histori Transaksi'])
    <!-- CATEGORI PAGE HISTORI DONASI -->
    <section id="page-categori-histori-donasi" class="bg-white">
        <div class="container">
            <div class="row">
                <div id="page-categori-histori-donasi-container" class="col-12 pr-0">
                    <div id="histori-donasi-slider" class="swiper">
                        <div class="swiper-wrapper">
                            <a href="?type=all" class="page-categori-historu-donasi__link {{request('type') == 'all' ? 'page-categori-historu-donasi__link__active' : ''}} swiper-slide">
                                Semua
                            </a>
                            <a href="?type=sedekah" class="page-categori-historu-donasi__link {{request('type') == 'sedekah' ? 'page-categori-historu-donasi__link__active' : ''}} swiper-slide">
                                <img src="{{ asset('assets/media-berbagi/assets/images/website/histori-transaksi-1.png') }}" alt="Menu">
                                Sedekah
                            </a>
                            <a href="?type=zakat" class="page-categori-historu-donasi__link {{request('type') == 'zakat' ? 'page-categori-historu-donasi__link__active' : ''}} swiper-slide">
                                <img src="{{ asset('assets/media-berbagi/assets/images/website/histori-transaksi-2.png') }}" alt="Menu">
                                Zakat
                            </a>
                            <a href="?type=wakaf" class="page-categori-historu-donasi__link {{request('type') == 'wakaf' ? 'page-categori-historu-donasi__link__active' : ''}} swiper-slide">
                                <img src="{{ asset('assets/media-berbagi/assets/images/website/histori-transaksi-2.png') }}" alt="Menu">
                                Wakaf
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- MAIN PAGE HISTORI DONASI -->
    <main id="page-main-histori-donasi" class="min-vh-100 bg-white">
        <div class="container">
            <div class="line-7px-plus-30px margin-b-25px"></div>
            <div class="row margin-b-32px">
                <div class="col-12">
                    <h3 class="main-section-text-16 font-weight-bold">Catatan Kebaikan</h3>
                </div>

                <!-- donation empty -->
                <div class="col-12">
                    @if(count($history) == 0)
                    <div class="col-12">
                        <div class="text-center p-4">
                            <img src="{{ asset('images/Bell.svg') }}" class="mb-3">
                            <p class="main-section-text-16">Belum Ada Donasi</p>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end donation empty -->

                <!-- donation -->
                <div class="col-12">
                    <div class="sedekah-wrap campaign-wrap">
                        <div class="col-12">
                            @foreach($history as $k => $v)
                                <div class="page-main-histori-donasi__list">
                                    @if($v->project_id != '0')
                                        <div class="page-main-histori-donasi__list__left">
                                            <img src="{{ asset('storage/'.$v->project->path_featured) }}" alt="Histori Transaksi">
                                        </div>
                                    @else
                                        <div class="page-main-histori-donasi__list__left">
                                            <img src="{{ asset('assets/img/sedekah-icon.svg') }}" alt="Histori Transaksi">
                                        </div>
                                    @endif
                                    <div class="page-main-histori-donasi__list__center d-flex flex-column justify-content-between">
                                        <h2 class="page-main-histori-donasi__list__center__title"><a href="{{ url('donation/'.'INV-' . $v->created_at->format('ymd').sprintf('%05d', $v->id)) }}?isback=true">{{$v->project_id != '0' ? $v->project->title : 'Program instan '.$v->fund_type}}</a></h2>
                                        <p class="page-main-histori-donasi__list__center__date"><span class="pr-1">{{ Date('d M Y', strtotime($v->created_at)) }}</span>•<strong class="pl-1">{{ $v->nominal }}</strong></p>
                                    </div>
                                    <div class="page-main-histori-donasi__list__right ml-auto">{{ $v->status }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- end donation -->

                <div class="col-12">
                    <a target="_blank" href="/donation/export" class="page-detail-donasi__download">Download Laporan</a>
                </div>

            </div>
        </div>
    </main>
@endsection

@section('js')
<!-- DONASI SAYA JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/donasi-saya.js') }}"></script>
@endsection
