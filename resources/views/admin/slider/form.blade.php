@extends('layouts.dashboard')
@section('title', 'Kelola Slider')

@section('header', "Kelola Slider")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/slider') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/slider/'.$data->id) : url('admin/slider') }}" method="post">
			@csrf
			@if(isset($data))
			<input type="hidden" name="_method" value="PUT">
			@endif

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="title">Link Target</label>
							<input type="text" class="form-control" id="link_target" placeholder="Link Target" name="link_target" required="" value="{{ isset($data) ? $data->link_target : old('link_target') }}">
							@error('link_target')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="slider">Foto Slider</label>
							<p class="text-warning">slider image recommendation 600x300px</p>
							<input type="file" class="form-control" id="slider" placeholder="Foto" name="slider">
							@error('slider')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

					</div>
				</div>
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection
