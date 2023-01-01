@extends('layouts.mb-app')

@section('title', 'Home')
@section('css')

	<!-- Styles -->	
	<link rel="stylesheet" href="./assets/css/campaign.css">

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

	<style>
		/* body{margin:auto !important} */
	h5 {
		font-family: Inter;
		font-style: normal;
		font-weight: bold;
		font-size: 18px;
		line-height: 22px;
		/* identical to box height */

		color: #363636;
		}
	form{
		max-width: 311px;
		width: 311px;
		height: 45px;
		left: 79px;
		top: 45px;

		background: #FFFFFF;
		border-radius: 10px;
	}
	input{
		width: 220px;
		height: 19px;
	
		font-family: Inter;
		font-style: normal;
		font-weight: normal;
		font-size: 16px;
		line-height: 19px;
		opacity: 50%;

		margin-top: 4%;

		color: #C7C7C7;
	}
	.search-navbar{
		width: 100%;
	}
	.img-fluid{
		width: 161px;
		height: 110px;
		border-radius: 15px;
	}
	.main-content{
		min-height:100vh;
	}
	#nav-top-secondary input{
		border: none;
	}
	</style>
@endsection

@section('content')
<nav id="nav-top-secondary">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-2">
                <a href="javascript:void(0)" onclick="history.back()">
                    <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23 9.00024H3.0505L10.6895 1.72424C11.0895 1.34324 11.105 0.710244 10.724 0.310244C10.3435 -0.0892562 9.7105 -0.105256 9.31 0.275744L0.586 8.58574C0.2085 8.96374 0 9.46574 0 10.0002C0 10.5342 0.2085 11.0367 0.6035 11.4312L9.3105 19.7242C9.504 19.9087 9.752 20.0002 10 20.0002C10.264 20.0002 10.528 19.8962 10.7245 19.6897C11.1055 19.2897 11.09 18.6572 10.69 18.2762L3.019 11.0002H23C23.552 11.0002 24 10.5522 24 10.0002C24 9.44824 23.552 9.00024 23 9.00024V9.00024Z" fill="white"/>
                    </svg>
                </a>
            </div>
            <div class="col-8">
				<form class="search-navbar ml-4" method="get" action="{{ url('search') }}">
					<input class="search ml-2" name="q" placeholder="Cari Donasi" required="" value="{{ request()->get('q') }}">
				</form>
            </div>
        </div>
    </div>
</nav>

<main class="bg-white padding-b-75px main-content">
	<div class="container-fluid">
		<br>
		@if(count($datas) == 0)
			{{--<h5 class="text-dark-grey mb-4 text-center">Hasil Pencarian untuk <b>{{ request()->get('q') }}</b></h5>--}}

			<div class="category-tab" id="project-list">
				
				<div class="text-center p-4">
					<img src="{{ asset('images/Magnifier.svg') }}" class="mb-2">
					<p class="text-icon">Yuk coba kolom pencarian diatas !</p>
				</div>
				@else
				{{--<h5 class="text-dark-grey mb-4 border-bottom">Terakhir dilihat</h5>--}}

				<h5 class="text-dark-grey mb-4">Rekomendasi untuk kamu</h5>
				
				<div class="category-tab" id="project-list">
					@foreach($datas as $k => $v)
					<a href="{{ url($v->slug) }}" class="campaign-card">
						@if($v->path_featured == null)
							<img class="img-fluid" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
						@else
							<img class="img-fluid" src="{{ asset('storage/'.$v->path_featured) }}" alt="Card image cap">
						@endif

						<div class="campaign-wrapper">
							<h4 class="campaign-title">{{ $v->title }}</h4>

							<div class="campaign-detail">
								<div class="progress">
									<div class="progress-bar bg-success" style="width: {{ $v->percentage }}%" role="progressbar" style="{{ $v->percentage }}" aria-valuenow="{{ $v->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
								</div>

								<div class="campaign-detail-group">
									<h4 class="campaign-detail-label">Terkumpul</h4>
									<h4 class="campaign-detail-label">Sisa hari</h4>
								</div>
								<div class="campaign-detail-group">
									<h4 class="campaign-detail-value">{{$v->donations}}</h4>
									<h4 class="campaign-detail-value">{{ $v->date_count }}</h4>
								</div>
							</div>
						</div>
					</a>
					@endforeach
				</div>

			</div>
			
		@endif
	</div>
</main>

@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./assets/js/global.js"></script>
@endsection