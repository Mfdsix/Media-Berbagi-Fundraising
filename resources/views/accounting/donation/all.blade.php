@extends('layouts.dashboard')
@section('title', 'Semua Transaksi')

@section('header', 'Semua Transaksi')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Transaksi Donasi</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau semua transaksi donasi</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				@if(count($datas) == 0)
				<div class="card-body">
					<h3>Belum Ada Donasi</h3>
					<p>belum ada Donasi</p>
				</div>
				@else
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Tgl Transaksi</th>
							<th scope="col">Metode Pembayaran</th>
							<th scope="col">Nominal</th>
							<th scope="col">Status</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->donature_name }}</td>
							<td>{{ Date('d-m-Y, H:i', strtotime($v->created_at)) }}</td>
							<td>{{ $v->payment_method }}</td>
							<td>Rp {{ str_replace(',', '.', number_format($v->nominal + $v->unique_code)) }}</td>
							<td>
							@if($v->status == 'canceled')
                                <span class="text-danger">Dibatalkan</span>
                                @elseif($v->status == 'pending')
                                <span class="text-default">Menunggu</span>
                                @elseif($v->status == 'waiting')
                                <span class="text-primary">Menunggu Verifikasi</span>
                                @elseif($v->status == 'rejected')
                                <span class="text-danger">Bukti Ditolak</span>
                                @elseif($v->status == 'paid')
                                <span class="text-primary">Berhasil</span>
                                @endif
							</td>
							<td>
								<a href="{{ url('accounting/all_donation/'.$v->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
