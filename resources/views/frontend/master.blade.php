<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta content="IE=edge" http-equiv="x-ua-compatible">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">--}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    {{--<meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" name="viewport">--}}
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="#317EFB" name="theme-color" />
    <meta property="fb:pages" content="647470941973499" />
    <meta property="fb:app_id" content="219887311896668" />
    <title>@yield('title', Config::get('constants.options.PAGE_TITLE'))</title>
    @if(Request::is('page/*/*'))
    @yield('meta')
    @else
    <meta property="og:url"           content="{{Config::get('constants.options.PAGE_URL')}}" />
    <meta property="og:type"          content="http://www.keiladaily/" />
    <meta property="og:title"         content="{{Config::get('constants.options.PAGE_TITLE')}}" />
    <meta property="og:description"   content="{{Config::get('constants.options.PAGE_DESC')}}" />
    <meta property="og:image"         content="{{Config::get('constants.options.PAGE_IMG')}}"/>
    <meta name="description" content="{{Config::get('constants.options.PAGE_DESC')}}">
    <meta name="keyword" content="{{Config::get('constants.options.PAGE_KEY')}}">
    @endif
    <!-- fav icon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('img/icon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('img/icon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('img/icon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/icon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('img/icon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/icon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('img/icon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/icon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/icon/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('img/icon/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/icon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/icon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/icon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('img/icon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('img/icon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/kd_thems_style.css')}}">
    <link rel="stylesheet" href="{{asset('css/loader.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive_menu/css/style.css')}}">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css" rel="stylesheet" type="text/css">--}}
    @yield('style')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="responsive_test">
<!-- Loader -->
{{--<div id="loader-wrapper">--}}
    {{--<div id="loader" style="background-image: url('{{asset('img/icon/apple-icon-57x57.png')}}');background-position: center;background-repeat: no-repeat"></div>--}}
    {{--<div class="loader-section section-left"></div>--}}
    {{--<div class="loader-section section-right"></div>--}}
{{--</div>--}}
{{--<script>(function(d, s, id) {--}}
        {{--var js, fjs = d.getElementsByTagName(s)[0];--}}
        {{--if (d.getElementById(id)) return;--}}
        {{--js = d.createElement(s); js.id = id;--}}
        {{--js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";--}}
        {{--fjs.parentNode.insertBefore(js, fjs);--}}
    {{--}(document, 'script', 'facebook-jssdk'));</script>--}}
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div  id="top-header">
    <div class="logo-ads-section">
        <div class="container">
            <div class="col-md-4">
                <div class="logo-pptime">
                    <a href="/"><img src="{{asset('img/kd-logo.png')}}" alt="KD Logo"></a>
                </div>
            </div>
            <div class="col-md-8 r-hiden">
                <div class="row" >
                    <div class="col-md-12">
                        <div class="contact-to-bar">
                            <i class="fa fa-phone" aria-hidden="true"></i> +855 16 757 168 &nbsp;  &nbsp;
                            <i class="fa fa-envelope" aria-hidden="true"></i> samnob@keiladaily.com
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="supper-leader-ads">
                            <!-- start flexslider -->
                            <div class="flexslider">
                                <ul class="slides">
                                    <li><a href="https://www.facebook.com/onlinesportstv.asia"  target="_blank"><img src="{{asset('img/ads/kd-onlinetv.png')}}"></a></li>
                                </ul>
                            </div>
                            <!-- end flexslider -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<nav id="navigation">
    <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">
            <!-- resposive menu bar -->
            <div class="responsive-menu-bar">
                <header>
                    <div id="logo"><a href="/"><img src="{{asset('img/kd-logo-r.png')}}" alt="Homepage"></a></div>
                    <div id="cd-hamburger-menu"><a class="cd-img-replace" href="#0"><i class="fa fa-bars" aria-hidden="true"></i></a></div>
                    <div id="cd-cart-trigger"><a class="cd-img-replace" href="#0">Cart</a></div>
                    <div class="supper-leader-ads" >
                        <!-- start flexslider -->
                        <div class="flexslider" >
                            <ul class="slides" >
                                <ul class="slides">
                                    <li><a href="https://www.facebook.com/onlinesportstv.asia"  target="_blank"><img src="{{asset('img/ads/kd-onlinetv.png')}}"></a></li>
                                </ul>
                            </ul>
                        </div>
                        <!-- end flexslider -->
                    </div>
                </header>

                <nav id="main-nav">
                    <ul>
                        <li><a href="/">ទំព័រដើម</a></li>
                        <?php
                            $arraystyle = array('news','biz', 'life_style','tech', 'sport', 'art', 'photo');
                        ?>
                        @for($i = 0; $i < count($MENUS);$i++)
                            <li class="{{@$arraystyle[$i]}}"><a href="{{URL('/page',$MENUS[$i]->c_id)}}">{{$MENUS[$i]->c_title}}</a></li>
                        @endfor
                        <li><a href="{{URL('/onlinesportstv')}}">ទូរទស្សន៍កីឡាអនឡាញ</a></li>
                    </ul>
                    <div style="float:right;padding: 10px">
                        <form class="form-inline" action="{{url('/search')}}" method="get">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="ស្វែងរកអត្ថបទនៅទីនេះ" required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" style="background-color: #dc2226;border: none"><span class="glyphicon glyphicon-search" style="color: white"></span></button>
                                    </span>
                                </div><!-- /input-group -->
                            </div>
                        </form>
                    </div>
                </nav>
                <div id="cd-cart">
                    <ul class="cd-cart-items">
                        <li>
                            <a href="#">  H/P:+855 16 757 168 </a><br/>
                            <i class="fa fa-envelope" aria-hidden="true"></i> samnob@keiladaily.com
                        </li>
                    </ul>    <!--  cd-cart-items -->
                </div> <!-- cd-cart -->
            </div><!--end resposive menu -->

            <div class="navbar-collapse collapse">
                <div class="navbar-header" style="{{Request::is('/')? 'background-color: #053b5a;':''}}">
                    <a href="/">
                        <i id="image_logo" class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </div>
                <ul class="navbar-nav navbar-left">
                    @for($i = 0; $i < count($MENUS);$i++)
                        <li class="{{Request::is('page/'.$MENUS[$i]->c_id,'page/'.$MENUS[$i]->c_id.'/*')? 'current':''}}"><a href="{{URL('/page',$MENUS[$i]->c_id)}}">{{$MENUS[$i]->c_title}}</a></li>
                    @endfor
                        <li class="{{Request::is('onlinesportstv')? 'current':''}}"><a href="{{URL('/onlinesportstv')}}">ទូរទស្សន៍កីឡាអនឡាញ</a></li>
                </ul>

                <form class="form-inline navbar-form navbar-left" action="{{url('/search')}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="ស្វែងរកអត្ថបទនៅទីនេះ" required>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" style="background-color: #dc2226;border: none"><span class="glyphicon glyphicon-search" style="color: white"></span></button>
                        </span>
                    </div><!-- /input-group -->
                </form>


            </div><!--/.nav-collapse -->
        </div><!--/.container -->
    </div><!--navbar-default-->
</nav><!--navigation section end here-->
<div class="leading_location_ads mobile_ads_leading">
    <div class="container">
        <div class="row">
            <div class="supper-leader-ads" >
                <!-- start flexslider -->
                <div class="flexslider" >
                    <ul class="slides" >
                        <ul class="slides">
                            <li><a href="https://www.facebook.com/onlinesportstv.asia"  target="_blank"><img src="{{asset('img/ads/kd-onlinetv.png')}}"></a></li>
                        </ul>
                    </ul>
                </div>
                <!-- end flexslider -->
            </div>
        </div>
    </div>
</div>
@yield('content')
<footer id="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="copy-right">
                    <div class="col-md-5">
                        <img src="{{asset('img/footer-logo.png')}}">
                    </div>
                    <div class="col-md-7">
                        <ul>
                            <li><a href="#">ផ្តល់ព័ត៌មាន និងផ្សាយពាណិជ្ជកម្ម:016 757 168</a></li>
                        </ul>
                        <i class="fa fa-envelope" aria-hidden="true"></i> samnob@keiladaily.com
                        <p class="alright">© September 2015 រក្សាសិទ្ធិគ្រប់យ៉ាង </p>
                        <!-- <p class="develop"></p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-5">

            </div>
        </div>
    </div>
</footer>
<div id="hidden_pc"><a href="https://www.facebook.com/pisnoka/"  target="_blank"><img src="{{asset('img/ads/pisnoka_kd_ads_001-3-21-2017.png')}}"></a> <span id="close"><i class="fa fa-times" aria-hidden="true"></i></span></div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $("#close").click(function(){
            $("#hidden_pc").hide();
        });
    });
</script>

<!-- Return to Top -->
<a href="javascript:void(0)" id="return-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

<script src="{{asset('js/plugins.js')}}"></script>
<script>
    $(function(){
        $('.flexslider').flexslider({
            controlNav : false,
            nextText : '',
            prevText : '',
        });
    });
</script>

<script src="{{asset('css/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/min/main.min.js')}}"></script>
<script src="{{asset('css/responsive_menu/js/main.js')}}"></script>
@yield('script')
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
    fbq('init', '250785985463790');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=250785985463790&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->

<!--fb-->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '219887311896668',
            xfbml      : true,
            version    : 'v2.12'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>

    //===== Scroll to Top ====
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-83022496-1', 'auto');
    ga('send', 'pageview');

</script>

<script>
    $(function () {
        'use strict';

        /* Prevent Safari opening links when viewing as a Mobile App */
        (function(a, b, c) {
            if (c in b && b[c]) {
                var d, e = a.location,
                    f = /^(a|html)$/i;
                a.addEventListener("click", function(a) {
                    d = a.target;
                    while (!f.test(d.nodeName)) d = d.parentNode;
                    "href" in d && (d.href.indexOf("http") || ~d.href.indexOf(e.host)) && (a.preventDefault(), e.href = d.href)
                }, !1)
            }
        })(document, window.navigator, "standalone");
    });
</script>
{{--<script>--}}
    {{--$(function () {--}}
        {{--setTimeout(function() {--}}
            {{--$('body').addClass('loaded');--}}
        {{--}, 1000);--}}
    {{--});--}}
{{--</script>--}}

</body>
</html>

