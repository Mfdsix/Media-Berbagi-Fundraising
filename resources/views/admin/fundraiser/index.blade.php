@extends('layouts.dashboard')
@section('title', 'List Fundraiser')

@section('header', 'List Fundraiser')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">List Fundraiser</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">semua fundraiser yang terdaftar</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body table-responsive">

				@if(count($datas) == 0)
					<h3>Belum Ada Fundraiser</h3>
					<p>belum ada Fundraiser</p>
				@else
				<table class="table table-striped mt-3" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">No Telpon</th>
							<th scope="col">Email</th>
							<th scope="col">Provinsi</th>
							<th scope="col">Tipe</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->fullname }}</td>
							<td>{{ $v->phone }}</td>
							<td>{{ $v->email }}</td>
							<td>{{ $v->province }}</td>
                            @if($v->type == 'personal')
							<td><span class="badge badge-success">Perorangan</span></td>
                            @else
							<td><span class="badge badge-primary">Lembaga</span></td>
                            @endif
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
<script>
	$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
@endsection
