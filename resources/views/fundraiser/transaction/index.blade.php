@extends('layouts.dashboard')
@section('title', 'Riwayat Transaksi')

@section('header', 'Riwayat Transaksi')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Riwayat Transaksi</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">riwayat semua transaksi anda</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada Transaksi</h3>
				<p>belum ada transaksi</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body table-responsive">
				<table class="table table-striped" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Nominal</th>
							<th scope="col">Jenis Transaksi</th>
							<th scope="col">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							@if($v->type == "commission")
								<td><b>Donasi oleh </b>{{ $v->donation != null ? $v->donation->donature_name : "" }}</td>
							@elseif($v->type == "withdraw")
								<td><b>Penarikan Dana </b>{{ $v->donation != null ? $v->donation->donature_name : "" }}</td>
							@endif

                            <td>{{ number_format($v->amount, 0, null, '.') }}</td>
                            <td>
								@if($v->type == 'commission')
								<span class="badge badge-success">Komisi Donasi</span>
								@elseif($v->type == 'withdraw')
								<span class="badge badge-primary">Penarikan</span>
								@elseif($v->type == 'donation')
								<span class="badge badge-warning">Donasi</span>
								@endif
							</td>
                            <td>{{ date('d M Y H:i', strtotime($v->created_at)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>
	@endif
</div>
@endsection

@section('js')
<script>
	$(document).ready(function() {
		$('#table').DataTable();
	});
</script>
@endsection