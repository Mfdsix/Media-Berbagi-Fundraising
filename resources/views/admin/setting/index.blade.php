@extends('layouts.dashboard')
@section('title', 'Pengaturan')

@section('header', 'Pengaturan')

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Pengaturan Sistem</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kustom website</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ url('admin/setting') }}">

			<div class="box-body">

				<div class="row">
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="gold_price">Harga Emas</label>
							<input type="text" class="form-control rupiah" id="gold_price" placeholder="Harga Emas" name="gold_price" value="{{ $data['gold_price'] ?? 0 }}">
							@error('gold_price')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="silver_price">Harga Silver</label>
							<input type="text" class="form-control rupiah" id="silver_price" placeholder="Harga Silver" name="silver_price" value="{{ $data['silver_price'] ?? 0 }}">
							@error('silver_price')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

					</div>
				</div>
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
				</div>

			</div>

		</form>
	</div>
</div>
<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ url('admin/color') }}">

			<div class="box-body">

				<div class="row">
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="row">
							<div class="col-3">
								<div class="mb-4">
									<label for="primary">Primary</label><br>
									<input type="color" name="primary" style="
									background: {{$data->primary ?? '#4154f1'}};
									border-radius: 10px;
									height: 35px;
									width: 100%;
									border: {{$data->primary ?? '#4154f1'}};" value="{{$data->primary ?? '#4154f1'}}" style="width:85%;">
									@error('primary')
									<small class="form-text text-danger">{{ $message }}</small>
									@enderror
								</div>
							</div>
							<div class="col-3">
								<div class="mb-4">
									<label for="secondary">Secondary</label><br>
									<input name="secondary" type="color" style="
									background: {{$data->secondary ?? '#fdb504'}};
									border-radius: 10px;
									height: 35px;
									width: 100%;
									border: {{$data->secondary ?? '#fdb504'}};" value="{{$data->secondary ?? '#fdb504'}}" style="width:85%;">
									@error('secondary')
									<small class="form-text text-danger">{{ $message }}</small>
									@enderror
								</div>
							</div>
							<div class="col-3">
								<div class="mb-4">
									<label for="danger">Failed</label><br>
									<input name="danger" type="color" style="
									background: {{$data->danger ?? '#ff2445;'}};
									border-radius: 10px;
									height: 35px;
									width: 100%;
									border: {{$data->danger ?? '#ff2445;'}};" value="{{$data->danger ?? '#ff2445;'}}" style="width:85%;">
									@error('danger')
									<small class="form-text text-danger">{{ $message }}</small>
									@enderror
								</div>
							</div>
							<div class="col-3">
								<div class="mb-4">
									<label for="trans_primary">Soft Primary</label><br>
									<input name="trans_primary" type="color" style="
									background: {{$data->trans_primary ?? '#ffce47'}};
									border-radius: 10px;
									height: 35px;
									width: 100%;
									border: {{$data->trans_primary ?? '#ffce47'}};" value="{{$data->trans_primary ?? '#ffce47'}}" style="width:85%;">
									@error('trans_primary')
									<small class="form-text text-danger">{{ $message }}</small>
									@enderror
								</div>
							</div>
							<div class="col-3">
								<div class="mb-4">
									<label for="trans_secondary">Soft Secondary</label><br>
									<input name="trans_secondary" type="color" style="
									background: {{$data->trans_secondary ?? '#ffce47'}};
									border-radius: 10px;
									height: 35px;
									width: 100%;
									border: {{$data->trans_secondary ?? '#ffce47'}};" colorformat="rgba" value="{{$data->trans_secondary ?? '#ffce47'}}" style="width:85%;">
									@error('trans_secondary')
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
		</form>
	</div>
</div>
<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ url('admin/logo') }}">

			<div class="box-body">

				<div class="row">
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="logo">Logo</label><br>
							<p class="text-warning">logo image recommendation 130x50px</p>
							@if (isset($data->path_logo))
							<img alt="Brand Lembaga" width="150px" src="{{url("storage/".$data->path_logo)}}">
							@else
							<img alt="Brand Lembaga" width="150px" src="{{url("images/logo.svg")}}">
							@endif
							<input type="file" class="form-control" id="logo" value="{{$data->title ?? 'FORFUND'}}" placeholder="Logo" name="logo">
							@error('logo')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="logo">Icon</label><br>
							<p class="text-warning">logo image recommendation 64x64px</p>
							@if (isset($data->path_icon))
							<img alt="Icon Lembaga" width="150px" src="{{url("storage/".$data->path_icon)}}">
							@else
							<img alt="Icon Lembaga" width="150px" src="{{url("images/logo.svg")}}">
							@endif
							<input type="file" class="form-control" id="logo" value="{{$data->title ?? 'FORFUND'}}" placeholder="Icon" name="icon">
							@error('icon')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="name_app">Nama Lembaga</label>
							<input type="text" class="form-control" id="name_app" value="{{$data->title}}" placeholder="Nama Lembaga" name="name" autocomplete="{{ sha1(time()) }}">
							@error('name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

					</div>
				</div>
				<div class="gr-btn text-end">
					<button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
				</div>

			</div>
		</form>
	</div>
</div>
@endsection

@section('js')
@endsection
