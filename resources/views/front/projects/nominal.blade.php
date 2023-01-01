@extends('layouts.mb-app')

@section('title', 'Pembayaran')
@section('css')
<style>
    .position-center{
		z-index: 120;
		position:fixed;
		top:50%;
		left:50%;
		transform:translate(-50%, -50%);
		width:100%;
		height:100vh;
		background-color:rgba(0,0,0,0.5);
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.text-theme{
		color:var(--primary-color);
	}
</style>
@endsection

@section('content')
<div class="position-center d-none" id="loading">
	{{-- loading spinner --}}
	<div class="spinner-border text-theme" role="status">
		<span class="sr-only">Loading...</span>
	</div>
</div>

    <!-- NAV TOP -->
    <nav id="nav-top-secondary">
        <div class="container h-100">
            <div class="row h-100 d-flex align-items-center">
                <div class="col-2">
                    <a href="javascript:void(0)" onclick="goBack()">
                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M23 9.00024H3.0505L10.6895 1.72424C11.0895 1.34324 11.105 0.710244 10.724 0.310244C10.3435 -0.0892562 9.7105 -0.105256 9.31 0.275744L0.586 8.58574C0.2085 8.96374 0 9.46574 0 10.0002C0 10.5342 0.2085 11.0367 0.6035 11.4312L9.3105 19.7242C9.504 19.9087 9.752 20.0002 10 20.0002C10.264 20.0002 10.528 19.8962 10.7245 19.6897C11.1055 19.2897 11.09 18.6572 10.69 18.2762L3.019 11.0002H23C23.552 11.0002 24 10.5522 24 10.0002C24 9.44824 23.552 9.00024 23 9.00024V9.00024Z" fill="white"/>
                        </svg>
                    </a>
                </div>
                <div class="col-8">
                    <h1 class="nav-top-secondary__title">Pembayaran</h1>
                </div>
            </div>
        </div>
    </nav>
    <!-- HEADER -->
    <section id="page-pembayaran-donasi-section" class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 margin-b-16px">
                    <h2 class="main-section-text-16">Program yang dipilih</h2>
                </div>
                <div class="col-12">
                    <div class="page-pembayaran-donasi-section__box margin-b-16px">
                        @if($project->path_featured)
                        <img class="page-pembayaran-donasi-section__box__image" src="{{ asset('/storage/'.$project->path_featured) }}" alt="Image Box">
                        @else
                        <img class="page-pembayaran-donasi-section__box__image" src="https://images.unsplash.com/photo-1593642634367-d91a135587b5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80" alt="Image Box">
                        @endif
                        <h2 class="main-section-title-primary">{{ $project->title }}</h2>
                        @if($project->category != null)
                        <p class="page-pembayaran-donasi-section__box__author">{{ $project->category->category }}</p>
                        @endif
                        <div class="page-pembayaran-donasi-section__box__cover__progress">
                            {{-- PROGRESS BAR --}}
                            <span class="page-pembayaran-donasi-section__box__progress" style="width: 30%;"></span>
                        </div>
                    </div>
                    <div class="line-1px margin-b-16px"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- MAIN -->
    <main id="page-pembayaran-donasi-main" class="bg-white padding-b-50px">
        <form method="post" id="form-nominal" action="{{ url()->current() }}" class="container">
            @csrf
            <div class="row margin-b-16px">
                @if($project->type == "registration")
                <div class="col-12">
                    <h3 class="main-section-text-16">Biaya Pendaftaran</h3>
                </div>
                @else
                <div class="col-12">
                    <h3 class="main-section-text-16">Pilih nominal donasi</h3>
                </div>
                @endif
            </div>
            <div class="row margin-b-16px">
                @if($project->type == "wakaf")

                    <div class="col-12 margin-b-16px d-flex">
                        <input type="hidden" value="{{ $nominal }}" name="nominal" id="nominal_input">
                        <div class="w-full py-3 px-4 rounded bg-light flex-fill border" id="nominal_input_wakaf">{{ $nominal }}</div>
                        <a href="javascript:void(0)" class="btn btn-light ml-4 px-4 btn-lg border" onclick="AddWakaf()">+</a>
                        <a href="javascript:void(0)" class="btn btn-light ml-4 px-4 btn-lg border" onclick="DeleteWakaf()">-</a>
                    </div>

                @else

                @if($strict == false)

                @if($project->type != 'registration')
                    @if ($project->custom_nominal != null)
                    <div id="page-pembayaran-donasi-main-id-pilih-nominal" class="col-12 margin-b-14px">
                        <button type="button" data-nominal="{{json_decode($project->custom_nominal)[0]}}" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp{{number_format(json_decode($project->custom_nominal)[0])}}</button>
                        <button type="button" data-nominal="{{json_decode($project->custom_nominal)[1]}}" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp{{number_format(json_decode($project->custom_nominal)[1])}}</button>
                        <button type="button" data-nominal="{{json_decode($project->custom_nominal)[2]}}" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp{{number_format(json_decode($project->custom_nominal)[2])}}</button>
                        <button type="button" data-nominal="{{json_decode($project->custom_nominal)[3]}}" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp{{number_format(json_decode($project->custom_nominal)[3])}}</button>
                    </div>
                    @else
                    <div id="page-pembayaran-donasi-main-id-pilih-nominal" class="col-12 margin-b-14px">
                        <button type="button" data-nominal="50000" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp50,000</button>
                        <button type="button" data-nominal="100000" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp100,000</button>
                        <button type="button" data-nominal="150000" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp150,000</button>
                        <button type="button" data-nominal="200000" class="page-pembayaran-donasi-main__pilih__nominal__donasi">
                            <svg class="mr-2" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C6.477 22 2 17.523 2 12C2 6.477 6.477 2 12 2ZM12 3.5C9.74566 3.5 7.58365 4.39553 5.98959 5.98959C4.39553 7.58365 3.5 9.74566 3.5 12C3.5 14.2543 4.39553 16.4163 5.98959 18.0104C7.58365 19.6045 9.74566 20.5 12 20.5C14.2543 20.5 16.4163 19.6045 18.0104 18.0104C19.6045 16.4163 20.5 14.2543 20.5 12C20.5 9.74566 19.6045 7.58365 18.0104 5.98959C16.4163 4.39553 14.2543 3.5 12 3.5ZM12 7C12.1989 7 12.3897 7.07902 12.5303 7.21967C12.671 7.36032 12.75 7.55109 12.75 7.75V11.25H16.25C16.4489 11.25 16.6397 11.329 16.7803 11.4697C16.921 11.6103 17 11.8011 17 12C17 12.1989 16.921 12.3897 16.7803 12.5303C16.6397 12.671 16.4489 12.75 16.25 12.75H12.75V16.25C12.75 16.4489 12.671 16.6397 12.5303 16.7803C12.3897 16.921 12.1989 17 12 17C11.8011 17 11.6103 16.921 11.4697 16.7803C11.329 16.6397 11.25 16.4489 11.25 16.25V12.75H7.75C7.55109 12.75 7.36032 12.671 7.21967 12.5303C7.07902 12.3897 7 12.1989 7 12C7 11.8011 7.07902 11.6103 7.21967 11.4697C7.36032 11.329 7.55109 11.25 7.75 11.25H11.25V7.75C11.25 7.55109 11.329 7.36032 11.4697 7.21967C11.6103 7.07902 11.8011 7 12 7Z" fill="currentcolor"/>
                            </svg>
                            Rp200,000</button>
                    </div>
                    @endif
                @endif

                @endif

                @if($project->type == "registration")
                <div class="col-12 margin-b-16px">
                    <input type="hidden" name="nominal" id="nominal_value" value="200000">
                    <input type="text" id="nominal_donasi" class="page-pembayaran-donasi-main__input__nominal__donasi" value="Rp 200.000" readonly>
                </div>
                @else
                <div class="col-12 margin-b-16px">
                    <input type="hidden" name="nominal" id="nominal_value" value="{{ str_replace("Rp ","",str_replace(".","",$default)) ?? old('nominal') }}">
                    <input type="text" id="nominal_donasi" class="page-pembayaran-donasi-main__input__nominal__donasi" placeholder="Masukan nominal donasi" value="{{ $default }}">
                    @error('nominal')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                @endif

                @endif
                <div class="line-1px"></div>
            </div>
            <div class="row">
                <div class="col-12 margin-b-16px">
                    <h3 class="main-section-text-16">Metode pembayaran</h3>
                </div>
                <div class="col-12">
                    <div class="margin-b-16px">
                        <button type="button" class="page-pembayaran-donasi-main__pilih__pembayaran"><span id="selected-payment-method">Pilih metode pembayaran</span>
                            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.94824 17.2812L13.7191 12.5L8.94824 7.71875L10.417 6.25L16.667 12.5L10.417 18.75L8.94824 17.2812Z" fill="#363636"/>
                            </svg>
                        </button>
                    </div>
                    <div class="line-1px margin-b-16px"></div>
                    <input type="hidden" name="payment_method" id="payment_method">
                    @if (!auth::user())
                    <h4 class="main-section-text-14 margin-b-14px text-center"><a href="/login" class="color-green-1">Masuk</a> atau lengkapi data dibawah</h4>
                    @endif
                    <div class="margin-b-14px">
                        <input name="donature_name" class="input-default-form-50px" type="text" placeholder="Nama Lengkap" value="{{ $donature_name == null ? old('donature_name') : $donature_name }}">
                        @error('donature_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="margin-b-14px">
                        <input name="donature_phone" class="input-default-form-50px" type="text" placeholder="Nomor Handphone" value="{{ $donature_phone == null ? old('donature_phone') : $donature_phone }}">
                        @error('donature_phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="margin-b-14px">
                    <input name="donature_email" class="input-default-form-50px" type="email" placeholder="Email" value="{{ $donature_email == null ? old('donature_email') : $donature_email }}">
                    @error('donature_email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    @if($project->type == 'registration')
                    <div class="margin-b-14px">
                        <input name="usia" class="input-default-form-50px" type="text" placeholder="Usia" value="{{ old('usia') }}">
                        @error('usia')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="margin-b-14px">
                        <input name="kota" class="input-default-form-50px" placeholder="Kota / Kecamatan" value="{{ old('kota') }}">
                        @error('kota')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="margin-b-14px">
                        <select name="jeniskelamin" class="input-default-form-50px">
                            <option value="">-- Pilih jenis kelamin --</option>
                            <option>Ikhwan</option>
                            <option>Akhwat</option>
                        </select>
                        @error('jeniskelamin')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="margin-b-14px">
                        <select name="typeprogram" class="input-default-form-50px">
                            <option value="">-- pilih program --</option>
                            <option>Beasiswa</option>
                            <option>Regular</option>
                        </select>
                        @error('typeprogram')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    @if($project->type != 'registration')
                    <div class="d-flex align-items-center margin-b-16px">
                        <div class="w-75">
                            <p class="main-section-text-14">Sembunyikan nama saya (Hamba Allah)</p>
                        </div>
                        <div class="w-25">
                            <label class="form-slider">
                                <input type="checkbox" name="is_anonymous" value="1">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="d-flex align-items-center margin-b-25px">
                        <div class="w-75">
                            <p class="main-section-text-14">Tulis do’a dan dukungan</p>
                        </div>
                        <div class="w-25">
                            <label class="form-slider">
                                <input type="checkbox" checked name="doa" value="1" id="form-slide-doa" data-toggle="true">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    <div class="margin-b-32px">
                        <textarea class="input-default-form-50px-textarea" name="special_message" rows="5" placeholder="Tulis doa untuk penggalang dana dirimu sendiri disini. Biar doa kamu bisa dilihat dan diamini oleh #SabahatKebaikan lainnya"></textarea>
                    </div>
                    @endif
                    <div class="line-1px margin-b-54px"></div>
                    <div>
                        <button type="submit" class="button-fundraiser-submit" onclick="openLoading()">{{$project->button_label}}</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <!-- PILIH METODE PEMBAYARAN -->
    <aside id="pilih-metode-pembayaran">
        <div class="container-full">
            <div class="row">
                <div class="col-12 d-flex align-items-center py-3 padding-l-24px">
                    <div class="mr-2">
                        <button type="button" class="pilih-metode-pembayaran-close">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                    <div>
                        <h3 class="pilih-metode-pembayaran__title">Pilih Metode Pembayaran</h3>
                    </div>
                </div>
            </div>
            <!-- BANK -->
		@if(isset($payments['bk']) && count($payments['bk']) > 0)
		<div class="pilih-metode-pembayaran__line">
			<h6 class="pilih-metode-pembayaran__subtitle">Bank Transfer (Verifikasi Manual)</h6>
		</div>
		<div class="row padding-x-15px">
			<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
				@foreach($payments['bk'] as $k => $v)
				<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('bank-'+ '{{$v->id}}' + '-{{ $v->bank_name }}')">
					<img class="pilih-metode-pembayaran__image" src="{{ asset('storage/'.$v->path_icon) }}" alt="{{ $v->bank_name }}">
				</a>
				@endforeach
			</div>
		</div>
		@endif
            <!-- E-MONEY -->
		@if(isset($payments['ewallet']) && count($payments['ewallet']) > 0)
		<div class="pilih-metode-pembayaran__line">
			<h6 class="pilih-metode-pembayaran__subtitle">E-Wallet</h6>
		</div>
		<div class="row padding-x-15px">
			<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
				@foreach($payments['ewallet'] as $k => $v)
				<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('ewallet-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
					<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
				</a>
				@endforeach
			</div>
		</div>
		@endif
		<!-- VA -->
		@if(isset($payments['va']) && count($payments['va']) > 0)
		<div class="pilih-metode-pembayaran__line">
			<h6 class="pilih-metode-pembayaran__subtitle">Virtual Account (Verifikasi Otomatis)</h6>
		</div>
		<div class="row padding-x-15px">
			<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
				@foreach($payments['va'] as $k => $v)
				<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('virtualaccount-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
					<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
				</a>
				@endforeach
			</div>
		</div>
		@endif
		<!-- IB -->
		@if(isset($payments['ibank']) && count($payments['ibank']) > 0)
		<div class="pilih-metode-pembayaran__line">
			<h6 class="pilih-metode-pembayaran__subtitle">Internet Banking</h6>
		</div>
		<div class="row padding-x-15px">
			<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
				@foreach($payments['ibank'] as $k => $v)
				<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('ibanking-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
					<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
				</a>
				@endforeach
			</div>
		</div>
		@endif
		<!-- QR -->
		@if(isset($payments['qris']) && count($payments['qris']) > 0)
		<div class="pilih-metode-pembayaran__line">
			<h6 class="pilih-metode-pembayaran__subtitle">QRIS</h6>
		</div>
		<div class="row padding-x-15px">
			<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
				@foreach($payments['qris'] as $k => $v)
				<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('ibanking-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
					<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
				</a>
				@endforeach
			</div>
		</div>
		@endif
		<!-- STORE -->
		@if(isset($payments['store']) && count($payments['store']) > 0)
		<div class="pilih-metode-pembayaran__line">
			<h6 class="pilih-metode-pembayaran__subtitle">Convenience Store</h6>
		</div>
		<div class="row padding-x-15px">
			<div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
				@foreach($payments['store'] as $k => $v)
				<a class="pilih-metode-pembayaran__payment" href="javascript:void(0)" onclick="processPayment('store-'+ '{{$v['code']}}' + '-{{ $v['title'] }}')">
					<img class="pilih-metode-pembayaran__image" src="{{ $v['icon'] }}" alt="{{ $v['title'] }}">
				</a>
				@endforeach
			</div>
		</div>
		@endif
        {{-- <!-- CC -->
        <div class="pilih-metode-pembayaran__line">
            <h6 class="pilih-metode-pembayaran__subtitle">Credit Card</h6>
        </div>
        <div class="row padding-x-15px">
            <div class="pilih-metode-pembayaran__row col-12 pt-3 pb-2 padding-l-33px">
                <button disabled type="button" class="pilih-metode-pembayaran__payment">
                    <img class="pilih-metode-pembayaran__image" src="{{ asset('assets/media-berbagi/assets/images/website/payment-mastercard.svg') }}" alt="mandiri">
                </button>
                <button disabled type="button" class="pilih-metode-pembayaran__payment">
                    <img class="pilih-metode-pembayaran__image" src="{{ asset('assets/media-berbagi/assets/images/website/payment-visa.svg') }}" alt="mandiri">
                </button>
            </div>
        </div> --}}

        </div>
    </aside>
@endsection

@section('js')
@if($web_set->facebook_pixel != null)
<!-- Facebook Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '{{ $web_set->facebook_pixel }}');
	fbq('track', 'AddToChart');
</script>
<noscript><img loading="lazy" height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $web_set->facebook_pixel }}&ev=AddToChart&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
@endif
<!-- GLOBAL JS -->
<script src="../../assets/js/global.js"></script>
<!-- PEMBAYARAN DONASI JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
<script>
    function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString().replace(/^0+/, ''),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
</script>
@if($type != "wakaf")
<script>
	var input = $('#nominal_donasi')[0];
	input.addEventListener('keyup', function(e)
	{
		input.value = formatRupiah(this.value, 'Rp. ');
		$("#nominal_value").val(input.value.replace('Rp. ', '').replace(/\./g, ''));
	});
</script>
@endif
<script src="{{ asset('assets/media-berbagi/styles/js/pembayaran-donasi.js') }}"></script>
<script>
    $('#form-slide-doa').click(function() {
        let getDoaToggle = $(this).data('toggle');
        console.log(getDoaToggle)
        if(getDoaToggle == 'false' || getDoaToggle == false) {
            $(this).data('toggle', true);
            $('.input-default-form-50px-textarea').parent().slideDown(200)
        } else {
            $(this).data('toggle', false)
            $('.input-default-form-50px-textarea').parent().slideUp(200)
        }
    });
    let niw = $('#nominal_input')
    let nominal = {{$nominal}}
    $('#nominal_input_wakaf').html(formatRupiah((nominal).toString(), 'Rp. '));
    let wcount = 1
    function AddWakaf() {
        wcount++
        $('#nominal_input_wakaf').html(formatRupiah((nominal * wcount).toString(), 'Rp. '));
        niw.val(nominal * wcount)
    }
    function DeleteWakaf() {
        if(wcount > 1) {
            wcount--
        }
        $('#nominal_input_wakaf').html(formatRupiah((nominal * wcount).toString(), 'Rp. '));
        niw.val(nominal * wcount)
    }
</script>
@endsection
