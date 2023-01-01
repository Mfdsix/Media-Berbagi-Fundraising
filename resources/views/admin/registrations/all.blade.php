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
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/registration/export') }}"><span>Export</span></a>
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
				<div class="d-flex my-8">
					<a href="/admin/registration" class="btn {{ Request::get('gender' ) == null ? 'btn-primary' : '' }}">All</a>
					<a href="?gender=ikhwan" class="btn {{ Request::get('gender') == 'ikhwan' ? 'btn-primary' : '' }} mx-3">Ikhwan</a>
					<a href="?gender=akhwat" class="btn {{ Request::get('gender') == 'akhwat' ? 'btn-primary' : '' }} mx-3">Akhwat</a>
				</div>
				<br>

				@if(count($datas) == 0)
				<div class="card-body">
					<h3>Belum Ada Donasi</h3>
					<p>belum ada Donasi</p>
				</div>
				@else
				<table class="table table-striped" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">ID</th>
							<th scope="col">Nama</th>
							<th scope="col">Email</th>
							<th scope="col">Phone</th>
							<th scope="col">Usia</th>
							<th scope="col">Alamat</th>
							<th scope="col">Program</th>
							<th scope="col">Gender</th>
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
							<td>{{ ($k+1) }}</td>
							@if($v->bill_no == "")
								<td>{{ "INV-" . $v->created_at->format('ymd').sprintf("%05d", $v->id) }}</td>
							@else
								<td>{{ $v->bill_no }}</td>
							@endif
							<td>{{ $v->donature_name }}</td>
							<td>{{ $v->donature_email }}</td>
							<td>{{ $v->donature_phone }}</td>
							<td>{{ $v->usia }}</td>
							<td>{{ $v->kota }}</td>
							<td>{{ $v->typeprogram }}</td>
							<td>{{ $v->jeniskelamin }}</td>

							<td>{{ $v->created_at->format('Y-m-d H:i:s') }}</td>
							<td>
								@if($v->payment_method == "Admin" || $v->payment_method == "Gerai")
									<span class="badge badge-warning">Offline : {{ $v->payment_method }}</span>
								@else
									<span class="badge badge-success">Online : {{ $v->payment_method }}</span>
								@endif
							</td>
							<td>Rp {{ str_replace(',', '.', number_format($v->nominal + $v->unique_code)) }}</td>
							<td>
							@if($v->status == 'canceled')
                                <span class="badge badge-danger">Dibatalkan</span>
                                @elseif($v->status == 'pending')
                                <span class="badge badge-warning">Menunggu</span>
                                @elseif($v->status == 'waiting')
                                <span class="badge badge-warning">Menunggu Verifikasi</span>
                                @elseif($v->status == 'rejected')
                                <span class="badge badge-danger">Bukti Ditolak</span>
                                @elseif($v->status == 'paid')
                                <span class="badge badge-success">Berhasil</span>
							@endif
							</td>
							<td>
								<a href="{{ url('admin/all_donation/'.$v->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
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
<script>
	$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
@endsection
