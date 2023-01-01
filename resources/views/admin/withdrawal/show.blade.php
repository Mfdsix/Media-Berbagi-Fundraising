@extends('layouts.dashboard')
@section('title', 'Penarikan Dana')

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">Penarikan Dana</h2>
	<h5 class="text-white op-7 mb-2">Penarikan Dana</h5>
</div>
<div class="ml-md-auto py-2 py-md-0">
</div>
@endsection

@section('content')
<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				<div class="card-sub">
					Detail Penarikan Dana
				</div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td width="50%">Nama Projek</td>
							<td width="50%" class="font-weight-bold">{{ $data->project->title }}</td>
						</tr>
						<tr>
							<td>Nominal</td>
							<td class="font-weight-bold">Rp {{ str_replace(',', '.', number_format($data->nominal)) }}</td>
						</tr>
						<tr>
							<td>Status</td>
							<td class="font-weight-bold">
								@if($data->status == 0)
								<span class="badge badge-warning">Menunggu Konfirmasi</span>
								@elseif($data->status == 1)
								<span class="badge badge-success">Berhasil</span>
								@elseif($data->status == 2)
								<span class="badge badge-danger">Gagal</span>
								@endif
							</td>
						</tr>
						<tr>
							<td colspan="2" class="font-weight-bold">Detail Bank</td>
						</tr>
						<tr>
							<td>Bank Tujuan</td>
							<td class="font-weight-bold">{{ $fundraiser->bank_name }}</td>
						</tr>
						<tr>
							<td>Nomor Rekening</td>
							<td class="font-weight-bold">{{ $fundraiser->bank_account }}</td>
						</tr>
						<tr>
							<td>Atas Nama</td>
							<td class="font-weight-bold">{{ $fundraiser->bank_username }}</td>
						</tr>
					</tbody>
				</table>

				<div class="row mt-4">
					<div class="col-md-6">
						<button data-toggle="modal" data-target="#modal-confirm" class="btn btn-lg btn-block btn-success">Sudah Ditransfer</button>
					</div>
					<div class="col-md-6">
						<button data-toggle="modal" data-target="#modal-reject" class="btn btn-lg btn-block btn-danger">Tolak Penarikan</button>
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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 class="font-weight-bold">Dana sudah ditransfer</h5>
				<div class="form-group">
					<label style="font-weight: normal;">Sertakan bukti pembayaran</label>
					<input type="file" name="proof" class="form-control" required="">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success btn-delete">Konfirmasi</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</form>
	</div>
</div>

<div class="modal" id="modal-reject" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<form class="modal-content" method="post" enctype="multipart/form-data" action="{{ url()->current().'/reject' }}">
			@csrf
			<div class="modal-header">
				<h5 class="modal-title">Konfirmasi Penolakan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 class="font-weight-bold">Penarikan Dana ditolak</h5>
				<div class="form-group">
					<label style="font-weight: normal;">Sertakan alasan penolakan</label>
					<textarea name="reject_reason" class="form-control" required="" placeholder="alasan penolakan"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger">Tolak</button>
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