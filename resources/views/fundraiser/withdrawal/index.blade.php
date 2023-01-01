@extends('layouts.dashboard')
@section('title', 'Penarikan Komisi')

@section('header', 'Penarikan Komisi')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Penarikan Komisi</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">tarik komisi yang anda dapatkan dari link referral</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="box">
			<div class="box-body">
				<h3>Saldo Tersedia</h3>
				<p style="font-size: 48px">{{ number_format($fundraiser->commissions, 0, null,'.') }}</p>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">

		{{-- show error message session --}}
		@if (session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
		@endif

		{{-- show success message session --}}
		@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
		@endif


		@if($fundraiser->commissions == 0)
		<div class="alert alert-warning">* Saldo belum mencukupi untuk melakukan penarikan</div>
		@else
		<form class="box" enctype="multipart/form-data" method="post">
			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="nominal">Nominal Penarikan</label>
							<input type="number" class="form-control" id="nominal" placeholder="Nominal Penarikan" name="nominal" required="" value="{{ isset($data) ? $data->nominal : old('nominal') }}">
							@error('nominal')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>
						{{-- <div class="mb-4">
							<label for="nominal">Metode Penarikan</label>
							<select name="type" class="form-control">
								<option value="withdraw">Tarik Komisi</option>
								<option value="donate">Sedekahkan</option>
							</select>
							@error('nominal')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div> --}}
					</div>
				</div>
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">TARIK KOMISI</button>
				</div>
			</div>
		</form>
		@endif

		<div class="box mt-3">
			<div class="box-body">
			@if(count($histories) == 0)
				<div class="card-body">
					<h3>Belum Ada Riwayat Penarikan</h3>
					<p>belum ada riwayat penarikan</p>
				</div>
				@else
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Nominal</th>
							<th>Tanggal</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($histories as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ number_format($v->amount, 0, null, '.') }}</td>
							<td>{{ date('d M Y H:i', strtotime($v->created_at)) }}</td>
							<td>
								@if($v->status == 'pending')
								<span class="badge badge-warning">Menunggu Konfirmasi</span>
								@elseif($v->status == 'processed')
								<span class="badge badge-primary">Sedang Diproses</span>
								@elseif($v->status == 'success')
								<span class="badge badge-success">Berhasil</span>
								@elseif($v->status == 'canceled')
								<span class="badge badge-danger">Dibatalkan</span>
								@endif
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
