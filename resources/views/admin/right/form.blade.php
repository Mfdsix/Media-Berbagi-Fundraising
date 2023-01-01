@extends('layouts.dashboard')
@section('title', $title)

@section('css')
@endsection

@section('header', $title)

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ str_replace('/create', '', url()->current()) }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? str_replace('edit', '', url()->current()) : str_replace('/create', '', url()->current()) }}">
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
                                <option @if(old('project_id') == $v->id || (isset($data) && $data->project_id == $v->id)) selected @endif value="{{ $v->id }}">{{ $v->title }} Rp({{ number_format($v->limit, 0, null, ".") }})</option>
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
                            <label for="use_plan">Catatan</label>
                            <textarea class="form-control" name="use_plan" id="use_plan" cols="30" rows="10" required>{{ old('use_plan') ?? (isset($data) ? $data->use_plan : null) }}</textarea>
                            @error('use_plan')
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
