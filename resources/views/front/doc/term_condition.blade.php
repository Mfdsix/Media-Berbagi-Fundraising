@extends('layouts.mb-app')

@section('title', 'Syarat & Ketentuan')

@section('content')
@include('layouts.mb-nav-top-secondary', ['title' => 'Syarat & Ketentuan'])
<section id="page-category-menu" class="bg-white" style="min-height: 100vh;">
    <div class="container-fluid">
        <div>{!! $data ?? '<i>Konten Belum Tersedia</i>' !!}</div>
    </div>
</section>
@endsection
