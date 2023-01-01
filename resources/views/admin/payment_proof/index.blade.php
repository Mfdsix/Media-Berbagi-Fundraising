@extends('layouts.dashboard')
@section('title', 'Bukti Pembayaran')

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">Bukti Pembayaran</h2>
	<h5 class="text-white op-7 mb-2">Bukti Pembayaran</h5>
</div>
<div class="ml-md-auto py-2 py-md-0">
</div>
@endsection

@section('content')
@include('layouts.notif')
<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				<div class="card-sub">
					Daftar Bukti Pembayaran
				</div>
				@if(count($datas) == 0)
				<div class="card-body">
					<h3>Belum Ada Bukti Pembayaran</h3>
					<p>belum ada bukti pembayaran</p>
				</div>
				@else
				<table class="table mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Donatur</th>
							<th scope="col">Nama Projek</th>
							<th scope="col">Nominal</th>
							<th scope="col">Status</th>
							<th scope="col">Tanggal</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->donature_name }}</td>
							<td>{{ $v->project ? $v->project->title : '-' }}</td>
							<td>Rp {{ str_replace(',', '.', number_format($v->nominal)) }}</td>
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
							<td>{{$v->created_at->format('d M Y')}}</td>
							<td>
								<a href="{{ url('admin/payment_proof/'.$v->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
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