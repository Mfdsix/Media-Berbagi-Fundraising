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
<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				<div class="card-sub">
					Detail Bukti Pembayaran
				</div>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td width="50%">Nama Projek</td>
							<td width="50%" class="font-weight-bold">
								@foreach($data->qurban_details as $k => $qb)
									<a href="{{ url('admin/qurban/'.$qb->id.'/edit') }}">{{$k+1 .' - '. $qb->qurban->title}}</a> <br>
								@endforeach
							</td>
						</tr>
						<tr>
							<td>Rincian</td>
							<td class="font-weight-bold">
								@foreach($data->qurban_details as $k => $qb)
									<div class="py-2 d-flex justify-content-between w-100">
										<div>{{$k+1 .' - '. $qb->qurban->title}}</div>
										<div>x{{$qb->quantity}}</div>
										<div>Rp {{ str_replace(',', '.', number_format($qb->qurban->price)) }}</div>
									</div>
								@endforeach
								<hr>
								<div class="py-2 d-flex justify-content-between w-100">
									<div>Total</div>
									<div>Rp {{ str_replace(',', '.', number_format($data->nominal)) }}</div>
								</div>
							</td>
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
							<td>Nama Donatur</td>
							<td class="font-weight-bold">{{ $data->donature_name }}</td>
						</tr>
						<tr>
							<td>Metode Pembayaran</td>
							<td class="font-weight-bold">
								<img height="50" src="{{ $bank['icon'] }}"> {{ $bank['name'] }}</td>
						</tr>
						<tr>
							<td>Bukti Pembayaran</td>
							<td class="font-weight-bold">
								<a href="{{ asset('storage/'.$data->path_proof) }}" target="_blank">
									<img src="{{ asset('storage/'.$data->path_proof) }}" height="80" class="my-2">
								</a>
							</td>
						</tr>
					</tbody>
				</table>

				<div class="row mt-4">
					<div class="col-md-6">
						<button data-toggle="modal" data-target="#modal-confirm" class="btn btn-lg btn-block btn-success">Konfirmasi</button>
					</div>
					<div class="col-md-6">
						<button data-toggle="modal" data-target="#modal-reject" class="btn btn-lg btn-block btn-danger">Tolak Bukti</button>
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
				<h5 class="font-weight-bold">Dana sudah kami terima</h5>
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