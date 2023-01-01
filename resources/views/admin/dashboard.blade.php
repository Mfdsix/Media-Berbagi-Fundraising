@extends('layouts.dashboard') @section('title', 'Dashboard') @section('css')
<style>
    .card .col-4 {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card .col-4 i {
        color: var(--primary);
    }

    .card-body-1 {
        min-height: 70px;
        padding-top: 10px;
    }
</style>
@endsection @section('header', "Dashboard") @section('content')

<div class="row">

    @if($billing != 2 && $lastMonth)
    <div class="col-md-12">
        <div class="box">
            <div class="d-flex justify-content-between">
                <div>
                    Bayar Total Tagihan anda sebesar <br>
                    <h1>Rp. {{ number_format($totalBilling, 0, ',', '.') }}</h1>
                    @if($billing == 0)
                    <span class="badge badge-warning">Belum Dibayar</span>
                    @elseif($billing == 1)
                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                    @elseif($billing == 2)
                    <span class="badge badge-success">Sudah Dibayar</span>
                    @elseif($billing == 3)
                    <span class="badge badge-danger">Pembayaran di cancel</span>
                    @endif
                </div>
                <div>
                    @if($billing == 0)
                    <a href="{{ url('/admin/billing') }}" class="btn btn-primary">Bayar Sekarang</a>
                    @elseif($billing == 1)
                    <a href="{{ url('/admin/billing') }}" class="btn btn-primary">Lihat Pembayaran</a>
                    @elseif($billing == 2)
                    <a href="{{ url('/admin/billing') }}" class="btn btn-primary">Lihat Pembayaran</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

        @if ( version_compare(exec('git tag'), $current, '<') )
        <div class="col-md-12">
            <div class="box" style="background-color: #ffc800cf!important">
                <div class="box-body d-flex justify-content-between">
                    <div>Update ke Versi {{$current}}</div>
                    <a href="/admin/update-software" class="btn btn-primary">Update Sekarang {{$current}}</a>
                </div>
            </div>
        </div>
        @endif
    <div class="col-md-7">
        <div class="box box-manage">
            <div class="box-body d-flex pd-7 pb-0">
                <div class="me-auto w-55">
                    <h5 class="card-title text-white fs-30 font-w500 mt-4">
                        Selamat Datang
                    </h5>
                    <p class="mb-0 text-o7 fs-18 font-w500 pb-11">
                        Silahkan menggunakan menu disamping untuk memulai
                    </p>
                </div>
                <div class="btn-now" id="statistics">
                    <a class="h6 font-w500" href="#statistics"
                        ><span>Lihat Statistik Terbaru</span></a
                    >
                </div>
            </div>
        </div>

        <!-- <div class="box mt-3">
            <div class="box-body">
                <b class="mb-4">Penggunaan Penyimpanan</b>
                <p>
                    total penggunaan penyimpanan anda adalah
        >{{ $totalUsage }} MB</b> ({{ $totalUsagePrecentage }}%)
                </p>
                <div class="bg-grey" style="border-radius: 0.25rem">
                    <div class="progress">
                        <div
                            class="progress-bar"
                            role="progressbar"
                            style="width: {{ $totalUsagePrecentage }}%"
                            aria-valuenow="{{ $totalUsagePrecentage }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        ></div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!--  -->
    <div class="col-md-5">
        <div
            class="box box-manage"
            style="background-color: #afcb22 !important"
        >
            <div class="box-body d-flex pd-7 pb-0">
                <div class="me-auto w-55">
                    <h5 class="card-title text-white fs-30 font-w500 mt-4">
                        Aplikasi Mobile
                    </h5>
                    <p class="mb-0 text-o7 fs-18 font-w500 pb-11">
                        Get more of your customer, Dapatkan semua fitur
                        mediaberbagi dalam satu aplikasi.
                    </p>
                </div>
                <div class="btn-now" id="statistics">
                    <a class="h6 font-w500" href="https://wa.me/62881022915155"
                        ><span>Hubungi Selles Anda</span></a
                    >
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h3 class="mb-4">Statistik</h3>
        <div class="box p-2rem">
            <div class="row">
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Program Donasi</h5>
                    <p class="mb-0 pt-4">{{ $projects }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Donatur Hari Ini</h5>
                    <p class="mb-0 pt-4">{{ $donatur_today }}</p>
                </div>
                <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 bb">
                    <h5 class="title-box">Donatur Bulan Ini</h5>
                    <p class="mb-0 pt-4">{{ $donatur_monthly }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Transaksi Hari Ini</h5>
                    <p class="mb-0 pt-4">{{ $transaction_today }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Transaksi Bulan Ini</h5>
                    <p class="mb-0 pt-4">{{ $transaction_monthly }}</p>
                </div>
                <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 bb">
                    <h5 class="title-box">Dana Terkumpul Hari Ini</h5>
                    <p class="mb-0 pt-4">{{ $donation_today }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Dana Terkumpul Bulan Ini</h5>
                    <p class="mb-0 pt-4">{{ $donation_monthly }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Donasi Menunggu Pembayaran</h5>
                    <p class="mb-0 pt-4">{{ $total_waiting }}</p>
                </div>
                <div class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 bb">
                    <h5 class="title-box">Dana Menunggu Pembayaran</h5>
                    <p class="mb-0 pt-4">{{ $sum_waiting }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Donasi Offline</h5>
                    <p class="mb-0 pt-4">{{ $manual_donation }}</p>
                </div>
                <div
                    class="col-sm-6 col-xs-12 col-md-4 col-lg-4 p-4 mb-2 br bb"
                >
                    <h5 class="title-box">Donasi Online</h5>
                    <p class="mb-0 pt-4">{{ $automated_donation }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<di class="row mt-2">
    <div class="col-md-6 mb-1">
        <div class="row">
            <div class="col-12 mb-4">
                <h3 class="mb-4">Grafik Transaksi Minggu Ini</h3>

                <div class="card">
                    <div class="card-body">
                        <div class="chart-area">
                            <div id="customer-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-1">
        <div class="row mt-2">
            <div class="col-12">
                <h3 class="mb-4">Grafik Donatur Bulan Ini</h3>

                <div class="card">
                    <div class="card-body">
                        <div class="chart-area">
                            <div id="customer-chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</di>

<div class="row mb-4">
    <div class="col-md-12">
        <h3 class="mb-4">Donasi Terbaru</h3>
        <div class="box">
            @if(count($datas) == 0)
            <h4>Belum Ada Donasi</h4>
            <p>belum ada transaksi donasi baru-baru ini</p>
            @else
            <div class="box-body pb-0 table-responsive activity mt-18">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tgl Transaksi</th>
                            <th>Metode Pembayaran</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $k => $v)
                        <tr class="{{ $k % 2 == 0 ? 'odd' : 'even' }}">
                            <td>{{ $k + 1 }}</td>
                            <td>{{ $v->donature_name }}</td>
                            <td>
                                {{ Date('d-m-Y, H:i', strtotime($v->created_at)) }}
                            </td>
                            <td>{{ $v->payment_method }}</td>
                            <td>
                                Rp
                                {{ str_replace(',', '.', number_format($v->nominal + $v->unique_code)) }}
                            </td>
                            <td>
                                @if($v->status == 'canceled')
                                <span class="text-danger">Dibatalkan</span>
                                @elseif($v->status == 'pending')
                                <span class="text-default">Menunggu</span>
                                @elseif($v->status == 'waiting')
                                <span class="text-primary"
                                    >Menunggu Verifikasi</span
                                >
                                @elseif($v->status == 'rejected')
                                <span class="text-danger">Bukti Ditolak</span>
                                @elseif($v->status == 'paid')
                                <span class="text-primary">Berhasil</span>
                                @endif
                            </td>
                            <td>
                                <a
                                    href="{{ url('admin/all_donation/'.$v->id) }}"
                                    class="btn btn-sm btn-primary"
                                    >Lihat Detail</a
                                >
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    {!! $datas->links() !!}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection @section('js')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/area-chart.js') }}"></script>
<script>
    var sevenDays = {
    	'days': [],
    	'donation': []
    };
    var oneMonth = {
    	'days': [],
    	'donation': []
    };
    var usage = {
    	'categories': [],
    	'disk': [],
    	'database': []
    };
    var usageDonute = {
    	used: {{ $totalUsagePrecentage > 100 ? 100 : $totalUsagePrecentage }},
    	available: {{ $totalUsagePrecentage > 100 ? 0 : (100-$totalUsagePrecentage) }},
    };

    @foreach($last7Days['dates'] as $k => $date)
    sevenDays.days.push('{{ $date }}');
    @endforeach
    @foreach($last7Days['donation'] as $k => $donation)
    sevenDays.donation.push({{ $donation }});
    @endforeach
    @foreach($last1Month as $k => $v)
    oneMonth.days.push("{{ $k }}");
    oneMonth.donation.push({{ $v }});
    @endforeach
</script>
<script src="{{ asset('dashboard/js/pages/dashboard.js') }}"></script>
@endsection
