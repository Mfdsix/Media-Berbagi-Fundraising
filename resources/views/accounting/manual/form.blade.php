@extends('layouts.dashboard')
@section('title', 'Donasi Manual')

@section('header', "Donasi Manual")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/accounting/manual_donation') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('accounting/manual_donation/'.$data->id) : url('accounting/manual_donation') }}">
			<div class="bix-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">

						<div class="mb-4">
							<label for="title">Nama Pendonasi</label>
							<input type="text" class="form-control" id="donature_name" placeholder="Nama Pendonasi" name="donature_name" required="" value="{{ isset($data) ? $data->donature_name : old('donature_name') }}">
							@error('donature_name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">Campaign</label>
							<select name="project_id" class="form-control">
								<option value="">Pilih Campaign</option>
								@foreach($campaign as $k => $v)
								<option @if(isset($data) && $data->project_id == $v->id) selected @endif value="{{ $v->id }}">{{ $v->title }}</option>
								@endforeach
							</select>
							@error('project_id')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">Email Pendonasi</label>
							<input type="email" class="form-control" id="donature_email" placeholder="Email Pendonasi" name="donature_email" required="" value="{{ isset($data) ? $data->donature_email : old('donature_email') }}">
							@error('donature_email')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">No Telfon Pendonasi</label>
							<input type="text" class="form-control" id="donature_phone" placeholder="No Telfon Pendonasi" name="donature_phone" required="" value="{{ isset($data) ? $data->donature_phone : old('donature_phone') }}">
							@error('donature_phone')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">Jumlah Donasi</label>
							<input type="text" class="form-control rupiah" id="nominal" placeholder="Jumlah Donasi" name="nominal" required="" value="{{ isset($data) ? $data->nominal : old('nominal') }}">
							@error('nominal')
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	});
</script>
@endsection
