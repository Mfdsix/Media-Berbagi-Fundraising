@extends('layouts.dashboard')
@section('title', 'Riwayat Komisi')

@section('header', 'Riwayat Komisi')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Riwayat Komisi</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">riwayat komisi dari donasi dengan link anda</p>
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
				<h3>Belum Ada Komisi</h3>
				<p>belum ada komisi</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body table-responsive">
				<p>Total komisi anda</p>
				<h1>Rp{{ number_format($fundraiser->commissions, 0, null,'.') }}</h1> <br><br>

					<table class="table table-striped" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Donatur</th>
							<th scope="col">Nominal</th>
							<th scope="col">Komisi</th>
							<th scope="col">Fee</th>
							<th scope="col">Tanggal</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
                            <td>{{ $v->donature_name }}</td>
                            <td>{{ $v->donation ? number_format($v->donation->nominal, 0, null, '.') : 0 }}</td>
                            <td>{{ number_format($v->amount, 0, null, '.') }}</td>
							<td>{{ $v->fee }}%</td>
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