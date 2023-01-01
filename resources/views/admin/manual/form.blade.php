@extends('layouts.dashboard')
@section('title', 'Donasi Manual')

@section('header', "Donasi Manual")

@section('css')
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/manual_donation') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('admin/manual_donation/'.$data->id) : url('admin/manual_donation') }}">
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
							<label for="project_id">Program</label>
							@if(isset($data))
							<input class="form-control" value="{{ $data->project == null ? "Program instant ".$data->fund_type : $data->project->title }}" disabled>
							@else
							<select name="project_id" id="project_id" class="form-control selectpicker" required="" data-live-search="true">
                                <option value="">
									@if(isset($data))
									{{$data->project_id}}
									@else
									Pilih Program
									@endif
								</option>
                                @foreach($projects as $k => $v)
                                <option @if(old('project_id') == $v->id || (isset($data) && $data->project_id == $v->id)) selected @endif value="{{ base64_encode(json_encode([$v->id,$v->type])) }}">{{ $v->title }}</option>
                                @endforeach
							</select>
							@endif
							@error('project_id')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">Fundraisers</label>
							<select name="fundraiser_id" class="form-control selectpicker" data-live-search="true">
								<option value="">Pilih Fundraisers</option>
								@foreach($fundraisers as $k => $v)
								<option @if(isset($data) && $data->referral_id == $v->user_id) selected @endif value="{{ $v->id }}">{{ $v->fullname }} ({{$v->referral_code}})</option>
								@endforeach
							</select>
							@error('fundraiser_id')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">Email Pendonasi</label>
							<input type="email" class="form-control" id="donature_email" placeholder="Email Pendonasi" name="donature_email" value="{{ isset($data) ? $data->donature_email : old('donature_email') }}">
							@error('donature_email')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="title">No Telfon Pendonasi</label>
							<input type="text" class="form-control" id="donature_phone" placeholder="No Telfon Pendonasi" name="donature_phone" value="{{ isset($data) ? $data->donature_phone : old('donature_phone') }}">
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

						{{--pilih tanggal waktu--}}
						<div class="mb-4">
							<label for="title">Tanggal Donasi</label>
							<div class="input-group">
								<input type="datetime-local" class="form-control" id="date" placeholder="Tanggal Donasi" name="date" required="" value="{{ isset($data) ? $data->created_at->format('Y-m-d\TH:i:s') : old('date') }}">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
							@error('date')
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
