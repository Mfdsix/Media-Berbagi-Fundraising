@extends('layouts.dashboard')
@section('title', 'Dana Terkumpul')

@section('header', 'Dana Terkumpul')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Dana Terkumpul</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">pantau progress donasu campaign aktif</p>
					</div>
				</div>
				<div class="col-md-6 mb-0">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<h3>Program Terikat</h3>
	</div>
	@if(count($instant) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada Penggalangan Dana</h3>
				<p>mulai galang dana sekarang</p>
			</div>
		</div>
	</div>
	@else
	@foreach($instant as $k => $v)
	<div class="col-md-12 mb-3">
		<div class="box mb-4">
			<div class="box-body">
				<div class="row">
					<div class="col-md-2 mb-0">
						<img class="img-responsive" src="{{ asset('assets/img/sedekah-icon.svg') }}" alt="Card image cap">
					</div>
					<div class="col-md-10 mb-0">
						<a href="javascript:void(0)">
							<h4 class="mb-0">{{ $v['title'] }}</h4>
						</a>
						<p class="text-primary">Tidak Terikat</p>
						<div class="row">
							<div class="col-6 mb-0 text-primary">
								{{ str_replace(',', '.', number_format($v['donations'])) }}
							</div>
							<div class="col-6 mb-0 text-right">
								Tidak Terbatas
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	@endif
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<h3>Program Terikat</h3>
	</div>
	@if(count($datas) == 0)
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<h3>Belum Ada Penggalangan Dana</h3>
				<p>mulai galang dana sekarang</p>
			</div>
		</div>
	</div>
	@else
	@foreach($datas as $k => $v)
	<div class="col-md-12 mb-3">
		<div class="box mb-4">
			<div class="box-body">
				<div class="row">
					<div class="col-md-2 mb-0">
						@if($v->path_featured == null)
						<img class="img-responsive" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
						@else
						<img class="img-responsive" src="{{ asset('storage/'.$v->path_featured) }}" alt="Card image cap">
						@endif
					</div>
					<div class="col-md-10 mb-0">
						<a href="javascript:void(0)">
							<h4 class="mb-0">{{ $v->title }}</h4>
						</a>
						<p class="text-primary">Program</p>
						<div class="bg-grey" style="border-radius: 0.25rem">
						<div class="progress">
							<div class="progress-bar" role="progressbar" style="width: {{ $v->percentage }}%" aria-valuenow="{{ $v->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						</div>
						<div class="row">
							<div class="col-6 mb-0 text-primary">
								{{ str_replace(',', '.', number_format($v->donations)) }}
							</div>
							<div class="col-6 mb-0 text-right">
								{{ $v->date_target }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="col-md-12 mt-4">
		{{ $datas->links() }}
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
			$("#form-delete").attr('action', '{{ url("admin/funding") }}'+'/'+id);
			$("#modal-delete").modal('show');
		});

		$(".btn-delete").on("click", function(){
			$("#form-delete").submit();
		});
	});
</script>
@endsection
