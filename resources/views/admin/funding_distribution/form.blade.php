@extends('layouts.dashboard')
@section('title', 'Penyaluran Dana')

@section('css')
<link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: var(--main-color) !important;
		color: #fff !important;
	}
</style>
@endsection

@section('header', "Penyaluran Dana")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/funding_distribution') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" method="post" action="{{ isset($data) ? url('admin/funding_distribution/'.$data->id) : url('admin/funding_distribution') }}">
			<div class="box-body">
				<div class="row">
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif
					@csrf
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="project_id">Program</label>
							@if(isset($data))
							<input class="form-control" value="{{ $projects->title }} ({{ number_format(($projects->nominal),0,null, '.') }})" disabled>
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
                                <option @if(old('project_id') == $v->id || (isset($data) && $data->project_id == $v->id)) selected @endif value="{{ base64_encode(json_encode([$v->id,$v->type])) }}">{{ $v->title }} ({{ number_format(($v->nominal),0,null, '.') }})</option>
                                @endforeach
							</select>
							@endif
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
                            <textarea class="form-control saminote" type="text" name="use_plan" id="use_plan" required>
							{{ old('use_plan') ?? (isset($data) ? $data->use_plan : null) }}
							</textarea>
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
		$('.saminote').summernote({
			tabsize: 2,
        	height: 300,
			callbacks: {
				onImageUpload: function(files, editor, welEditable) {
					sendFile(files[0], editor, welEditable);
				}
			}
		});
	});

	function sendFile(file,editor,welEditable) {
		let data = new FormData();
		data.append("file", file);
		$.ajax({
		data: data,
		type: "POST",
		url: '{{ url("/api/upload") }}',
		cache: false,
		contentType: false,
		processData: false,
		success: function(url) {
			var image = $('<img>').attr('src', url);
            $('.saminote').summernote("insertNode", image[0]);
		}
		});
	}
</script>
@endsection

