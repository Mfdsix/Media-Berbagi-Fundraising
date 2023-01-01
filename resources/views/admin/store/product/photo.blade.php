@extends('layouts.dashboard')

@section('css')
<style type="text/css">
	.img-preview{
		width: 100%;
		height: 200px;
		border-radius: 5px;
		background: #eee;
		position: relative;
	}
	.img-delete{
		position: absolute;
		right: 0;
		top: 0;
	}
	.img-text{
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		text-align: center;
	}
	.img-icon{
		font-size: 25px;
		display: block;
	}
	.can-upload:hover{
		cursor: pointer;
	}
	.img-add{
		width: 100%;
		height: 200px;
		border-radius: 5px;
		position: relative;
		border: 3px dashed #eee;	
	}
	.img-result{
		width: 100%;
		height: 200px;
		object-fit: cover;
	}
</style>
@endsection

@section('content')
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
				<a class="nav-link active">
					<span class="hidden-sm-up">
						<i class="ti-user"></i>
					</span>
					<span class="hidden-xs-down">Foto</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/store/product/'.$product->id.'/fields') }}">
					<span class="hidden-sm-up">
						<i class="ti-email"></i>
					</span>
					<span class="hidden-xs-down">Detail</span>
				</a>
			</li>
		</ul>

		<div class="mt-3">
			<div class="row" id="img-wrapper">
				@foreach($datas as $k => $v)
				<div class="col-md-3 mb-3">
					<div class="img-preview">
						<button data-id="{{ $v->id }}" class="img-delete btn-sm btn btn-danger">
							<i class="fa fa-times"></i>
						</button>
						<div class="img-text">
							<img data-src="{{ asset('storage/'.$v->path) }}" src="{{ asset('storage/'.$v->path) }}" class="lazy-img img-result">
						</div>
					</div>
				</div>
				@endforeach
				<div class="col-md-3 mb-3" id="img-add-wrapper">
					<div class="img-add">
						<div class="img-text">
							<i class="fa fa-plus img-icon"></i>
							<span>tambah file</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<a href="{{ url('/admin/store/product') }}" class="btn btn-warning">Kembali</a>
	</div>
</div>

<input type="file" id="img-uploader" style="display: none;" onchange="uploadImage(event)">
@endsection

@section('js')
<script type="text/javascript">
	var count = 1;
	var target = null;

	$(document).ready(function(){
		$("#img-add-wrapper").on("click", function(){
			addBlock();
		});
		$(document).on("click", ".img-delete", function(){
			let elem = $(this);
			let id = $(this).data("id");

			if(id){
				$(".preloader").css('display', 'block');
				$.ajax({
					url: '{{ url("admin/store/product/photos/") }}' + "/" + id,
					data: {
						_token: '{{ csrf_token() }}'
					},
					method: 'DELETE',
					success: function(d){
						elem.parent().parent().remove();
						$(".preloader").css('display', 'none');
					},
					error: function(e){
						console.log(e);
						$(".preloader").css('display', 'none');
					}
				})
			}else{
				elem.parent().parent().remove();
			}
		})
		$(document).on("click", ".img-trigger", function(){
			if($(this).attr('uploaded') != 1){
				let tgt = $(this).data('target');
				target = tgt;
				$("#img-uploader").click();
			}
		})
	})

	function addBlock(){
		$("#img-add-wrapper").before('<div class="col-md-3 mb-3"><div class="img-preview" data-target="file'+count+'"><button data-target="file'+count+'" class="img-delete btn-sm btn btn-danger"><i class="fa fa-times"></i></button><div class="img-text img-trigger" data-target="file'+count+'"><i class="fa fa-upload img-icon"></i><span>klik untuk upload</span></div></div><input type="file" name="photos['+count+']" style="display: none;" id="file'+count+'" class="img-change"></div>');
		count++;
	}
	function uploadImage(input){
		let id = target;

		let formData = new FormData();
		formData.append("_token", '{{ csrf_token() }}');
		formData.append("photo", input.target.files[0]);

		$(".preloader").css('display', 'block');

		$.ajax({
			url: '{{ url("/admin/store/product/".$product->id."/photos") }}',
			data: formData,
			method: 'POST',
			contentType: false,
			processData: false,
			success: function(d){
				$(".preloader").css('display', 'none');
				if(d.success){
					var reader = new FileReader();
					reader.onload = function(){
						$(".img-trigger[data-target='"+id+"']").attr('uploaded', 1);
						$(".img-text[data-target='"+id+"']").html("<img class='img-result' src='"+reader.result+"'/>");
						$(".img-delete[data-target='"+id+"']").attr('data-id', d.data);
					};
					reader.readAsDataURL(input.target.files[0]);
				}else{
					console.log(d.message);
				}
			},
			error: function(e){
				console.log(e);
				$(".preloader").css('display', 'none');
			}
		})
	}
</script>
@endsection