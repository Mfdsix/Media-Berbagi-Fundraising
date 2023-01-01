@extends('layouts.dashboard')
@section('title', 'Urutkan Program')

@section('header', 'Urutkan Program')

@section('css')
<style type="text/css">
	#sortable{
		list-style: none;
		padding-left: 0px;
	}
	#sortable li{
		border: 1px solid #eee;
		border-radius: 5px;
	}
	#sortable li:hover{
		cursor: grab;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-6 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Urutkan Projek</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">custom urutan projek untuk ditampilkan</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt--2">
	<div class="col-md-12 mb-3">
		<div class="box">
			<div class="box-body">
				<p class="text-warning">* drag drop untuk memindahkan item</p>
				<form method="post">
					@csrf
					<ul id="sortable">
						@foreach($datas as $k => $v)
						<li class="ui-state-default p-4 mb-2">
							<div class="row">
								<div class="col mb-0">
									@if($v->path_featured == null)
									<img style="border-radius: 6px" src="{{ asset('images/project.jpg') }}" height="50">
									@else
									<img style="border-radius: 6px" src="{{ asset('storage/'.$v->path_featured) }}" height="50">
									@endif
								</div>
								<div class="col-md-10 mb-0">
									<input type="hidden" name="order[{{ $k+1 }}]" value="{{ $v->id }}">
									<p class="card-category text-info mb-0">{{ $v->category == null ? 'Tidak Berkateogri' : $v->category->category }}</p>
									<h3 class="card-title">{{ $v->title }}</h3>
								</div>
							</div>
						</li>
						@endforeach
					</ul>
					<div class="gr-btn text-end">
						<button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('js')
<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sortable").sortable();
		$("#sortable").disableSelection();
	})
</script>
@endsection
