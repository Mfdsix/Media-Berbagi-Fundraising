@extends('layouts.dashboard')
@section('title', 'Leaderboard Fundraiser')

@section('header', 'Leaderboard Fundraiser')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Leaderboard Fundraiser</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau performa fundraiser untuk campaign yang dipublikasi</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/fundraiser/leaderboard/export') }}"><span>Export</span></a>
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

				@if(count($fundraiser) == 0)
					<h3>Belum Ada Fundraiser</h3>
					<p>belum ada Fundraiser</p>
				@else
				<table class="table table-striped mt-3" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Klik</th>
							<th scope="col">Transaksi</th>
							<th scope="col">Terkumpul</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($fundraiser as $k => $v)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $v->fullname }}</td>
							<td>{{ $v->clicks }}</td>
							<td>{{ $v->transactions() }}</td>
							<td>Rp{{ number_format($v->collecteds(), 0, null, ".") }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="col-md-12 mt-4 d-flex justify-content-end">
					{{-- {{ $fundraiser->links() }} --}}
				</div>
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
