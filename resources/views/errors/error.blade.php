@extends('layouts.app')

@section('title', 'Error')
@section('css')
@endsection

@section('content')
@include('layouts.navabr')

<div class="main-width">
	<div class="body-section">
		<div class="bg-white rounded mb-2 text-center" style="padding: 100px 20px">
			<h3 style="font-size: 78px">Oops</h3>
			<h4 class="mb-0 mt-4"><b>Error Saat Pembayaran</b></h4>
			<p>{{ $error }}</p>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
</script>
@endsection