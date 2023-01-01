@extends('layouts.export') @section('title', 'Donasi Saya') @push('css')
<style>
    .img-donasi {
        height: 80px;
        width: auto;
    }
</style>
@endpush @section('content')
<div class="p-4" style="position: relative">
    <div>
        <h3 class="mb-4">Donasi Saya</h3>
        <br />
        @if(count($datas) == 0)
        <p class="text-center">Belum ada donasi</p>
        @else @foreach($datas as $k => $x)
        <div class="row">
            <div class="col-md-3">
                @if($x->project_id != '0')
                <img
                    class="img-donasi"
                    src="{{ asset('storage/'.$x->project->path_featured) }}"
                    alt="Histori Transaksi"
                />
                @else
                <img
                    class="img-donasi"
                    src="{{ asset('/assets/img/sedekah-icon.svg') }}"
                    alt="Histori Transaksi"
                />
                @endif
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <p class="page-main-histori-donasi__list__center__title">
                    <a
                        href="/donation/{{ $x->id }}"
                        >{{$x->project_id != '0' ? $x->project->title : 'Wakaf'}}</a
                    >
                </p>
                <p class="page-main-histori-donasi__list__center__date">
                    <span
                        class="pr-1"
                        >{{ Date('d M Y', strtotime($x->created_at)) }}</span
                    >•<strong
                        class="pl-1"
                        >{{ number_format($x->nominal,0, null, '.') }}</strong
                    >
                </p>
            </div>
            <div class="ml-auto text-success">Berhasil</div>
        </div>
        <hr />
        @endforeach @endif @endsection
    </div>
</div>
