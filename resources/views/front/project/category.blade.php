@extends('layouts.app')

@section('title', $category->category)
@section('css')
	<!-- Required meta tags -->
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="../../assets/css/global.css">
	<link rel="stylesheet" href="../../assets/css/variable.css">
    <link rel="stylesheet" href="../../assets/css/detail.css">
	<link rel="stylesheet" href="../../assets/css/campaign.css">
    
    <title></title>

<style type="text/css">
	.portfolio-item:hover{
		background: #f7f7f7;
	}
	.navbar a, .navbar h6{
		color: var(--darkgrey);
	}
	.hadist{
		background: #fff;
        border: 1px solid #fff;
        box-sizing: border-box;
        border-radius: 15px;
        font-family: Inter;
        font-style: normal;
        font-weight: 300;
        font-size: 14px;
        line-height: 19px;
        color: #363636;
        text-align: center;
        padding: 10px 0;
        box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.15);
	}
	.title{
		font-family: Inter;
		font-style: normal;
		font-weight: 600;
		font-size: 16px;
		line-height: 19px;

		color: #363636;
	}
	.nominal{
		font-family: Inter;
		font-style: normal;
		font-weight: 600;
		font-size: 14px;
		line-height: 17px;
		/* identical to box height */

		letter-spacing: -0.015em;

		color: #363636;
	}
	.text-muted{
		font-family: Inter;
		font-style: normal;
		font-weight: normal;
		font-size: 12px;
		line-height: 15px;
		/* identical to box height */

		letter-spacing: -0.015em;

		color: #C7C7C7;
	}
	.hadist .text-left {
        font-family: Inter;
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        line-height: 150%;

        color: #363636;
    }
	a img{
		border-radius: 15px;
	}
</style>
@endsection

@section('content')
<div id="navbar-top">
    <div class="navbar-simple-wrapper">
        <button class="btn-transparent">
            <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                <img src="/../assets/img/icons/back-light.svg" alt="">
            </a>
        </button>
        <h4 class="navbar-wrapper-title">@yield ('title')</h4>
    </div>
</div>

<div class="screen">
    <div class="row">
		<div class="col-12">
        <div class="mt-0 main-width">

		<div class="bg-white radius-20 p-4 mb-2 mt-1">

			@if($category->risalah_status == '1')
			<div class="hadist container p-3">
				<div class="text-left">
					{!! $category->risalah !!}
				</div>
			</div>
			<hr class="mb-4 mt-4">
			@endif

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
								<h4 class="campaign-detail-value">Rp{{$v->donations}}</h4>
								<h4 class="campaign-detail-value">{{ $v->date_count }}</h4>
							</div>
						</div>
					</div>
				</a>
				@endforeach
			</div>

		</div>
	</div>
	</div>
</div>

<!--<nav class="footer-menu main-width bg-transparent text-center ">
	<a href="{{ url('categories') }}" class="btn btn-primary btn-rounded"><i class="fas fa-list"></i> Kategori</a>
</nav>-->
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="../../assets/js/global.js"></script>
@endsection