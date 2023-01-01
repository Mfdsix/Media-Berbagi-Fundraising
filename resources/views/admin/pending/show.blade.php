@extends('layouts.dashboard')
@section('title', 'Konfirmasi User Pending')

@section('header')
<div>
	<h2 class="text-white pb-2 fw-bold">Konfirmasi User Pending</h2>
	<h5 class="text-white op-7 mb-2">Konfirmasi User Pending</h5>
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
					Konfirmasi User Pending
				</div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td width="50%">Nama Penggalang Dana</td>
							<td width="50%" class="font-weight-bold">{{ $data->fullname }}</td>
						</tr>
						<tr>
							<td width="50%">Deksripsi</td>
							<td width="50%" class="font-weight-bold">{{ $data->description }}</td>
						</tr>
						<tr>
							<td width="50%">Alamat</td>
							<td width="50%" class="font-weight-bold">{{ $data->address }}</td>
						</tr>
						<tr>
							<td width="50%">Nama Bank</td>
							<td width="50%" class="font-weight-bold">{{ $data->bank_name }}</td>
						</tr>
						<tr>
							<td width="50%">Nomor Rekening</td>
							<td width="50%" class="font-weight-bold">{{ $data->bank_account }}</td>
						</tr>
						<tr>
							<td width="50%">Nama Pemilik Rekening</td>
							<td width="50%" class="font-weight-bold">{{ $data->bank_username }}</td>
						</tr>
					</tbody>
				</table>

				<div class="mt-4">
					<div class="text-center">
						<button data-toggle="modal" data-target="#modal-confirm" class="btn btn-lg btn-success">Konfirmasi</button>
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
				<h5 class="modal-title">Konfirmasi User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 class="font-weight-bold">Data user ini kami nyatakan valid</h5>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success btn-delete">Konfirmasi</button>
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