@extends('layouts.dashboard')
@section('title', 'Transaksi Online')

@section('header', 'Transaksi Online')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Transaksi Online</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau semua donasi melalui payment gateway dan transfer</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/not_confirmed/manual/export') }}"><span>Export</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/admin/not_confirmed/payment_gateway') }}">Payment Gateway</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="#">Manual</a>
			</li>
		</ul>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body table-responsive">

				@if(count($datas) == 0)
					<h3>Belum Ada Belum Konfirmasi</h3>
					<p>belum ada Belum Konfirmasi</p>
				@else
				<table class="table table-striped mt-3" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">ID</th>
							<th scope="col">Nama Donatur</th>
							<th scope="col">Nama Projek</th>
							<th scope="col">Tgl Transaksi</th>
							<th scope="col">Nominal</th>
							<th scope="col">Status</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ ($k+1)}}</td>
							@if($v->bill_no == "")
								<td>{{ "INV-" . $v->created_at->format('ymd').sprintf("%05d", $v->id) }}</td>
							@else
								<td>{{ $v->bill_no }}</td>
							@endif
							<td>{{ $v->donature_name }}</td>
							<td><a href="{{url($v->project->slug)}}">{{ $v->project->title }}</a></td>
							<td>{{ $v->created_at->format('Y-m-d H:i:s') }}</td>
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
								<a href="{{ url('admin/not_confirmed/'.$v->id) }}" target="_blank" class="btn btn-sm btn-primary">Lihat Detail</a>
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
