@extends('layouts.dashboard')
@section('title', 'Tagihan Pembayaran')

@section('header', 'Tagihan Pembayaran')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">Total Tagihan</p>
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Rp. {{ number_format($total, 0, ',', '.') }}</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body table-responsive">

				@if(count($datas) == 0)
					<h3>Belum Ada Tagihan</h3>
					<p>belum ada Tagihan</p>
				@else
				<table class="table table-bordered table-striped mt-3" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Bulan</th>
							<th scope="col">Nominal</th>
							<th scope="col">Fee</th>
                            <th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
                        
                        {{--foreach $datas--}}
                        @php 
                        $inc = 1;
                        @endphp
                        @foreach($datas as $k => $v)
                        <tr>
                            <td>{{ $inc }}</td>
                            <td>{{ $v->month }}</td>
                            <td>Rp. {{ number_format($v->total, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($v->total * 1/100, 0, ',', '.') }}</td>
                            <td>
                                @if($billing == 0)
                                <span class="badge badge-warning">Belum Dibayar</span>
                                @elseif($billing == 1)
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @elseif($billing == 2)
                                <span class="badge badge-success">Sudah Dibayar</span>
                                @elseif($billing == 3)
                                <span class="badge badge-danger">Pembayaran di cancel</span>
                                @endif
                            </td>
                        </tr>
                        @php 
                        $inc++;
                        @endphp
                        @endforeach
                        <tr>
                            <td align="center" colspan="3">Total</td>
                            <td>Rp. {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>

					</tbody>
				</table>
				@endif
			</div>
		</div>
        <br><br>
        <div class="box">
            <div class="box-body">
                {{-- show session success --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                {{-- show session error --}}
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <form action="" method="POST" enctype="multipart/form-data">
                    {{-- show message error --}}
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @csrf
                    <h2>Cara Pembayaran</h2>
                    <br>
                    <p>Bayar menggunakan transfer rekening ke bank BSI</p>
                    <p>no rek : </p>
                    <span class="badge badge-warning" style="font-size: 24px">{{ $bank_number }} <i title="Salin ke Clipboard" class="bx bx-clipboard"></i></span>
                    <br><br>
                    <p>Masukan Nominal Tagihan</p>
                    <span class="badge badge-primary" style="font-size: 24px">Rp. {{ number_format(substr($totalPay, 0, - 3), 0, ',', '.') }}<span style="font-size: 24px;color:orange">.{{ $rand }}</span> <i title="Salin ke Clipboard" class="bx bx-clipboard"></i></span>
                    <br><br>
                    <p>Masukan nominal sama persis beserta 3 digit akhir.<br/>3 digit akhir adalah sebagai kode unik untuk pengenal masing masing transaksi.</p>
                    <br>
                    <p>Lampirkan Bukti Pembayaran</p>
                    <input type="hidden" name="nominal" value="{{ $totalPay }}">
                    <input type="file" class="form-control" name="proof_image" accept="image/*">
                    <br><br>
                    <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
                </form>
            </div>
        </div>
	</div>
</div>
@endsection

@section('js')
@endsection
