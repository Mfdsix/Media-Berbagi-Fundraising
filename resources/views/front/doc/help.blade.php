@extends('layouts.mb-app')

@section('title', 'Bantuan')

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Bantuan'])
<section id="page-category-menu" class="bg-white" style="min-height: 100vh;">
	<div class="container-fluid">
        <div>{!! $data ?? '<i>Konten Belum Tersedia</i>' !!}</div>
    </div>
</section>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./assets/js/global.js"></script>
@endsection
