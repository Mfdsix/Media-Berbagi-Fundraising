@extends('layouts.dashboard')
@section('title', 'Transaksi Fundraiser')

@section('header', 'Transaksi Fundraiser')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Transaksi Fundraiser</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">semua transaksi fundraiser</p>
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
					<h3>Belum Ada Transaksi</h3>
					<p>belum ada transaksi</p>
				@else
				<table class="table table-striped mt-3">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Fundraiser</th>
							<th scope="col">Nominal</th>
							<th scope="col">Tipe</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->fundraiser->fullname }}</td>
							<td>{{ number_format($v->amount,0, null, '.') }}</td>
                            @if($v->type == 'withdraw')
							<td>
                                <span class="badge badge-primary">Penarikan</span>
                            </td>
                            @else
                            <td>
                                <span class="badge badge-warning">Donasi</span>
                            </td>
                            @endif
                            <td>
                                <a href="{{ url('/admin/fundraiser/transaction/' . $v->id . '/detail') }}" class="btn btn-success">Lihat detail</a>
                            </td>
						</tr>
						@endforeach
					</tbody>
				</table>

				<div class="col-md-12 mt-4 d-flex justify-content-end">
					{{ $datas->links() }}
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
