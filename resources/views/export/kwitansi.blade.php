@extends('layouts.export')

@section('title', 'Kwitansi Donasi')

@push('css')
<style>
    .img-floated{
        position: absolute;
        top: 50%;
        left: 50%;
        height: 50px;
        width:auto;
        transform: translate(-50%, -50%);
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<div class="p-4" style="position: relative">
<div>
<h3>Kwitansi Donasi</h3>
    <p>bukti terima transaksi offline</p>

    <table class="table table-striped">
        <tbody>
            <tr>
                <td>Nama Donatur</td>
                <td>:</td>
                <td>{{ $data->donature_name }}</td>
            </tr>
            <tr>
                <td>Program Donasi</td>
                <td>:</td>
                <td>{{ $data->project->title }}</td>
            </tr>
            <tr>
                <td>Nominal</td>
                <td>:</td>
                <td>Rp {{ number_format($data->nominal, 0, null, '.') }}</td>
            </tr>
            <tr>
                <td>Tanggal Transaksi</td>
                <td>:</td>
                <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
            </tr>
            <tr>
                <td>Status Transaksi</td>
                <td>:</td>
                <td class="text-success font-weight-bold">BERHASIL</td>
            </tr>
        </tbody>
    </table>

    <table class="table mt-4">
        <tbody>
            <tr>
                <td style="border-top: none" width="75%"></td>
                <td style="border-top: none" width="25%" class="text-center">
                    <p>{{ date('d M Y') }}</p>
                    <br>
                    <br>
                    <br>
                    <p>..............................</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</div>
@endsection
