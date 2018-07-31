@extends('frontend.master')
@section('style')
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
@endsection
@section('content')
    <div class="main-slide-show">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    {{--new slider--}}
                    <div class="owl-carousel ">
                        @if(count($slides))
                            @foreach($slides as $slide)
                                <div class="item">
                                    <a href="{{$slide->link}}">
                                        <div class="image-cover" style="background-image: url('img/slide/{{$slide->s_img}}')">
                                            <div class="overlayText">
                                                <h1 style="word-wrap: break-word;">
                                                    <a href="{{$slide->link}}">
                                                        {{$slide->s_title}}
                                                    </a>
                                                </h1>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    {{--end new slider--}}
                </div>
                <div class="col-md-5">
                    <div class="most-read-item">
                        <div class="row">
                            @foreach($slide_contents as $slide_content)
                                <div class="col-xs-6 col-sm-6 col-md-6 feature-item">
                                    <a href="page/{{$slide_content->cat_id}}/{{$slide_content->id}}">
                                        <div class="news-thumnail" style="background-image: url('img/thumbs/{{$slide_content->media}}')">
                                            <div class="hovereffect">
                                                <div class="overlay">
                                                    <h2>{{$slide_content->text_title}}</h2>
                                                    <a class="info" href="page/{{$slide_content->cat_id}}/{{$slide_content->id}}">អានបន្ត</a>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="item-space">
                                        <!--date-->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="home">
        <div class="container">
            <div class="page-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="latest-news">

                            <div class="row">
                                @if(count($catTitles))
                                    @for($i=0;$i<count($catTitles);$i++)
                                        <div  class="col-md-6 col-sm-6">
                                            <div class="news-cat-item">
                                                <a href="page/{{$catTitles[$i]->c_id}}"  class="btn btn-default btn-sm">
                                                    <span class="cat-title-hover" style="position: absolute;">{{$catTitles[$i]->c_title}}</span>
                                                    <span style="position: absolute;right: 4%;transform: translateY(10%);padding: 5px 0px;" class="glyphicon glyphicon-chevron-right right-arrow"></span>
                                                    <span class="fill"></span>
                                                </a>
                                            </div>
                                            <?php $j=0; ?>
                                            @foreach($allNews[$catTitles[$i]->c_id] as $allNew)
                                                @if($j==0)
                                                    <div class="row">
                                                        <div  class="col-md-12 col-sm-12 zoom-thumbnail">
                                                            <div class="larg-lastet-thumnail">
                                                                <div class="img-larg-thumnail">
                                                                    <a href="page/{{$catTitles[$i]->c_id}}/{{@$allNew->id}}">
                                                                        <img src="img/thumbs/{{@$allNew->media}}"/>
                                                                    </a>
                                                                </div>
                                                                <div class="date-release">
                                                                    <i class="fa fa-calendar" aria-hidden="true"></i> <span>{{time_elapsed_string(@$allNew->publish_date)}}</span>
                                                                </div>
                                                                <h1 class="box dot1">
                                                                    <a href="page/{{$catTitles[$i]->c_id}}/{{@$allNew->id}}">
                                                                        {{@$allNew->text_title}}
                                                                    </a>
                                                                </h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div  class="col-md-12 col-sm-12 zoom-thumbnail ">
                                                            <div class="news-thumnail">
                                                                <div class="news-img-thumbs">
                                                                    <a href="page/{{$catTitles[$i]->c_id}}/{{@$allNew->id}}">
                                                                        <img src="img/thumbs/{{@$allNew->media}}"/>
                                                                    </a>
                                                                </div>
                                                                <div class="news-title">
                                                                    <div class="date-release">
                                                                        <i class="fa fa-calendar" aria-hidden="true"></i> <span>{{time_elapsed_string(@$allNew->publish_date)}}</span>
                                                                    </div>
                                                                    <h1 class="box dot1">
                                                                        <a href="page/{{$catTitles[$i]->c_id}}/{{@$allNew->id}}">
                                                                            {{@$allNew->text_title}}
                                                                        </a>
                                                                    </h1>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <?php $j++ ?>
                                            @endforeach
                                            <div style="text-align:right; margin:0 0 20px 0; font-family: 'Nokora', serif; font-size: 14px;">
                                                <a href="page/{{$catTitles[$i]->c_id}}"  class="btn btn-primary">មើល{{$catTitles[$i]->c_title}}បន្ថែមទៀត</a>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            </div>

                        </div>
                    </div>
                    @include ('frontend.side_bar')
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{URL::asset('js/owl.carousel.min.js')}}"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            navText: [ "<span class='glyphicon glyphicon-chevron-left'></span>", "<span class='glyphicon glyphicon-chevron-right'></span>" ],
            loop:true,
            margin:10,
            nav:true,
            items : 1,
            autoplay: true
        });
    </script>
@endsection
