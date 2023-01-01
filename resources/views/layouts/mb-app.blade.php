<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0" />
    <meta name="description" content="{{envdb('APP_NAME')}}" />
    <meta name="author" content="{{envdb('APP_NAME')}}" />
    <meta name="theme-color" content="@if($web_set->primary) {{ $web_set->primary }} @else #077734 @endif">

    <meta name="title" content="{{ $meta->title }}">
    <meta name="description" content="{{ $meta->description }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $meta->type }}">
    <meta property="og:url" content="{{ $meta->url }}">
    <meta property="og:title" content="{{ $meta->title }}">
    <meta property="og:description" content="{{ $meta->description }}">
    <meta property="og:image" content="{{ $meta->image }}">
    <link rel="stylesheet" href="{{ asset('assets/media-berbagi/styles/css/master-mediaberbagi.min.css') }}" media="all">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <style>
        .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:80px;
        margin-left: 500px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:center;
    font-size:30px;
        box-shadow: 2px 2px 3px #999;
    z-index:100;
    }

    .my-float{
        margin-top:16px;
    }
    </style>

    @yield('meta')

    <link rel="shortcut icon" type="image/png" href="{{ $meta->icon }}" />

    <title>{{envdb('APP_NAME')}}</title>
    <!-- ICON -->
    <link rel="icon" href="#" type="image/gif" sizes="16x16" />
<style>
    @if(isset($web_set))
    :root{
        --primary-color: @if($web_set->primary) {{ $web_set->primary }} @else #077734 @endif;
	}
    @endif
</style>
@yield('css')
</head>
<body>
@if($web_set->font)
{!! $web_set->font !!}
@else
<style>
    *{
        font-family: Inter, Roboto, sans-serif;
    }
</style>
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.3.2/swiper-bundle.min.css" media="all">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    
    @yield('content')

    <a href="https://api.whatsapp.com/send?phone=62881010198263&text=Assalamualaikum admin Amal Kampung Maghfirah." class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <!-- SHADOW MODAL -->
    <div id="shadow-modal" data-open="false"></div>
    <!-- JQUERY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- SWIPER JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/7.3.2/swiper-bundle.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous" async defer></script>

    @if($web_set->google_analytics)
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{$web_set->google_analytics}}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{$web_set->google_analytics}}');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-158121822-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-158121822-1', {
  'linker': {
    'domains': ['{{ env("APP_URL") }}']
  }
});
</script>

    @endif

@if($web_set->facebook_pixel)
<!-- Facebook Pixel Code -->
<!-- <script>
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
/></noscript> -->
<!-- End Facebook Pixel Code -->
@endif
    <script>
        @if(request()->r)
        localStorage.setItem('referral_code', '{{ request()->r }}');
        @endif
        var refCode = getReferralCode();

        if(refCode){
            $('a[data-referrable]').each(function(i, obj) {
                $(obj).attr('href', $(obj).attr('href') + "?r=" + getReferralCode());
            });
        }

        function getReferralCode(){
            var code = localStorage.getItem('referral_code');
            return code;
        }
    </script>
    @yield('js')
</body>
</html>
