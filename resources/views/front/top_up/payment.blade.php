@extends('layouts.app')

@section('title', 'Metode Pembayaran')
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
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/variable.css">
    <link rel="stylesheet" href="../../assets/css/metode.css">

    <title>Payment Page</title>
    <style>
         #next-payment{
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
        #next-payment:hover{
            background-color: var(--primary);
		    color: white;
        }
    </style>
@endsection

@section('content')

    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button class="btn-transparent">
                <a href="javascript:void(0)" onclick="goBack()" class="text-white">
                    <img src="../../assets/img/icons/back-light.svg" alt="">
                </a>
            </button>
            <h4 class="navbar-wrapper-title">Metode Pembayaran</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">
            <div class="col-12">
                <div class="method-section">
                    
                    <div class="method-wrapper">
                        <h4 class="section-title">Pembayaran di Forfund</h4>
                    </div>
    
                    <div class="method-wrapper">
                        <h4 class="section-title">Virtual Acccount</h4>
                        @if(isset($payment['va']))
                        @if(count($payment['va']) == 0)
                            <div class="text-muted text-center p-4 mb-5 bg-light">Pembayaran belum tersedia</div>
                        @else
                        @foreach($payment['va'] as $va)
                         <div class="payment-item " data-payment="{{ $va->pg_name }}" data-code="{{ $va->pg_code }}" data-type="virtualaccount">
                            <div class="method-box">
                                <div class="method-info">
                                    <img src="{{ asset($va->pg_detail[0]) }}" alt="">
                                    <div class="method-balance-group">
                                        <h4 class="method-name">{{ $va->pg_name }}</h4>
                                    </div>
                                </div>
                                <input class="method-check" type="checkbox">
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @endif
                    </div>
        
                    <div class="method-wrapper">
                        <h4 class="section-title">Transfer Bank</h4>
                        @if(count($banks) > 0)
                        @foreach($banks as $k => $v)
                        <div class="payment-item " data-payment="{{ $v->bank_name }}" data-code="{{ $v->id }}" data-type="bank">
                            <div class="method-box">
                                <div class="method-info">
                                    <img src="{{ asset('storage/'.$v->path_icon) }}" alt="">
                                    <div class="method-balance-group">
                                        <h4 class="method-name">{{ $v->bank_name }}</h4>
                                    </div>
                                </div>
                                <input class="method-check" type="checkbox">
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
    
                    <div class="method-wrapper">
                        <h4 class="section-title">E-wallet</h4>
    
                        @if(isset($payment['em']))
                        @if(count($payment['em']) == 0)
                            <div class="text-muted text-center p-4 mb-5 bg-light">Pembayaran belum tersedia</div>
                        @else
                        @foreach($payment['em'] as $em)
                         <div class="payment-item " data-payment="{{ $em->pg_name }}" data-code="{{ $em->pg_code }}" data-type="emoney">
                            <div class="method-box">
                                <div class="method-info">
                                    <img src="{{ asset($em->pg_detail[0]) }}" alt="">
                                    <div class="method-balance-group">
                                        <h4 class="method-name">{{ $em->pg_name }}</h4>
                                    </div>
                                </div>
                                <input class="method-check" type="checkbox">
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @endif
                        
                    </div>
                    
                    <nav class="footer-menu main-width">
                        <div class="flex">
                            <button disabled="" class="btn-next btn btn-accent btn-block font-weight-bold" id="next-payment">LANJUTKAN PEMBAYARAN</button>
                        </div>
                        <form method="post" id="form-payment" action="{{ url()->current() }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="n" value="{{ Request::get('n') }}">
                            <input type="hidden" name="payment" value="">
                            <input type="hidden" name="payment_type" value="">
                            <input type="hidden" name="payment_code" value="">
                        </form>
                    </nav>
                    
                </div>
            </div>
        </div>
    </div>
    @endsection
    
    @section('js')
    <script type="text/javascript">
    $(document).ready(function(){
        $(".payment-item").on("click", function(){
            var payment = $(this).data('payment');
            var code = $(this).data('code');
            var payment_type = $(this).data('type');
    
            if($(this).find('.method-check').prop('checked')) {
                $("input[name='payment']").val(payment);
                $("input[name='payment_type']").val(payment_type);
                $("input[name='payment_code']").val(code);
            }
    
            console.log(payment)
    
            // let _ = $('.payment-item .card')
            // _.each((e,f)=>{
            // 	$(f).removeClass('border')
            // })
    
            // $(this).find('.card').addClass('border')
    
            $(".btn-next").prop('disabled', false);
            $(".payment-item.active").removeClass('active');
            $(this).addClass('active');
        });
    
        $(".btn-next").on("click", function(){
            $("#form-payment").submit();
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../../assets/js/global.js"></script>
    <script src="../../assets/js/toast/toast.js"></script>
    <script src="../../assets/js/metode.js"></script>
    @endsection	