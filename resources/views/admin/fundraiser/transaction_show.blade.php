@extends('layouts.dashboard')
@section('title', 'Detail Transaksi')

@section('header', "Detail Transaksi")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/fundraiser/transaction') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
        <div class="box">
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>Nama Fundraiser</td>
                            <td>{{ $data->fundraiser->fullname }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Transaksi</td>
                            @if($data->type == 'withdraw')
							<td>
                                <span class="badge badge-primary">Penarikan</span>
                            </td>
                            @else
                            <td>
                                <span class="badge badge-warning">Donasi</span>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td>Nominal</td>
                            <td>{{ number_format($data->amount, 0, null, '.') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>{{ date('d M Y', strtotime($data->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td class="text-success">{{ $data->status }}</td>
                        </tr>
                        <tr>
                            <td>Nama Bank</td>
                            <td>{{ $data->fundraiser->bank_account_name }}</td>
                        </tr>
                        {{-- nomor rekening --}}
                        <tr>
                            <td>Nomor Rekening</td>
                            <td>{{ $data->fundraiser->bank_account_number }}</td>
                        </tr>
                        {{-- kode bank --}}
                        <tr>
                            <td>Kode Bank</td>
                            <td>{{ $data->fundraiser->bank_account_code }}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- button verifikasi --}}
                @if($data->status == 'pending')
                <div class="text-center">
                    <a href="{{ url('/admin/fundraiser/transaction/verify/'.$data->id) }}" class="btn btn-primary">Verifikasi</a>
                    <a href="{{ url('/admin/fundraiser/transaction/reject/'.$data->id) }}" class="btn btn-danger">Batalkan</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
