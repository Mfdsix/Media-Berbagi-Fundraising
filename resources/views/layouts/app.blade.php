<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0" />
  <meta name="description" content="{{envdb('APP_NAME')}}" />
  <meta name="author" content="{{envdb('APP_NAME')}}" />
  @if(\App\Models\Setting::find(1) != null)
  <meta name="theme-color" content="{{\App\Models\Setting::find(1)->primary}}">
  @endif

<meta name="title" content="{{envdb('APP_NAME')}}">
<meta name="description" content="{{envdb('APP_NAME')}} - Bayar Donasi Waqaf Infaq dan Qurban dengan mudah dimana saja dan kapan saja">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{url('/')}}">
<meta property="og:title" content="{{envdb('APP_NAME')}}">
<meta property="og:description" content="{{envdb('APP_NAME')}} - Bayar Donasi Waqaf Infaq dan Qurban dengan mudah dimana saja dan kapan saja">
<meta property="og:image" content="">

  @yield('meta')

  <title>{{envdb('APP_NAME')}}</title>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/variable.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/loading.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fonts.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">

  <style type="text/css">
    .img-blank{
      width: 50px;
      height: 50px;
    }
    .img-round{
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }
  </style>
  @yield('css')

</head>
<body>
  {{--<div class="screen-cover">
    <div class="screen-loader">
      <div class="loader2">
      </div>
    </div>
  </div>--}}
  @yield('content')
  <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/toast.js') }}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180286148-1"></script>-->
<!--<script>-->
<!--  window.dataLayer = window.dataLayer || [];-->
<!--  function gtag(){dataLayer.push(arguments);}-->
<!--  gtag('js', new Date());-->

<!--  gtag('config', 'UA-180286148-1');-->
<!--</script>-->
{{-- <!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '290436735690454');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=290436735690454&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code --> --}}

  <script type="text/javascript">
    $(document).ready(function(){
      $(".rupiah").on("keyup", function(){
        $(this).val(convertToRupiah($(this).val()));
      });
    });

    function convertToRupiah(angka)
    {
      if(angka == NaN) return 0;
      var number_string = angka.toString().replace(/\./g, '').toString(),
      split           = number_string.split(','),
      sisa            = split[0].length % 3,
      rupiah          = split[0].substr(0, sisa),
      ribuan          = split[0].substr(sisa).match(/\d{3}/gi);

      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return rupiah;
    }

    function copyToClipboard(value) {
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(value).select();
      document.execCommand("copy");
      $temp.remove();
      var toast = new iqwerty.toast.Toast();
      toast.setText('Text disalin ke papan klip').show();
    }
  </script>

  <script>
    // $(document).ready(function(){
    // $(".loader2").fadeOut();
    // })
  </script>

  <script>
    // $(document).ready(function(){
    // $(".screen-cover").fadeOut();
    // })
  </script>

  @yield('js')
  @stack('js')
</body>
</html>
