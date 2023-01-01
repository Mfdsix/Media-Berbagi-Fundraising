@extends('layouts.mb-app')

@section('title', 'Program Donasi')

@section('content')
<link rel="stylesheet" href="{{ url('assets/css/campaign.css') }}">
@include('layouts.mb-nav-top-secondary', ['title' => 'Program Favorit'])

<div class="screen">
    <div class="row">
        <div class="col-12">
            <div class="bg-white radius-20 p-4 mb-2 min-vh-100">

                @if (Session::has('success'))
                <div class="alert alert-success col-12" role="alert">
                    {{Session::get('success')}}
                </div> 
                @endif
                @if (Session::has('error'))
                <div class="alert alert-warning col-12" role="alert">
                    {{Session::get('error')}}
                </div> 
                @endif

				@if(count($project) == 0)
					<div class="text-center p-4">
						<img src="{{ asset('images/love.svg') }}" loading="lazy" class="mb-2">
						<p class="text-icon">Belum Ada Program Favorit !</p>
					</div>
				@endif

            	<div class="category-tab" id="project-list">
				@foreach($project as $k => $v)
					
					<div class="mb-1 ">
						<a href="{{ url($v->detail->slug) }}" class="campaign-card">
							@if($v->detail->path_featured == null)
								<img class="img-fluid rounded" src="{{ asset('images/project.jpg') }}" alt="Card image cap">
							@else
								{{--<a href="/program/favourite/delete/{{$v->id}}" style="z-index:1; position: absolute;"><i class="fas fa-trash"></i></a>--}}
								<img class="img-fluid rounded" src="{{ asset('storage/'.$v->detail->path_featured) }}" alt="Card image cap">
							@endif
							
							<div class="campaign-wrapper">
								<h4 class="campaign-title">{{ $v->detail->title }}</h4>
		
								<div class="campaign-detail">
									<div class="progress">
										<div class="progress-bar bg-success" role="progressbar" style="{{$v->detail->percentage}}" aria-valuenow="{{ $v->detail->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
		
									<div class="campaign-detail-group">
										<h4 class="campaign-detail-label">Terkumpul</h4>
										<h4 class="campaign-detail-label">Sisa hari</h4>
									</div>
									<div class="campaign-detail-group">
										
										<h4 class="campaign-detail-value">Rp{{ number_format($v->donations, 0, ',', '.') }}</h4>
										<h4 class="campaign-detail-value">{{ $v->detail->date_count }}</h4>
									</div>
								</div>
							</div>
						</a>
					</div>
					{{--<div class="col-12">
                        <a href="/program/favourite/delete/{{$v->id}}" style="float: right"><i class="fas fa-trash"></i></a>
                    </div>--}}
				@endforeach

            </div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="../../assets/js/global.js"></script>
@endsection
