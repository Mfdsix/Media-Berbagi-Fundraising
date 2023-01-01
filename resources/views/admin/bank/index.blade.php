@extends('layouts.dashboard')
@section('title', 'Data Bank')

@section('header', 'Data Bank')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Data Bank</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">daftar bank untuk donasi non-payment gateway</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
					<div class="btn-now text-end d-block" id="statistics">
						@if($setting != 1)
						<a class="h6 font-w500 text-end" href="{{ url('/admin/bank/activate') }}"><span>Aktifkan Fitur Bank</span></a>
						@else
						<a class="h6 font-w500 text-end" href="{{ url('/admin/bank/activate') }}"><span>Nonaktifkan Fitur Bank</span></a>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if($setting == 1)
<div class="row mb-4">
	<div class="col-md-12 mb-3">
<div class="box">
	<div class="box-body">
		<div class="text-end">
			<a href="{{ url('/admin/bank/create') }}" class="btn btn-primary btn-lg fs-16">Tambah Bank</a>
		</div>
	</div>
	</div>
	</div>
</div>
@endif

<div class="row mt--2">
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada Bank</h3>
				<p>tambahkan data bank</p>
			</div>
		</div>
	</div>
	@else
	<div class="col-md-12 mb-3">
		<div class="row">
			@foreach($datas as $k => $v)
			<div class="col-md-6">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-md-4">
								<img src="{{ asset('storage/'.$v->path_icon) }}" style="width: 120px; height: auto">
							</div>
							<div class="col-md-6">
								<h5>{{ $v->bank_name }}</h5>
								<p class="mb-0"><b>{{ $v->bank_code }}</b> {{ $v->bank_number }}</p>
								<p>a.n {{ $v->bank_username }}</p>
							</div>
							<div class="col-md-2">
								<div class="dropdown">
									<a href="javascript:void(0);" class="btn-link mr-4" data-bs-toggle="dropdown" aria-expanded="false">
										<i class='bx bx-dots-horizontal-rounded fs-24'></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="{{ url('admin/bank/'.$v->id.'/edit') }}"><i class="bx bx-edit mr-5"></i>Edit</a>
										<a href="javascript:void(0);" data-id="{{ $v->id }}" class="dropdown-item btn-delete-trigger"><i class="bx bx-trash"></i> Hapus</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
	@endif
</div>

<div class="modal" id="modal-delete" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Yakin ingin menghapus data ?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-delete">Hapus</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
			</div>
		</div>
	</div>
</div>

<form method="post" id="form-delete">
	@csrf
	<input type="hidden" name="_method" value="DELETE">
</form>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function(){
		$(".btn-delete-trigger").on("click", function(){
			var id = $(this).data('id');
			$("#form-delete").attr('action', '{{ url("admin/bank") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
