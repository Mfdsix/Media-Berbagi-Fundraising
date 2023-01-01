@extends('layouts.app')

@section('title', '404')
@section('css')
@endsection

@section('content')

@include('layouts.navbar')

<div class="main-width">
	<div class="body-section">
		<div class="bg-white rounded mb-2 text-center" style="padding: 100px 20px">
			<h3 style="font-size: 82px;">404</h3>
			<h4 class="mb-0 mt-4"><b>Halaman Tidak Ditemukan</b></h4>
			<p class="text-secondary">maaf ya, halaman yang kamu cari tidak ada</p>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection