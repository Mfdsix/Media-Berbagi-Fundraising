@extends('layouts.dashboard')
@section('title', 'Transaksi Online')

@section('header', 'Transaksi Online')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Transaksi Online</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau semua donasi melalui payment gateway dan transfer</p>
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
				<a class="nav-link active" href="#">Payment Gateway</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ url('/accounting/not_confirmed/manual') }}">Manual</a>
			</li>
		</ul>
	</div>
</div>

<div class="row mt-2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">

				@if(count($datas) == 0)
					<h3>Belum Ada Transaksi</h3>
					<p>belum ada transaksi</p>
				@else
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Donatur</th>
							<th scope="col">Nama Projek</th>
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
							<td>{{ $v->project ? $v->project->title : '-' }}</td>
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
								<a href="{{ url('accounting/not_confirmed/'.$v->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="col-md-12 mt-4 d-flex justify-content-end">
					{{ $datas->links() }}
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script type="text/javascript"></script>
@endsection
