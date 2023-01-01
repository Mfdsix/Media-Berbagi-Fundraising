<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./assets/css/variable.css">

<nav class="navbar fixed-top">
	<div class="main-width">
		<div class="flex max-width main-navbar">
			@if (isset($web_set->path_logo))
			<a href="{{ url('/') }}">
				<img src="{{ asset('storage/'.$web_set->path_logo) }}" class="desktop-logo">
				<img src="{{ asset('storage/'.$web_set->path_logo) }}" class="mobile-logo" style="width:160px">
			</a>
			@else
			<a href="{{ url('/') }}">
				<img src="{{ asset('images/logo.svg') }}" class="desktop-logo">
				<img src="{{ asset('images/logo.svg') }}" class="mobile-logo">
			</a>
			@endif
			
			
			<div class="search">
				<a href="{{ url('/search') }}">
					<img src="{{ asset('images/search.svg') }}">
				</a>
			</div>
		</div>
	</div>
</nav>