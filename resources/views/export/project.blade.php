@extends('layouts.export')

@section('title', $project->title)
@push('css')
<style>
    .img-full{
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 6px;
    }
</style>
@endpush

@section('content')
<div class="p-4">

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
            <p class="mb-0 pt-4">Rp {{ number_format($donations["remain"], 0, null, ".") }}</p>
        </div>
        <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
            <p>Saldo Disalurkan</p>
            <p class="mb-0 pt-4">Rp {{ number_format($donations["withdrawed"],0 ,null, ".") }}</p>
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
        <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
            <p>Hak MediaBerbagi (1%)</p>
            <p class="mb-0 pt-4">Rp {{ number_format(ceil($donations["automated"] * 0.01), 0, null, ".") }}</p>
        </div>
    </div>

</div>
@endsection
