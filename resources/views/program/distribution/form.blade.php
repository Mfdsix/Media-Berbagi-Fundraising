@extends('layouts.dashboard')
@section('title', 'Penyaluran Dana')

@section('css')
@endsection

@section('header', "Penyaluran Dana")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/dashboard-program/funding_distribution') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('dashboard-program/funding_distribution/'.$data->id) : url('dashboard-program/funding_distribution') }}">
			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="project_id">Program</label>
							<select @if(isset($data)) disabled @endif name="project_id" id="project_id" class="form-control">
                                <option value="">Pilih Program</option>
                                @foreach($projects as $k => $v)
                                <option @if(old('project_id') == $v->id || (isset($data) && $data->project_id == $v->id)) selected @endif value="{{ $v->id }}">{{ $v->title }} ({{ number_format(($v->countDonation()-$v->withdrawal()),0,null, '.') }})</option>
                                @endforeach
                            </select>
							@error('project_id')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

                        <div class="mb-4">
                            <label for="nominal">Nominal</label>
                            <div class="input-group">
                                <div class="input-group-text">Rp</div>
                                <input @if(isset($data)) disabled @endif type="text" name="nominal" class="form-control" type="number" value="{{ old('nominal') ?? (isset($data) ? $data->nominal : '0') }}">
                            </div>
                            @error('nominal')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
                        </div>

						<div class="mb-4">
                            <label for="use_plan">Keterangan/Judul Penyaluran</label>
                            <input class="form-control" type="text" name="use_plan" id="use_plan" value="{{ old('use_plan') ?? (isset($data) ? $data->use_plan : null) }}" required/>
                            @error('use_plan')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
                        </div>

						<div class="mb-4">
                            <label for="use_plan">Penerima Manfaat</label>
							<div class="input-group">
								<input type="number" name="receiver" min="1" class="form-control" required value="{{ old('receiver') ?? (isset($data) ? $data->receiver : null) }}">
								<div class="input-group-text">
									<input type="text" name="receiver_unit" class="form-control" style="padding: 0.1em 0.5em;" required value="orang" value="{{ old('receiver_unit') ?? (isset($data) ? $data->receiver_unit : null) }}">
								</div>
							</div>
                            @error('receiver')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
							@error('receiver_unit')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
                        </div>

						<div class="mb-4">
                            <label for="additional_link">Link Bukti Penyaluran</label>
                            <input class="form-control" type="text" name="additional_link" id="additional_link" value="{{ old('additional_link') ?? (isset($data) ? $data->additional_link : null) }}"/>
                            @error('additional_link')
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
