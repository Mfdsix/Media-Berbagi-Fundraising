@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('css')
@endsection

@section('content')
<nav class="navbar bg-primary navbar-dark fixed-top" id="navbar-fixed">
	<div class="main-width">
		<div class="flex max-width main-navbar p-3" style="justify-content: flex-start;">
			<a href="{{ auth()->check() ? url('top_up') : url('') }}" class="text-white">
				<i class="fas fa-arrow-left"></i>
			</a>
			<h6 class="ml-3 mb-0 one-line text-white">Detail Transaksi</h6>
		</div>
	</div>
</nav>

<div class="main-width">
	<div class="body-section">

		<div class="bg-white rounded p-4 mb-2">
			<h5>Detail Transaksi</h5>
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td>No Referensi</td>
						<td>{{ $transaction->reference }}</td>
					</tr>
					<tr>
						<td>Nominal Topup</td>
						<td>Rp {{ number_format($transaction->nominal,0,',','.') }}</td>
					</tr>
					<tr>
						<td>Tanggal Transaksi</td>
						<td>{{ $transaction->note_at }}</td>
					</tr>
					<tr>
						<td>Metode Pembayaran</td>
						<td class="font-weight-bold">
							<img src="{{ asset($payment['icon']) }}" height="20" class="mr-2">
							<p>{{ $payment['payment_method'] }}</p>
						</td>
					</tr>
					<tr>
						<td>Status Transaksi</td>
						<td>
							@if($transaction->status == 0)
							<span class="badge badge-warning">Menunggu Pembayaran</span>
							@elseif($transaction->status == 1)
							<span class="badge badge-success">Berhasil</span>
							@else
							<span class="badge badge-danger">Dibatalkan</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>Tanggal Pembayaran</td>
						<td>{{ $transaction->pay_at }}</td>
					</tr>
				</tbody>
			</table>
			@if($transaction->status == 0)
			<hr>
			<button data-toggle="modal" data-target="#modal-delete" class="btn-delete-trigger btn btn-block btn-danger">Batalkan Topup</button>
			@endif
		</div>

	</div>
</div>

<div class="modal" id="modal-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Batalkan Topup</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin mambatalkan topup ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-delete">Ya</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<form method="post" id="form-delete" action="{{ url('/top_up/'. $transaction->id . '/cancel') }}">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
</form>

<nav class="footer-menu main-width">
	@if($transaction->status == 0)
	<a href="{{ url('top_up/'.$transaction->id.'/how_to_pay') }}" class="btn btn-accent btn-block font-weight-bold btn-donate">Instruksi Pembayaran</a>
	@endif
</nav>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection