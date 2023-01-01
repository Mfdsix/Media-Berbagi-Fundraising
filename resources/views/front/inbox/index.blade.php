@extends('layouts.app')

@section('title', 'Inbox')
@section('css')
<style type="text/css">
	.img-round{
		width: 70px;
		height: 70px;
		border-radius: 50%;
	}
	.footer-menu{
		width: 100%;
		left: 0;
		transform: translateX(0);
	}
</style>
@endsection

@section('content')
@include('layouts.navbar')

<div class="main-width">
	<div class="body-section">

		<div class="mb-2 px-3">
			@if(count($datas) == 0)
			<div class="text-center p-4 bg-white radius-20">
				<div class="p-4">
					<img src="{{ asset('images/blank.png') }}" class="img-blank mb-2">
					<p class="fs-09 text-medium-grey">Belum Ada Inbox</p>
				</div>
			</div>
			@endif
			@foreach($datas as $k => $v)
			<div class="radius-20 bg-white p-4 mb-2">
				<div class="row">
					<div class="col-3">
						@if($v->project != null && $v->project->path_featured != null)
						<img src="{{ asset('storage/'.$v->project->path_featured) }}" class="img-round">
						@else
						<img src="{{ asset('images/project.png') }}" class="img-round">
						@endif
					</div>
					<div class="col-9">
						<span style="font-size: 12px">{{ $v->date }}</span>
						<p class="mb-0"><b>{{ $v->title }}</b></p>
						<p class="mb-1" style="font-size: 14px"><b>{{ $v->project->title }}</b></p>
						<div style="max-height: 50px; overflow: hidden;" class="text-secondary">{!! $v->content !!}</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>

	</div>
</div>

<nav class="footer-menu shadow">
	<ul class="footer-menu-ul main-width">
		<li>
			<a href="{{ url('') }}">
				<i class="fas fa-home"></i>
				<span>Beranda</span>
			</a>
		</li>
		<li>
			<a href="{{ url('donation') }}">
				<i class="fas fa-clipboard-list"></i>
				<span>Donasi Saya</span>
			</a>
		</li>
		<li class="active">
			<i class="fas fa-envelope"></i>
			<span>Inbox</span>
		</li>
		@if(auth()->check())
		<li>
			<a href="{{ url('account') }}">
				<i class="fas fa-user-circle"></i>
				<span>Akun</span>
			</a>
		</li>
		@else
		<li>
			<a href="{{ url('login') }}">
				<i class="fas fa-user-circle"></i>
				<span>Masuk</span>
			</a>
		</li>
		@endif
	</ul>
</nav>
@endsection

@section('js')
@endsection