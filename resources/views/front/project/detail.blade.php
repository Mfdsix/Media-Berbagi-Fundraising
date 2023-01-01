@extends('layouts.app')

@section('title', 'Detail Page')
@section('css')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=O">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/variable.css">
    <link rel="stylesheet" href="./assets/css/detail.css">
    
    <meta property="og:title" content="{{ $project->title}}">
    <meta property="og:description" content="Donasi Sekarang untuk {{ $project->title }}">
    <meta property="og:image" content="{{ ($project->path_featured == null) ? asset('images/project.jpg'): asset('storage/'.$project->path_featured) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="{{ ($project->path_featured == null) ? asset('images/project.jpg'): asset('storage/'.$project->path_featured) }}">

    <meta property="og:site_name" content="">
    <meta name="twitter:image:alt" content="">

    <title>Detail Page</title>

    <style>
        .img-blank{
            width: 50px;
            height: 100%;
        }
        .text-center img{
            width: 114px;
            height: 86px;
        }
        #btn-fundriser {
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 19px;
            text-align: center;
            color: var(--primary);
            border: 1px solid var(--primary);
            box-sizing: border-box;
            border-radius: 13px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 52px;
            }
        #btn-fundriser:hover {
            background-color: var(--primary);
            color: white;
            }
        #invite-fundriser{
            font-family: Inter;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 19px;
            text-align: center;
            color: var(--primary);
            border: 1px solid var(--primary);
            box-sizing: border-box;
            border-radius: 13px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 52px;
            }
        #invite-fundriser:hover{
            background-color: var(--primary);
            color: white;
            }
        }
	}
    </style>
@endsection

@section('content')
<div id="navbar-top">
    <div class="navbar-wrapper">
        <button class="btn-transparent">
            <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                <img src="./assets/img/icons/back-light.svg" alt="">
            </a>
        </button>
        <h4 class="navbar-wrapper-title one-line">{{ $project->title }}</h4>
        <button class="btn-transparent" id="btn-share">
            <img src="./assets/img/icons/share-light.svg" alt="">
        </button>
    </div>
</div>

<div class="screen">
    <div class="row">
        <div class="screen-cover d-none"></div>

        {{--HEADER SECTION--}}
        <div class="col-12">
            <div class="header-section">
                @if($project->path_featured == null)
                <img src="{{ asset('images/project.jpg') }}" alt="Card image cap" class="card-img">
                @else
                <img src="{{ asset('storage/'.$project->path_featured) }}" class="header-main-image img-fluid" alt="">
            </div>
        </div>
        @endif

        {{--CONTENT SECTION--}}
        <div class="col-12">
            <div class="content-section">
                
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
                
                <div class="content-header-wrapper">
                    <h4 class="content-main-title">{{ $project->title }}</h4>
                    <a href="/project/save/{{$project->id}}" class="btn-transparent">
                        <img src="./assets/img/icons/save-salmon.svg" alt="">
                    </a>
                </div>
                <div class="content-main-target">
                    
                    <span class="content-main-current">{{ $project->donations }}</span>
                    <span class="content-main-text">dari</span>
                    <span class="content-main-limit">{{ $project->nominal_target }}</span>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="{{ $project->percentage }}" aria-valuenow="{{ $project->percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="content-main-detail">
                    <div class="content-detail-wrapper">
                        <h4 class="content-detail-value">{{ $project->countPeopleDonation() }}</h4>
                        <h4 class="content-detail-label">Donasi</h4>
                    </div>

                    <div class="content-detail-wrapper">
                        <h4 class="content-detail-value">{{ $project->date_count }}</h4>
                        <h4 class="content-detail-label">Hari Lagi</h4>
                    </div>
                </div>
                <div class="quantity-bar mb-1">
                    <div class="quantity-controller">
                        <button class="quantity-minus"><img src="./assets/img/icons/minus-blue.svg" alt=""></button>
                        <input type="number" class="quantity-number" value="1" data-amount="50000">
                        <button class="quantity-plus"><img src="./assets/img/icons/plus-blue.svg" alt=""></button>
                    </div>
                    <h4 class="quantity-amount">Rp50.000</h4>
                </div>
                @if($project->status == 1)
                <a href="{{ url('project/'.$project->id.'/nominal?n=50000') }}" class="btn-donate-now" role="button">
                    {{ $project->button_label ?? 'Donasi Sekarang' }}
                </a>
                @else
                <button type="button" disabled class="btn btn-secondary btn-block font-weight-bold btn-donate">CAMPAIGN SUDAH BERAKHIR</button>
                @endif
            </div>
        </div>

        {{--DESCRIPTION SECTION--}}
        <div class="col-12">
            <div class="description-section">
                <div class="line-separator"></div>
                <h4 class="section-title">Deskripsi</h4>
                <div class="section-description">
                    <div class="section-description-text">
                        {!! $project->content !!}
                    </div>
                    <button class="btn-view-more">Read more</button>
                </div>
                <div class="line-separator"></div>
            </div>
        </div>

        {{--NEWS SECTION--}}
        @if (empty($update))
            <div class="col-12">
                <div class="news-section">
                    <div class="news-wrapper-center">
                        <h4 class="section-title">Kabar Terbaru</h4>
                        <div class="text-center p-4">
                            <img src="{{ asset('images/doc-sleep 1.svg') }}" class="img-blank mb-2">
                            <p class="text-icon">Belum ada kabar terbaru di program ini</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-12">
                <div class="news-section">
                    <div class="news-wrapper">
                        <h4 class="section-title">Kabar Terbaru</h4>
                        <a href="{{ url('project/'.$project->id.'/news') }}" class="btn-see-all">Lihat semua</a>
                    </div> 
        
                    @if($update->update_type == 0)
                    <div class="news-card">
                        @else
                        <h4 class="news-date">{{ $update->date }}</h4>
                        @endif
                        <h4 class="news-nominal">Pencairan dana Rp. {{ $update->nominal }}</h4>
                        <div class="news-content">
                            <div class="news-content-text">
                                {!! $update->content !!}
                            </div>
                        </div>
                        <button class="btn-read-more">Read more</button>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="news-section">
                <div class="news-wrapper">
                    <div class="line-separator"></div>
                </div>
            </div>
        </div>
            
        {{--DONATION SECTION--}}
        @if(count($donaturs) == 0)
            <div class="col-12">
                <div class="donatur-section">
                    <div class="news-wrapper-center">
                        <h4 class="section-title">Donatur ({{ $project->countPeopleDonation() }})</h4>
                        <div class="text-center p-4">
                            <img src="{{ asset('images/wallet-sleep 1.svg') }}" class="img-blank mb-2">
                            <p class="text-icon">Jadilah donatur pertama di program ini</p>
                        </div>
                    </div>
                </div>
            </div>
            @else  
            <div class="col-12">
                <div class="donatur-section">
                    <div class="news-wrapper">
                        <h4 class="section-title">Donatur ({{ $project->countPeopleDonation() }})</h4>        
                        <a href="donation/all-donations" class="btn-see-all">Lihat semua</a>
                    </div>
                        
                    @foreach($donaturs as $k => $v)
                    <div class="donatur-card">
                        <img src="./assets/img/detail/donatur.png" alt="" class="donatur-profile">
                        <div class="donatur-info">
                            <h4 class="donatur-name">{{ $v->donature_name }}</h4>
                            <h4 class="donatur-nominal">Berdonasi sebesar Rp{{ $v->nominal }}</h4>
                            <h4 class="donatur-date">15 menit yang lalu</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="news-section">
                <div class="news-wrapper">
                    <div class="line-separator"></div>
                </div>
            </div>
        </div>

        {{--FUNDRAISER SECTION--}}
        @if(count($donaturs) == 0)
            <div class="col-12" style="margin-bottom: 90px">
                <div class="donatur-section">
                    <div class="news-wrapper-center">
                        <h4 class="section-title">Fundraiser ({{ $project->countPeopleDonation() }})</h4>
                        <div class="text-center p-4">
                            <img src="{{ asset('images/illustration_megaphone-sleep 1.svg') }}" class="img-blank mb-2">
                            <p class="text-icon">Ayo ikutan berkontribusi pada program ini dengan menjadi fundraiser</p>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-block" id="btn-fundriser" style="height: 52px; border-radius: 13px;"><b>Jadi Fundriser</b></button>
                    <button class="btn btn-outline-primary btn-block mb-5" id="invite-fundriser" style="height: 52px; border-radius: 13px; border-style: none;"><b>Undang Fundriser</b></button>
                </div>
            </div>
            @else  
            <div class="col-12">
                <div class="donatur-section">
                    <div class="news-wrapper">
                        <h4 class="section-title">Fundariser ({{ $project->countPeopleDonation() }})</h4>        
                        <a href="fundraiser/all-fundraiser" class="btn-see-all">Lihat semua</a>
                    </div>
                        
                    @foreach($donaturs as $k => $v)
                    <div class="donatur-card">
                        <img src="./assets/img/detail/donatur.png" alt="" class="donatur-profile">
                        <div class="donatur-info">
                            <h4 class="donatur-name">{{ $v->donature_name }}</h4>
                            <h4 class="donatur-nominal">Berdonasi sebesar Rp{{ $v->nominal }}</h4>
                            <h4 class="donatur-date">15 menit yang lalu</h4>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{--FOOTER SECTION--}}
        <div class="footer-menu" style="display: none">
            <div class="quantity-bar mb-1">
                <div class="quantity-controller">
                    <button class="quantity-minus"><img src="./assets/img/icons/minus-blue.svg" alt=""></button>
                    <input type="number" class="quantity-number" value="1" data-amount="50000">
                    <button class="quantity-plus"><img src="./assets/img/icons/plus-blue.svg" alt=""></button>
                </div>
                <h4 class="quantity-amount">Rp50.000</h4>
            </div>
            @if($project->status == 1)
            <a href="{{ url('project/'.$project->id.'/nominal?n=50000') }}" class="btn-donate-now" role="button">
                {{ $project->button_label ?? 'Donasi Sekarang' }}
            </a>
            @else
            <button type="button" disabled class="btn btn-secondary btn-block font-weight-bold btn-donate">CAMPAIGN SUDAH BERAKHIR</button>
            @endif
        </div>

    </div>
</div>

{{--SHARE SECTION--}}
<div id="bottom-share" class="d-none">
    <h4 class="share-title">Bagikan ke orang baik lainnya</h4>

    <div class="share-bar">
        <a href="https://www.instagram.com/digyta.official/" class="share-button" target="_blank">
            <div class="share-img-wrapper">
                <img src="./assets/img/icons/instagram-purple.svg" alt="">
            </div>
            <h4 class="share-text">Instagram</h4>
        </a>
        <a href="https://wa.me/send?phone=6287798020517&text=Halo, bantu donasi dengan klik {{ url()->current() }}" class="share-button" target="_blank">
            <div class="share-img-wrapper">
                <img src="./assets/img/icons/whatsapp-purple.svg" alt="">
            </div>
            <h4 class="share-text">Whatsapp</h4>
        </a>
        <a href="https://www.facebook.com/sharer.php?u={{ url()->current() }}" class="share-button" target="_blank">
            <div class="share-img-wrapper">
                <img src="./assets/img/icons/facebook-purple.svg" alt="">
            </div>
            <h4 class="share-text">Facebook</h4>
        </a>
    </div>
</div>
@endsection

@section('js')
@include('front.project.social')
<script type="text/javascript">
	var page = 1;
	var is_end = false;
	var total_buy = 1;
	var wakaf_price = {{ $project->wakaf_price }};
	var max_buy = "{{ $project->nominal_target ?? 0 }}";

	$("#donasi-list-loading").show();
	$("#donasi-list-message-wrap").hide();

	$(window).scroll(function() {
		var height = $(window).scrollTop();

		if(height > 120) {
			$('#navbar-fixed').addClass('active');
		} else {
			$('#navbar-fixed').removeClass('active');
		}

		if(height > 420) {
			$('.footer-menu').css('display', 'block');
		} else {
			$('.footer-menu').css('display', 'none');
		}
	});

	$(document).ready(function(){
		$(".btn-donate").on("click", function(){
			window.location.href = "{{ url('project/'.$project->id.'/nominal') }}";
		});
		$("#total_buy").html(total_buy);
		$("#total_wakaf").html("Rp " + convertToRupiah(total_buy * wakaf_price));

		loadDonations();

		$("#btn-read-more").on("click", function(){
			$(".project-story").css('height', 'auto');
			$(".project-story-more").css('display', 'none');
			$(".project-story-less").css('display', 'block');
		});
		$("#btn-read-less").on("click", function(){
			$(".project-story").css('height', '150px');
			$(".project-story-less").css('display', 'none');
			$(".project-story-more").css('display', 'block');
		});

		$("#btn-plus").on("click", function(){
			if(max_buy == "∞" || total_buy <= parseInt(max_buy)){
				total_buy++;
			}
			$("#total_buy").val(total_buy);
			$("#total_wakaf").html("Rp " + convertToRupiah(total_buy * wakaf_price));
		});
		$("#btn-reduce").on("click", function(){
			if(total_buy > 1){
				total_buy--;
			}
			$("#total_buy").val(total_buy);
			$("#total_wakaf").html("Rp " + convertToRupiah(total_buy * wakaf_price));
		});

	});
	function loadDonations(){
		if(!is_end){
			$.ajax({
				url : '{{ url("project/".$project->id."/donation") }}',
				method : 'POST',
				data : {
					page : page,
					_token : '{{ csrf_token() }}'
				},
				success : function(d){
					if(d.success){
						$("#donasi-list-loading").hide(300);
						if(page == 1 && d.is_end){
							$("#donasi-list-message").text("Belum Ada Donasi");
							$("#donasi-list-message-wrap").show(300);
						}else if(page != 1 && d.is_end){
								// 
							}else{
								$("#donasi-list").html("");
								d.datas.forEach(function(v, i){
									if(v.special_message != null){
										$("#donasi-list").append('<div class="rounded p-3 mb-2 col-12"><div class="row align-items-center"><div class="col-1"><img src="'+v.photo+'" class="img-circle"></div><div class="col-11"><h6 class="mb-0">'+v.donature_name+'</h6><p style="font-size: 12px" class="mb-0">'+v.nominal+'</p><div>'+v.special_message+'</div></div></div></div>');
									}else{
										$("#donasi-list").append('<div class="rounded p-3 mb-2 col-12"><div class="row align-items-center"><div class="col-1"><img src="'+v.photo+'" class="img-circle"></div><div class="col-11"><h6 class="mb-0">'+v.donature_name+'</h6><p style="font-size: 12px" class="mb-0">'+v.nominal+'</p></div></div></div>');
									}
								});
							}
						}else{
							$("#donasi-list-loading").hide(300);
							$("#donasi-list-message").text(d.message);
							$("#donasi-list-message-wrap").show(300);	
						}
					},
					error : function(e){
						$("#donasi-list-loading").hide(300);
						$("#donasi-list-message").text("Terjadi Kesalahan, silahkan refresh halaman");
						$("#donasi-list-message-wrap").show(300);
					}
				});
		}
	}

	function goBack(){
		window.history.back();
	}
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./assets/js/global.js"></script>
<script src="./assets/js/news.js"></script>
<script src="./assets/js/detail.js"></script>
@endsection