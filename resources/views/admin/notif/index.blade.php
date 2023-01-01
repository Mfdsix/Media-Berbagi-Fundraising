@extends('layouts.dashboard')
@section('title', 'Notifikasi Email')

@section('header', 'Notifikasi Email')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Notifikasi Email</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kirim email blast ke daftar email donatur aktif</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/notif/create') }}"><span>Buat Notifikasi</span></a>
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
				<div class="box-body">
					<h3>Belum Ada Notifikasi</h3>
					<p>belum ada Notifikasi</p>
				</div>
				@else
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Judul</th>
							<th scope="col">Terkirim</th>
							<th scope="col">Dibuat Pada</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->title }}</td>
							<td class="sender-wrap" data-id="{{ $v->id }}">{{ str_replace(',', '.', number_format($v->sended)) }}</td>
							<td>
								<span class="badge badge-success">{{ Date('d F Y H:i:s', strtotime($v->created_at)) }}</span>
							</td>
							<td>
								<button data-id="{{ $v->id }}" class="btn btn-primary btn-sm btn-send">Kirim Notif</button>
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
