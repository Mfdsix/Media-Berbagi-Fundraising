@extends('layouts.dashboard')
@section('title', 'Transaksi Qurban')

@section('header', 'Transaksi Qurban')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Transaksi Qurban</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau semua transaksi qurban</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">

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
					<h3>Belum Ada Bukti Pembayaran</h3>
					<p>belum ada bukti pembayaran</p>
				@else
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Donatur</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Total</th>
							<th scope="col">Status</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->donatur_name }}</td>
							<td>{{ $v->created_at->format('d M Y') }}</td>
							<td>Rp {{ str_replace(',', '.', number_format($v->nominal))}}</td>
							<td>
								@if($v->status == 'waiting')
								<span class="badge badge-warning">Menunggu Konfirmasi</span>
								@elseif($v->status == 'paid')
								<span class="badge badge-success">Berhasil</span>
								@elseif($v->status == 'rejected')
								<span class="badge badge-danger">Gagal</span>
								@endif
							</td>
							<td>
								<a href="{{ url('admin/kurban_proof/'.$v->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
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
