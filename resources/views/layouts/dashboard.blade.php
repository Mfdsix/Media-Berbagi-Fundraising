<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="{{ asset('storage/'.$web_set->path_icon) }}" />
    <title>@yield('title', envdb('APP_NAME'))</title>
    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- data table-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Plugin -->
    <link rel="stylesheet" href="{{ asset('dashboard/libs/owl.carousel/assets/owl.carousel.min.css') }}">

    <!-- APP CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/responsive.css') }}">
    @yield('css')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{padding:0}
        .datepicker{
            padding: 15px;
            border: 1px solid #eee;
        }
        .datepicker .table-condensed tfoot tr th{
            text-align: center;
            color: #087734;
        }
        .datepicker .table-condensed tr th, .datepicker .table-condensed tr td{
            padding: 5px;
            text-align: center;
            color: #878787;
        }
        .datepicker .table-condensed thead tr th{
            background-color: #087734;
            color: #fff;
        }
        .datepicker .table-condensed tr td.day:not(.old), .datepicker .table-condensed tr td .month, .datepicker .table-condensed tr td .year{
            color: #333;
        }
        .datepicker .table-condensed tr td.day.new{
            color: #878787;
        }
        .datepicker .datepicker-months .table-condensed, .datepicker .datepicker-years .table-condensed{
            min-width: 150px;
        }
        .datepicker .datepicker-months tbody td .month, .datepicker .datepicker-years tbody td .year{
            margin: 5px;
        }
        .datepicker .table-condensed tr td .year.old, .datepicker .table-condensed tr td .year.new{
            color: #878787;
        }
        .datepicker .table-condensed tr td{
            border: 1px solid #eee;
        }
        .datepicker .table-condensed tr td span{
            display: block;
            white-space: normal;
            text-align: center;
        }
    </style>
</head>

<body class="sidebar-expand">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-logo">
            <a href="{{ url('/') }}">
                <!-- <img src="{{ asset('assets/img/media berbagi beta.png') }}"/> -->
                @if($web_set->path_logo)
				<img loading="lazy" class="w-100 img-fluid" src="{{ asset('storage/' . $web_set->path_logo) }}" alt="Media Berbagi">
				@else
				<img loading="lazy" class="w-100 img-fluid" src="{{ asset('assets/media-berbagi/assets/images/website/logo-media-berbagi.png') }}" alt="Media Berbagi">
				@endif
            </a>
            <div class="sidebar-close" id="sidebar-close">
                <i style="font-size: 30px;" class='bx bx-left-arrow-alt'></i>
            </div>
        </div>
        <!-- SIDEBAR MENU -->
        <div class="simlebar-sc" data-simplebar>
        @include('menu.'.auth()->user()->level)
        </div>

        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
    <!-- Main Header -->
    <div class="main-header">
        <div class="d-flex">
            <div class="mobile-toggle" id="mobile-toggle">
                <i style="font-size: 30px" class='bx bx-menu'></i>
            </div>
            <div class="main-title">
                @yield('header', "Dashboard")
            </div>
        </div>

        <div class="d-flex align-items-center">

            <!-- App Search-->

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-search-alt' ></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary h-100" type="submit"><i class='bx bx-search-alt' ></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block mt-12">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(Auth::user()->path_foto == null)
                    <img class="rounded-circle header-profile-user" src="{{ asset('assets/img/user-santri.png') }}"
                    alt="Header Avatar">
                    @else
                    <img class="rounded-circle header-profile-user" src="{{ asset('storage/'.Auth::user()->path_foto) }}"
                    alt="Header Avatar">
                    @endif
                    <span class="pulse-css"></span>
                    <span class="info d-xl-inline-block  color-span">
                        <span class="d-block fs-20 font-w600">{{ auth()->user()->name }}</span>
                        <span style="font-size: 12px;" class="d-block" >{{ auth()->user()->email }}</span>
                    </span>

                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    @if(in_array(auth()->user()->level, ['admin', 'gerai', 'accounting']))
                    <a class="dropdown-item" href="{{ url(auth()->user()->level.'/profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span>Profile</span></a>
                    @endif
                    @if(auth()->user()->level == 'program')
                    <a class="dropdown-item" href="{{ url('/dashboard-program/profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span>Profile</span></a>
                    @endif
                    @if(auth()->user()->level == 'user')
                    <a class="dropdown-item" href="{{ url('/fundraiser/profile') }}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span>Profile</span></a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="$('#form-logout').submit()"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span>Logout</span></a>
                    <form method="post" id="form-logout" action="{{ route('logout') }}" style="display: none;">
                      @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Header -->
    <!-- MAIN CONTENT -->

    <div class="main">
        <div class="main-content dashboard">
        @yield('content')
        </div>
    </div>
    <!-- END MAIN CONTENT -->

    <!-- SCRIPT -->
    <!-- APEX CHART -->

    <script src="{{ asset('dashboard/libs/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('dashboard/libs/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <!-- APP JS -->
    <script src="{{ asset('dashboard/js/main.js') }}"></script>
    <script src="{{ asset('dashboard/js/shortcode.js') }}"></script>

    <script>
    $(document).ready(function() {
      $(".tanggalpicker").datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "mm/dd/yyyy"
      });

      $(".rupiah").on("keyup", function() {
        $(this).val(convertToRupiah($(this).val()));
      });
    });

    function convertToRupiah(angka) {
      var number_string = angka.replace(/\./g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return rupiah;
    }
  </script>
  @yield('js')
</body>

</html>
