@extends('layouts.dashboard')
@section('title', 'Produk Official Store')

@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<style type="text/css">
	.note-editor.note-frame .note-btn{
		background: var(--main-color) !important;
		color: #fff !important;
	}
</style>
@endsection

@section('header', "Produk Official Store")

@section('content')

<div class="row">
	<div class="col-md-12 mb-4">
		<div class="box box-primary">
			<div class="box-body pb-0">
				<div class="btn-now d-block py-0" id="statistics">
					<a class="h6 font-w500" href="{{ url('/admin/product') }}"><span>Kembali</span></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12">
		<form class="box" enctype="multipart/form-data" action="{{ isset($data) ? url('admin/product/'.$data->id) : url('admin/product') }}" method="post">
			@csrf
			@if(isset($data))
			<input type="hidden" name="_method" value="PUT">
			@endif

			<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="mb-4">
							<label for="name">Judul</label>
							<input type="text" class="form-control" id="name" placeholder="Judul" name="name" required="" value="{{ isset($data) ? $data->name : old('name') }}">
							@error('name')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>


						<div class="mb-4">
							<label for="foto">Foto</label>
							<input type="file" class="form-control" id="photo" placeholder="Foto" name="photo">
							@error('photo')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="price">Price (Rp)</label>
							<input type="text" class="form-control rupiah" id="price" placeholder="Harga" name="price" value="{{ isset($data) ? $data->price : old('price') }}">
							@error('price')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						{{-- https://wa.me/62XXXXXXXXXXX?text=Saya%20tertarik%20dengan%20mobil%20Anda%20yang%20dijual --}}

						<div class="mb-4">
							<label for="url">Nomor Whatsapp</label>
							<input type="text" class="form-control" id="url" placeholder="62xxxxxxxxxxx" name="url" value="{{ isset($data) ? str_replace('https://wa.me/','',$data->url) : old('url') }}">
							@error('url')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="detail">Konten</label>
							<textarea id="detail" name="detail" required="">{{ isset($data) ? $data->detail : old('detail') }}</textarea>
							@error('detail')
							<small class="form-text text-danger">{{ $message }}</small>
							@enderror
						</div>

						<div class="mb-4">
							<label for="custom">Custom</label>
							<div><small class="text-muted">Anda dapat menambahkan pilihan seperti warna ukuran dll</small></div>

							<div id="custom-group">
								@if(isset($data))
								@foreach(json_decode($data->custom) as $key => $variant)
								<span class="badge badge-secondary ml-2"><b>{{json_encode([$key => $variant])}}</b> <i class="fa fa-times ml-2" onclick="removeCustom(this, '{{$key}}')"></i></span>
								@endforeach
								@endif
							</div>

							<br><br>
							<input type="hidden" name="custom" id="custom" value="{{ isset($data) ? $data->custom : old('custom') }}">

							<button class="btn btn-primary btn-sm" type="button" class="btn btn-primary" data-toggle="modal" data-target="#customModal">Tambah Pilihan <i class="fas fa-plus"></i></button>

							@error('custom')
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
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customModalLabel">Buat Pilihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="mb-4">
			<label for="item-name">Nama Pilihan</label>
			<input type="text" class="form-control" id="item-name" placeholder="Misal : Warna" name="item-name" required="">
			<small class="form-text text-danger" id="item-name-error"></small>
		</div>

		<div class="mb-4">
			<label for="item-item">Tambah Item PIlihan</label>
			<div><small class="text-muted">Bisa Lebih Dari Satu</small></div> <br>

			<div class="item-item-group">
				<div class="d-flex"><input type="text" class="form-control flex-fill items-item-all" id="item-item" placeholder="Misal : Merah" name="item-item" required=""></div>
			</div>

			<small class="form-text text-danger" id="items-item-error"></small>
		</div>

		<button class="btn btn-primary btn-sm" onclick="addItem()" type="button">Tambah Item</button>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="saveItem()">Tambahkan</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#detail').summernote({
			tabsize: 2,
        	height: 300
		});
	});
	let inc = 0
	@if(isset($data))
		let customs = {!! $data->custom !!}
	@else
		let customs = {}
	@endif

	function addItem() {
		$('.item-item-group').append(`<div class="d-flex mt-2" id="items-item-${inc}"><input type="text" class="form-control flex-fill items-item-all" id="item-item-${inc}" placeholder="Misal : Merah" name="item-item" required=""> <span class="px-4" onclick="removeItem(${inc})"><i class="fa fa-times"></i></span></div>`)
		inc++
	}

	function removeItem(e) {
		$('#items-item-'+e).remove()
	}

	function saveItem() {
		let json = []

		let name = $('#item-name').val()
		let items = $('.items-item-all')
		if(name == '') {
			$('#item-name-error').html('Nama Tidak Boleh Kosong')
		}else{
			$('#item-name-error').html('')
			if($(items[0]).val() == '') {
				$('#items-item-error').html('Minimal Harus Ada Satu Item')
			}else{
				$('#items-item-error').html('')
				items.each((e,f)=>{
					json.push($(f).val())
				})
			}
			clearItem()
		}
		let data = {}
		data[name] = json
		data = JSON.stringify(data)
		customs[name] = json
		$('#custom-group').append(`<span class="badge badge-secondary ml-2"><b>${data}</b> <i class="fa fa-times ml-2" onclick="removeCustom(this, '${name}')"></i></span>`)
		$('#custom').val(JSON.stringify(customs))
	}

	function clearItem() {
		$('#customModal').modal('hide')
		$('#item-name').val('')
		$('.item-item-group').html(`<div class="d-flex"><input type="text" class="form-control flex-fill items-item-all" id="item-item" placeholder="Misal : Merah" name="item-item" required=""></div>`)
	}

	function removeCustom(e, name) {
		$(e.parentNode).remove()
		delete customs[name]
		$('#custom').val(JSON.stringify(customs))
	}
</script>
@endsection
