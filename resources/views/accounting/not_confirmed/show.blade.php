@extends('layouts.dashboard')
@section('title', 'Detail Donasi')

@section('header', 'Detail Donasi')

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/accounting/not_confirmed/payment_gateway') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td width="50%">Nama Projek</td>
							<td width="50%" class="font-weight-bold">{{ $data->project ? $data->project->title : '-' }}</td>
						</tr>
						<tr>
							<td>Nominal Donasi</td>
							<td class="font-weight-bold">Rp {{ str_replace(',', '.', number_format($data->nominal)) }}</td>
						</tr>
						<tr>
							<td>Kode Unik</td>
							<td class="font-weight-bold">{{ str_replace(',', '.', number_format($data->unique_code)) }}</td>
						</tr>
						<tr>
							<td>Total Transfer</td>
							<td class="font-weight-bold">Rp {{ str_replace(',', '.', number_format($data->nominal + $data->unique_code)) }}</td>
						</tr>
						<tr>
							<td>Status</td>
							<td class="font-weight-bold">
							@if($data->status == 'canceled')
                                <span class="text-danger">Dibatalkan</span>
                                @elseif($data->status == 'pending')
                                <span class="text-default">Menunggu</span>
                                @elseif($data->status == 'waiting')
                                <span class="text-primary">Menunggu Verifikasi</span>
                                @elseif($data->status == 'rejected')
                                <span class="text-danger">Bukti Ditolak</span>
                                @elseif($data->status == 'paid')
                                <span class="text-primary">Berhasil</span>
                                @endif
							</td>
						</tr>
						<tr>
							<td>Nama Donatur</td>
							<td class="font-weight-bold">{{ $data->donature_name }}</td>
						</tr>
						<tr>
							<td>Metode Pembayaran</td>
							<td class="font-weight-bold p-3">
								<img height="50" src="{{ $bank['icon'] }}"> {{ $bank['name'] }}
							</td>
						</tr>
						@if($data->payment_type == 'bank')
						<tr>
							<td>Bukti Pembayaran</td>
							@if($data->path_proof != null)
							<td class="font-weight-bold"><img src="{{ asset('storage/'.$data->path_proof) }}" class="img-fluid"></td>
							@else
							<td class="font-weight-bold">Belum Upload Bukti Pembayaran</td>
							@endif
						</tr>
						@endif
						</tbody>
					</table>

					<div class="mt-4">
						<div class="text-center">
							<button data-toggle="modal" data-target="#modal-confirm" class="btn btn-lg fs-16 btn-success">Konfirmasi</button>
							<button data-toggle="modal" data-target="#modal-edit" class="btn btn-lg fs-16 btn-warning">Edit</button>
							<button data-toggle="modal" data-target="#modal-delete" class="btn btn-lg fs-16 btn-danger">Hapus</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="modal-confirm" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<form class="modal-content" method="post" enctype="multipart/form-data" action="{{ url()->current().'/verify' }}">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Konfirmasi Transfer</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5 class="font-weight-bold">Dana sudah kami terima</h5>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Konfirmasi</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>

	<div class="modal" id="modal-edit" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<form class="modal-content" method="post" enctype="multipart/form-data" action="{{ url()->current().'/update' }}">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Edit</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Nominal</label>
						<input type="text" name="nominal" class="form-control rupiah" value="{{ $data->total }}">
					</div>
					<div class="form-group">
						<label>Nama Donatur</label>
						<input type="text" name="donature_name" class="form-control" value="{{ $data->donature_name }}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success btn-delete">Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>

	<div class="modal" id="modal-delete" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<form class="modal-content" method="post" enctype="multipart/form-data" action="{{ url()->current().'/delete' }}">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title">Hapus Donasi</h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h5 class="font-weight-bold">Yakin ingin menghapus donasi ?</h5>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-danger">Yakin</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>
	</div>

	@endsection

	@section('js')
	<script type="text/javascript">
		$(document).ready(function(){
		});
	</script>
	@endsection
