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
@include('layouts.notif')
<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="card card-post card-round text-center p-4">
			<div class="card-body">
				<div class="card-sub">
					Daftar Penarikan Dana
				</div>
				@if(count($datas) == 0)
				<div class="card-body">
					<h3>Belum Ada Penarikan</h3>
					<p>belum ada penarikan</p>
				</div>
				@else
				<table class="table mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama Projek</th>
							<th scope="col">Nominal</th>
							<th scope="col">Rencana Penggunaan</th>
							<th scope="col">Status</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->project ? $v->project->title : '-' }}</td>
							<td>Rp {{ str_replace(',', '.', number_format($v->nominal)) }}</td>
							<td>{{ $v->use_plan }}</td>
							<td>
								@if($v->status == 0)
								<span class="badge badge-warning">Menunggu Konfirmasi</span>
								@elseif($v->status == 1)
								<span class="badge badge-success">Berhasil</span>
								@elseif($v->status == 2)
								<span class="badge badge-danger">Gagal</span>
								@endif
							</td>
							<td>
								<a href="{{ url('admin/withdrawal/'.$v->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
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
<script type="text/javascript"></script>
@endsection