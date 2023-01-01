@extends('layouts.dashboard')
@section('title', $project->title)

@section('header', "Dana Terkumpul")

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body d-flex align-items-center pd-7 pb-0 row">
                <div class="btn-now d-block py-0" id="statistics">
                    <a class="h6 font-w500" href="{{ url('/accounting/donation') }}"><span>Kembali</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt--2">
    <div class="col-md-12 mb-3">
        <div class="box">
            <div class="box-body">

                <div class="mb-4">
                    @if($project->path_featured == null)
                    <img class="img-full" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
                    @else
                    <img class="img-full" src="{{ asset('storage/'.$project->path_featured) }}" alt="Card image cap">
                    @endif
                </div>

                <h3>{{ $project->title }}</h3>
                <div class="row">
                    <div class="col-md-7">{{ $project->category == null ? 'Tidak Berkateogri' : $project->category->category }}</div>
                    <div class="col-md-5 text-end">
                        <a class="text-primary" target="_blank" href="{{ url('/' . $project->slug) }}">Lihat halaman program</a>
                    </div>
                </div>

                <h5 class="my-4">Perkembangan</h5>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Target Terkumpul</p>
                        <p class="mb-0 pt-4">{{ $project->nominal_target ?? "Unlimited" }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Donatur</p>
                        <p class="mb-0 pt-4">{{ number_format($donations["donatur"], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Fundraiser</p>
                        <p class="mb-0 pt-4">{{ number_format($donations["fundraiser"], 0, null, ".") }}</p>
                    </div>
                </div>

                <h5 class="my-4">Data Uang Kas</h5>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Total Saldo</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["collected"], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Saldo Online</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["automated"], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Saldo Offline</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["manual"], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Sisa Saldo</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["collected"], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Saldo Disalurkan</p>
                        <p class="mb-0 pt-4">
                            <i>belum tersedia</i>
                        </p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Biaya Payment Gateway</p>
                        <p class="mb-0 pt-4">
                            <p class="mb-0 pt-4">Rp {{ number_format($donations["fee"], 0, null, ".") }}</p>
                        </p>
                    </div>
                </div>

                <h5 class="my-4">Pembagian Dana Program</h5>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Hak Lembaga ({{ $divided['operational_percentage'] }}%)</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($divided['operational_nominal'], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Dana Penyaluran ({{ $divided['distribution_percentage'] }}%)</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($divided['distribution_nominal'], 0, null, ".") }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
