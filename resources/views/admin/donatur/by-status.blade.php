@extends('layouts.dashboard')
@section('title', $title)

@section('header', $title)

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">{{ $title }}</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau semua data donatur</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
					<a class="h6 font-w500 text-end" href="{{ url()->current(). '/export' }}"><span>Export</span></a>
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

				@if(count($donaturs) == 0)
					<h3>Belum Ada Dana Donatur</h3>
					<p>belum ada Dana Donatur</p>
				@else
				<table class="table table-striped mt-3" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Email</th>
							<th scope="col">Telepon</th>
							<th scope="col">Nominal</th>
							<th scope="col">Status</th>
						</tr>
					</thead>
					<tbody>
						@foreach($donaturs as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->donature_name }}</td>
							<td>{{ $v->donature_email }}</td>
							<td>{{ $v->donature_phone }}</td>
							<td>{{ number_format($v->nominal, 0, null, ".") }}</td>
                            <td>
                                @if($v->status == 'paid')
                                <span class="badge badge-success">Sukses</span>
                                @elseif($v->status == 'canceled')
                                <span class="badge badge-danger">Dibatalkan</span>
                                @elseif($v->status == 'pending' && $v->time_limit >= date('Y-m-d H:i:s'))
                                <span class="badge badge-warning">Kadaluarsa</span>
                                @else
                                <span class="badge badge-warning">Pending</span>
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

@section('js')
<script>
	$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
@endsection