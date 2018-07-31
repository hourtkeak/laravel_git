@extends('backend.master')
@section('style')
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <h3>{{\App\User::count()}}</h3>

                        <p>Total User Accounts</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{route('backend.user')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3>{{\App\Content::withoutGlobalScopes()->count()}}</h3>

                        <p>Total Contents</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <a href="{{route('backend.content')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3>{{\App\Slide::count()}}</h3>

                        <p>Total Slide Shows</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-picture-o"></i>
                    </div>
                    <a href="{{route('backend.slide')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{\App\Menu::count()}}</h3>

                        <p>Total Menu</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bars"></i>
                    </div>
                    <a href="{{route('backend.menu')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('fail'))
                $.notify({
                    icon: 'pe-7s-less',
                    message: "{{Session::get('fail')}}"

                },{
                    type: 'danger',
                    timer: 4000
                });
            @else
                $.notify({
                    icon: 'pe-7s-gift',
                    message: "Welcome to <b>Keila Daily Dashboard</b> - a popular sport news website."

                },{
                    type: 'info',
                    timer: 4000
                });
            @endif

        });
    </script>
@endsection



