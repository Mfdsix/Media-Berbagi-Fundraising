@extends('layouts.dashboard')
@section('title', $project->title)

@section('header', "Dana Terkumpul")

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body pd-7 pb-0" style="display: flex; justify-content: space-between">
                <div class="btn-now py-0" id="statistics">
                    <a class="h6 font-w500" href="{{ url('/admin/donation') }}"><span>Kembali</span></a>
                </div>
                <div class="btn-now py-0" id="statistics">
                    <a target="_blank" class="h6 font-w500" href="{{ url()->current().'/export' }}"><span>Export</span></a>
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
                    <img class="img-full" src="{{ asset('/assets/img/sedekah-icon.svg') }}" alt="Card image cap">
                    @else
                    <img class="img-full" src="{{ asset('storage/'.$project->path_featured) }}" alt="Card image cap">
                    @endif
                </div>

                <h3>{{ $project->title }}</h3>
                <div class="row">
                    <div class="col-md-7">{{ $project->category == null ? 'Tidak Berkateogri' : $project->category->category }}</div>
                    @if($project->slug)
                    <div class="col-md-5 text-end">
                        <a class="text-primary" target="_blank" href="{{ url('/' . $project->slug) }}">Lihat halaman program</a>
                    </div>
                    @endif
                </div>

                <h5 class="my-4">Perkembangan</h5>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Target Terkumpul</p>
                        <p class="mb-0 pt-4">{{ isset($project->nominal_target) ? "Rp ".number_format($project->nominal_target, 0, null, ".") : "Unlimited" }}</p>
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
                        <p>Biaya Payment Gateway</p>
                        <p class="mb-0 pt-4">
                            <p class="mb-0 pt-4">Rp {{ number_format($donations["fee"], 0, null, ".") }}</p>
                        </p>
                    </div>
                </div>

                <h5 class="my-4">Pembagian Dana Program</h5>
                <div class="row">
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Dana Penyaluran ({{ $divided['distribution_percentage'] }}%) - (fee payment gateway)</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($divided['distribution_nominal'] - $donations["fee"], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Hak Lembaga ({{ $divided['operational_percentage'] }}%)</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($divided['operational_nominal'], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Hak MediaBerbagi ({{ $divided['media_berbagi_percentage'] }}%)</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($divided['media_berbagi_nominal'], 0, null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Dana Disalurkan</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["withdrawed"],0 ,null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Hak Lembaga Disalurkan</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["withdrawed_instance"],0 ,null, ".") }}</p>
                    </div>
                    <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb">
                        <p>Hak MediaBerbagi Disalurkan</p>
                        <p class="mb-0 pt-4">Rp {{ number_format($donations["withdrawed_mediaberbagi"],0 ,null, ".") }}</p>
                    </div>
                </div>

                <br>

                <h5>Rincian</h5>
                <div class="row p-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2"><b>Total Donasi</b></th>
                            </tr>
                        </thead>
                       <tbody>
                            <tr>
                                <td>Donasi Offline</td>
                                <td>{{ "Rp ".number_format($project->countDonationOffline(), 0, null, ".") }}</td>
                            </tr>
                            <tr>
                                <td>Donasi Online</td>
                                <td>{{ "Rp ".number_format($project->countDonationOnline(),0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td><b>Total Donasi</b></td>
                                <td>{{ "Rp ".number_format($project->countDonation(),0,null,".") }}</td>
                            </tr>
                       </tbody>
                        <thead>
                            <tr>
                                <th colspan="2"><b>Potongan</b></th>
                            </tr>
                        </thead>
                       <tbody>
                            <tr>
                                <td>Hak Media berbagi</td>
                                <td>{{ "Rp ".number_format($project->getDonation()['mediaberbagi'],0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td>Dana Operasional ({{$project->operational_percentage ?? 0}}%)</td>
                                <td>{{ "Rp ".number_format($project->getDonation()['operational'],0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td>Komisi Fundraiser ({{$project->fundraiser_reward ?? 0}}%)</td>
                                <td>{{ "Rp ".number_format($project->getDonation()['commision'],0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td>Biaya Payment gateway</td>
                                <td>{{ "Rp ".number_format($project->getDonation()['fee'],0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td>Donasi yang telah di salurkan</td>
                                <td>{{ "Rp ".number_format($project->getDonation()['withdrawal'],0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td><b>Total Potongan</b></td>
                                <td>{{ "Rp ".number_format($project->countDonation() - $project->getDonation()['neto'],0,null,".") }}</td>
                            </tr>
                            <tr>
                                <td><b>Dana yang bisa di pakai</b></td>
                                <td>{{ "Rp ".number_format($project->getDonation()['neto'],0,null,".") }}</td>
                            </tr>
                       </tbody>
                    </table>
                    <p class="text-muted">
                        * ketika anda merubah data persen operasional dan komisi fundraiser menjadi 0% data yang lama akan tetap di tampilkan
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12">
       <div class="box mt-8">
           <div class="box-body table-responsive">
           <h5 class="my-4">Riwayat transaksi</h5>
            <table class="table table-striped" id="table">
                <thead class="table table-stripped">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Payment</th>
                        <th>Nominal</th>
                        <th>Fee</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_funding = 0;
                        $total_fee = 0;
                    @endphp
                    @foreach($fundings as $fund)
                    <tr>
                        <td>{{ $fund->created_at->format("d M Y") }}</td>
                        <td>{{ $fund->donature_name }}</td>
                        <td>
                            @if($fund->payment_method == "Admin" || $fund->payment_method == "Gerai")
                                <span class="badge badge-warning">Offline : {{ $fund->payment_method }}</span>
                            @else
                                <span class="badge badge-success">Online : {{ $fund->payment_method }}</span>
                            @endif
                        </td>
                        @php
                            $total_funding+= $fund->nominal;
                            $total_fee+= $fund->additional_fee;
                        @endphp
                        <td>{{ "Rp ".number_format($fund->nominal,0,null,".") }}</td>
                        <td>{{ "Rp ".number_format($fund->additional_fee,0,null,".") }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <p><b>Total funding</b> Rp {{ number_format($total_funding,0,null,".") }}</p>
                <p><b>Total fee</b> Rp {{ number_format($total_fee,0,null,".") }}</p>
            </div>
           </div>
       </div>
    </div>
</div>
@endsection

@section('js')
<script>
	$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
@endsection
