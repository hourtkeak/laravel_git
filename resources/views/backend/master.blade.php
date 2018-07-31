<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.ico')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>KD | Dashboard</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{asset('css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->

    <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Hanuman" rel="stylesheet">
    <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <style>
        *:not(i):not(span){
            font-family: 'Hanuman','Roboto' !important;
        }
    </style>
    @yield('style')
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{URL('/admin')}}" class="simple-text">
                    KD Dashboard
                </a>
            </div>

            <ul class="nav">
                <li class="{{Request::is('admin/dashboard')? 'active' : ''}}">
                    <a href="{{route('backend.dashboard')}}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if(Auth::user()->level==1)
                <li class="{{Request::is('admin/user','admin/user/add','admin/user/edit/*')? 'active' : ''}}">
                    <a href="{{route('backend.user')}}">
                        <i class="pe-7s-user"></i>
                        <p>User Account</p>
                    </a>
                </li>
                @endif
                <li class="{{Request::is('admin/content','admin/content/edit/*','admin/content/add','admin/search')? 'active' : ''}}">
                    <a href="{{route('backend.content')}}">
                        <i class="pe-7s-news-paper"></i>
                        <p>News List</p>
                    </a>
                </li>
                <li class="{{Request::is('admin/slide','admin/slide/add','admin/slide/edit/*')? 'active' : ''}}">
                    <a href="{{route('backend.slide')}}">
                        <i class="pe-7s-display2"></i>
                        <p>Slide Show</p>
                    </a>
                </li>
                @if(Auth::user()->level==1)
                <li class="{{Request::is('admin/menu','admin/menu/edit/*','admin/menu/add')? 'active' : ''}}">
                    <a href="{{route('backend.menu')}}">
                        <i class="pe-7s-menu"></i>
                        <p>Menu Setting</p>
                    </a>
                </li>
                @endif
                <li class="{{Request::is('admin/tag','admin/tag/edit/*','admin/tag/add')? 'active' : ''}}">
                    <a href="{{route('backend.tag')}}">
                        <i class="fa fa-tags"></i>
                        <p>Tag Setting</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">


                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="">
                                <p>{{Auth::user()->name}}</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <p>
                                    Setting
                                    <b class="caret"></b>
                                </p>

                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('backend.profile')}}">View profile</a></li>
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="http://keiladaily.com/" target="_blank">
                                Visit the site
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://keiladaily.com/" target="_blank">Keila Daily</a>, developed by CVC
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

<!--   Core JS Files   -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
{{--<script src="{{asset('assets/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>--}}
<script src="{{asset('css/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>

<!--  Charts Plugin -->
<script src="{{asset('assets/js/chartist.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/js/demo.js')}}"></script>

@yield('script')
</html>