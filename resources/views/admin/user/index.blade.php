@extends('layouts.dashboard')
@section('title', 'User')

@section('header', "User")

@section('css')
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Kelola User</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kelola data user aplikasi</p>
					</div>
				</div>
                <div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						<a class="h6 font-w500 text-end" href="{{ url('/admin/user/create') }}"><span>Tambah User</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<ul class="nav nav-tabs">
			<li class="nav-item">
            	<a class="nav-link @if($type == 'admin') active @endif" href="{{ $type != 'admin' ? url('/admin/user') : 'javascript:void(0)' }}">Admin</a>
			</li>
			<li class="nav-item">
            	<a class="nav-link @if($type == 'program') active @endif" href="{{ $type != 'program' ? url('/admin/user/program') : 'javascript:void(0)' }}">Program</a>
			</li>
			<li class="nav-item">
            	<a class="nav-link @if($type == 'accounting') active @endif" href="{{ $type != 'accounting' ? url('/admin/user/accounting') : 'javascript:void(0)' }}">Akunting</a>
			</li>
			<li class="nav-item">
            	<a class="nav-link @if($type == 'gerai') active @endif" href="{{ $type != 'gerai' ? url('/admin/user/gerai') : 'javascript:void(0)' }}">Gerai</a>
			</li>
			<li class="nav-item">
				<a class="nav-link @if($type == 'user') active @endif" href="{{ $type != 'user' ? url('/admin/user/user') : 'javascript:void(0)' }}">Donatur</a>
			</li>
			<li class="nav-item">
				<a class="nav-link @if($type == 'fundraiser') active @endif" href="{{ $type != 'fundraiser' ? url('/admin/user/fundraiser') : 'javascript:void(0)' }}">Fundraiser</a>
			</li>
		</ul>
	</div>
</div>

<div class="row mt--2">
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada User</h3>
				<p>tambahkan user</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body table-responsive">
				<table class="table table-striped" id="table">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Username</th>
							<th scope="col">Email</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($datas as $k => $v)
						<tr>
							<td>{{ $k+1 }}</td>
							<td>{{ $v->name }}</td>
                            <td>{{ $v->email }}</td>
							<td>
								<a href="{{ url('admin/user/'.$v->id.'/edit') }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
								{{-- delete --}}
								<form action="{{ url('admin/user/'.$v->id) }}" method="post" class="d-inline">
									@csrf
									@method('delete')
									<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="bx bx-trash"></i></button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>
	@endif
</div>

@endsection

@section('js')
<script>
	$(document).ready(function() {
    $('#table').DataTable();
} );
</script>
@endsection