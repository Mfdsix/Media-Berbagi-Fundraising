@extends('layouts.app')

@section('title', 'Oops')
@section('css')
@endsection

@section('content')

<nav class="navbar bg-primary fixed-top">
	<div class="main-width">
		<div class="flex max-width main-navbar">
			<a href="{{ url('') }}">
			<img src="{{ asset('images/logo.png') }}" class="img-navbar">
			</a>
			<form class="search-navbar" method="get" action="{{ url('search') }}">
				<input name="q" placeholder="Cari yang ingin kamu bantu" required="">
				<i class="fas fa-search"></i>
			</form>
		</div>
	</div>
</nav>

<div class="main-width">
	<div class="body-section">
		<div class="bg-white rounded mb-2 text-center" style="padding: 100px 20px">
			<img src="{{ asset('images/blank.png') }}" class="img-blank mb-2">
			<h4 class="mb-0 mt-4"><b>{{ $title }}</b></h4>
			<p>{{ $desc }}</p>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection