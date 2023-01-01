@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<h4>{{ $title }}</h4>

				@if(isset($data))
				<ul class="nav nav-tabs customtab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" role="tab">
							<span class="hidden-sm-up">
								<i class="ti-home"></i>
							</span>
							<span class="hidden-xs-down">Produk</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin/store/product/'.$data->id.'/photos') }}">
							<span class="hidden-sm-up">
								<i class="ti-user"></i>
							</span>
							<span class="hidden-xs-down">Foto</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin/store/product/'.$data->id.'/fields') }}">
							<span class="hidden-sm-up">
								<i class="ti-email"></i>
							</span>
							<span class="hidden-xs-down">Detail</span>
						</a>
					</li>
				</ul>
				@endif

				<form method="post" action="{{ isset($data) ? url('admin/store/product/'.$data->id) : url('admin/store/product') }}" class="mt-3" enctype="multipart/form-data">
					@csrf
					@if(isset($data))
					<input type="hidden" name="_method" value="PUT">
					@endif

					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" name="title" class="form-control" required="" value="{{ isset($data) ? $data->title : old('title') }}">
						@error('title')
						<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Deskripsi Produk</label>
						<textarea class="form-control" name="description" required="">{{ isset($data) ? $data->description : old('description') }}</textarea>
					</div>

					<div class="form-group">
						<label>Stock Tersedia</label>
						<div class="input-group">
							<input type="number" name="stock" class="rupiah form-control" value="{{ isset($data) ? $data->stock : old('stock') }}" id="stock" min="0" required="">
							<div class="input-group-prepend">
								<span class="input-group-text">Pieces</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Harga</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Rp</span>
							</div>
							<input type="text" name="price" class="rupiah form-control" value="{{ isset($data) ? $data->price : old('price') }}" id="price">
						</div>
					</div>

					<div class="form-group">
						<label>Berat Produk</label>
						<div class="input-group">
							<input type="number" name="weight" class="rupiah form-control" value="{{ isset($data) ? $data->weight : old('weight') }}" id="weight" min="0">
							<div class="input-group-prepend">
								<span class="input-group-text">Gram</span>
							</div>
						</div>
					</div>
					<span class="text-warning">* sebaiknya dilengkapi supaya penghitungan biaya ongkir lebih akurat</span>

					<hr>
					<button class="btn btn-primary">Simpan</button>
					<a href="{{ url('admin/store/product') }}" class="btn btn-warning">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('js')
@endpush