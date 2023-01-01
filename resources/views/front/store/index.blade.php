@extends('layouts.app')

@section('title', 'Detail Page')
@section('css')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/variable.css">
    <link rel="stylesheet" href="./assets/css/all-products.css">

    <title>Detail Page</title>
@endsection

@section('content')
    <div id="navbar-top">
        <div class="navbar-wrapper">
            <h4 class="navbar-wrapper-title">Official Store</h4>
            @auth
            <a href="/cart">
                <img src="./assets/img/icons/cart-light.svg" alt="">
            </a>
            @endauth
        </div>
    </div>

    <div class="screen">
        <div class="row">

            <div class="col-12" id="products-section">
                <div class="row w-100">
                    @foreach($product as $row)
                        <div class="col-6">

                            <a href="{{url('product/'.$row->id)}}" class="product-card">
                                <img src="{{asset('storage/'.$row->thumbnail)}}" alt="">
                                <div class="product-name one-line" style="white-space: nowrap; display:inline-block; width:174px;">{{$row->name}}</div>
                                <div class="product-price">{{"Rp ".str_replace(',', '.', number_format($row->price))}}</div>
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <!--FOOTER SECTION-->
    <div class="nav-bottom">
		<div class="navbar-bottom-navigation">
			<a href="/" class="navbar-bottom-link">
				<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M24.3254 10.8738C24.3249 10.8732 24.3243 10.8727 24.3237 10.8721L14.1257 0.674438C13.691 0.239563 13.1131 0 12.4984 0C11.8836 0 11.3057 0.239372 10.8708 0.674248L0.678141 10.8667C0.674708 10.8702 0.671275 10.8738 0.667842 10.8772C-0.224797 11.775 -0.223271 13.2317 0.672229 14.1272C1.08135 14.5365 1.62171 14.7736 2.19944 14.7984C2.2229 14.8006 2.24655 14.8018 2.2704 14.8018H2.67685V22.3066C2.67685 23.7917 3.88516 25 5.3706 25H9.36039C9.76475 25 10.0928 24.6721 10.0928 24.2676V18.3838C10.0928 17.7061 10.644 17.1549 11.3217 17.1549H13.675C14.3527 17.1549 14.9039 17.7061 14.9039 18.3838V24.2676C14.9039 24.6721 15.2318 25 15.6363 25H19.6261C21.1116 25 22.3199 23.7917 22.3199 22.3066V14.8018H22.6968C23.3113 14.8018 23.8892 14.5624 24.3243 14.1275C25.2208 13.2305 25.2211 11.7714 24.3254 10.8738Z" fill="#A4A4A4"/>
				</svg>
				<h4 class="navbar-bottom-text">Beranda</h4>
            </a>
						
            <a href="{{ url('program') }}" class="navbar-bottom-link">
				<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M17.9114 2.15185C15.8259 2.14071 13.8433 3.05661 12.5 4.65182C11.165 3.0457 9.17695 2.1272 7.08857 2.15185C3.17365 2.15185 0 5.32549 0 9.24041C0 15.9493 11.7088 22.4999 12.1835 22.7531C12.3751 22.881 12.6249 22.881 12.8165 22.7531C13.2912 22.4999 25 16.0442 25 9.24041C25 5.32549 21.8263 2.15185 17.9114 2.15185Z" fill="#A4A4A4"/>
				</svg>
				<h4 class="navbar-bottom-text">Program</h4>
            </a>
			
            <a href="{{ url('official-store') }}" class="navbar-bottom-link active">
				<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0)">
						<path d="M24.5625 8.66262C24.1968 8.23598 23.6483 7.96171 23.0997 7.96171H21.576L15.6944 0.708749C15.3287 0.25163 14.6888 0.160206 14.2012 0.495427C13.744 0.861122 13.6526 1.50109 13.9878 1.98868C13.9878 2.01916 14.0183 2.01916 14.0183 2.04963L18.8638 7.96171H5.82065L10.6356 2.04963C11.0318 1.62299 11.0013 0.952546 10.5747 0.556376C10.148 0.160206 9.4776 0.190681 9.08143 0.617325C9.05095 0.6478 9.02048 0.678275 8.99001 0.708749L3.10841 7.99218H1.88942C0.853289 7.99218 0 8.84547 0 9.88161C0 10.0035 0 10.1254 0.0304746 10.2473L2.46844 22.5286C2.71224 23.8085 3.8398 24.7227 5.15021 24.7227H19.839C21.1494 24.7227 22.2769 23.8085 22.5207 22.5286L24.9587 10.2473C25.0806 9.69876 24.9282 9.11974 24.5625 8.66262ZM9.32523 18.6278C9.32523 19.2068 8.83763 19.6944 8.25862 19.6944C7.6796 19.6944 7.192 19.2068 7.192 18.6278V14.3004C7.192 13.7214 7.6796 13.2338 8.25862 13.2338C8.83763 13.2338 9.32523 13.7214 9.32523 14.3004V18.6278ZM13.5612 18.6278C13.5612 19.2068 13.0736 19.6944 12.4946 19.6944C11.9156 19.6944 11.428 19.2068 11.428 18.6278V14.3004C11.428 13.7214 11.9156 13.2338 12.4946 13.2338C13.0736 13.2338 13.5612 13.7214 13.5612 14.3004V18.6278ZM17.7667 18.6278C17.7667 19.2068 17.2791 19.6944 16.7001 19.6944C16.1211 19.6944 15.6335 19.2068 15.6335 18.6278V14.3004C15.6335 13.7214 16.1211 13.2338 16.7001 13.2338C17.2791 13.2338 17.7667 13.7214 17.7667 14.3004V18.6278Z" fill="#A4A4A4"/>
					</g>
					<defs>
                        <clipPath id="clip0">
                            <rect width="25" height="25" fill="white"/>
                        </clipPath>
					</defs>
				</svg>
				<h4 class="navbar-bottom-text">Official Store</h4>
			</a>

			<a href="{{ url('my-account') }}" class="navbar-bottom-link">
				<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M12.5 0.000976562C5.59716 0.000976562 0 5.59704 0 12.5004C0 19.4038 5.59661 24.9999 12.5 24.9999C19.4039 24.9999 25 19.4038 25 12.5004C25 5.59704 19.4039 0.000976562 12.5 0.000976562ZM12.5 3.73846C14.7841 3.73846 16.635 5.5899 16.635 7.87291C16.635 10.1565 14.7841 12.0074 12.5 12.0074C10.217 12.0074 8.36609 10.1565 8.36609 7.87291C8.36609 5.5899 10.217 3.73846 12.5 3.73846ZM12.4973 21.7318C10.2192 21.7318 8.13274 20.9022 6.52343 19.529C6.1314 19.1946 5.90519 18.7043 5.90519 18.1898C5.90519 15.8744 7.77914 14.0213 10.0951 14.0213H14.906C17.2225 14.0213 19.0893 15.8744 19.0893 18.1898C19.0893 18.7049 18.8642 19.1941 18.4716 19.5285C16.8629 20.9022 14.7759 21.7318 12.4973 21.7318Z" fill="#A4A4A4"/>
				</svg>
                <h4 class="navbar-bottom-text">Akun</h4>
			</a>
			</div>
		</div>
    </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="./assets/js/news.js"></script>
<script src="./assets/js/detail.js"></script>
<script src="./assets/js/global.js"></script>
@endsection