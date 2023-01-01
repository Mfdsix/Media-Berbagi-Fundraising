@extends('layouts.dashboard')
@section('title', 'Kontak Donatur')

@section('header', 'Kontak Donatur')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Kontak Donatur</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">simpan kontak berikut untuk promosi campaign kedepannya</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">

				@if(count($datas) == 0)
					<h3>Belum ada kontak</h3>
					<p>belum ada kontak</p>
				@else
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Nomor WA</th>
							<th scope="col">Email</th>
							<th scope="col">Donasi</th>
							<th scope="col">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->donature_name }}</td>
							<td>{{ $v->donature_phone }}</td>
							<td>{{ $v->donature_email }}</td>
							<td>{{ $v->donated }}x donasi</td>
							<td>{{ number_format($v->nominal_donated,0 ,null, ".") }}</td>
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
	<script type="text/javascript">
		$(document).ready(function(){
			$(".btn-send").on("click", function(){
				var id = $(this).data('id');
				var btn = $(this);
				var target = $(".sender-wrap[data-id='"+id+"']");

				btn.prop('disabled', true);
				btn.html('<i class="fas fa-spin fa-spinner"></i>');

				$.ajax({
					url: '{{ url("admin/notif/send") }}',
					method: 'POST',
					data: {
						_token: '{{ csrf_token() }}',
						id: id
					},
					success: function(d){
						if(d.success){
							target.html(d.sended);
						}else{
							alert(d.message);
						}
						btn.prop('disabled', false);
						btn.html('Kirim');
					},
					error: function(e){
						btn.prop('disabled', false);
						btn.html('Kirim');
						alert("Terjadi Kesalahan");
					}
				});
			});
		})
	</script>
	@endsection
