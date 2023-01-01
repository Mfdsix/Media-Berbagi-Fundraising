@extends('layouts.dashboard')

@section('content')
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<h4>{{ $title }}</h4>

				<ul class="nav nav-tabs customtab" role="tablist">
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin/store/product/'.$product->id.'/edit') }}">
							<span class="hidden-sm-up">
								<i class="ti-home"></i>
							</span>
							<span class="hidden-xs-down">Produk</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ url('admin/store/product/'.$product->id.'/photos') }}">
							<span class="hidden-sm-up">
								<i class="ti-user"></i>
							</span>
							<span class="hidden-xs-down">Foto</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active">
							<span class="hidden-sm-up">
								<i class="ti-email"></i>
							</span>
							<span class="hidden-xs-down">Detail</span>
						</a>
					</li>
				</ul>
				
				<form action="{{ url()->current() }}" method="post" class="mt-4">
					@csrf
					<div id="field-wrap">
						@foreach($datas as $k => $v)
						<div class="form-group" id="field{{$k}}">
							<div class="row">
								<div class="col-md-4">
									<input type="text" name="variants[{{$k}}][field]" class="form-control" placeholder="Judul" value="{{ $v->field }}">
								</div>
								<div class="col-md-7">
									<textarea class="form-control" name="variants[{{$k}}][value]" placeholder="Isian">{{ $v->value }}</textarea>
								</div>
								<div class="col-md-1 text-right">
									<button type="button" class="btn btn-danger btn-delete" data-target="field{{$k}}">
										<i class="fa fa-times"></i>
									</button>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<hr>
					<button type="button" id="btn-add" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Tambah Detail</button>
					<hr>

					<div>
						<button class="btn btn-primary">Simpan</button>
						<a href="{{ url('/admin/store/product') }}" class="btn btn-warning">Kembali</a>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	var variants = {{ count($datas) }};

	$(document).ready(function(){
		$("#btn-add").on("click", function(){
			variants++;

			$("#field-wrap").append('<div class="form-group" id="field'+variants+'"><div class="row"><div class="col-md-4"><input type="text" name="variants['+variants+'][field]" class="form-control" placeholder="Judul"></div><div class="col-md-7"><textarea class="form-control" name="variants['+variants+'][value]" placeholder="Isian"></textarea></div><div class="col-md-1 text-right"><button type="button" class="btn btn-danger btn-delete" data-target="field'+variants+'"><i class="fa fa-times"></i></button></div></div></div>');
		});

		$(document).on("click", ".btn-delete", function(){
			let target = $(this).data("target");
			$("#"+target).remove();
		});
	})
</script>
@endsection