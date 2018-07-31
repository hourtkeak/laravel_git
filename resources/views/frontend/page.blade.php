@extends('frontend.master')
@section('content')
    <section id="subpage">
        <div class="container">

            <div class="box-subpage">
                <div id="sub-page-bar" class="sub-page-bar-news">
                    <h1>
                        {{ isset($menu->c_title) ? $menu->c_title : ''}}
                        {{ isset($tagName) ? $tagName : ''}}
                        {{ isset($keyword) ? 'ស្វែងរកអត្ថបទ: '.$keyword : ''}}
                    </h1>
                </div>
                <div class="subpage-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="latest-news">
                                <div class="row">
                                    @if(isset($contents) && count($contents))
                                        @foreach($contents as $content)
                                            <div  class="col-md-12">
                                                <div class="news-thumnail-sub">
                                                    <a href="{{URL('page',[@$content->getMenu->c_id,$content->id])}}">
                                                        <div class="news-img-thumbs-sub">
                                                           <figure><img src="{{URL('/img/thumbs',$content->media)}}" /></figure>
                                                        </div>
                                                        <div class="news-title-sub">
                                                            <h1 style="color: #005DAA">{{$content->text_title}}</h1>
                                                            <i class="fa fa-calendar" aria-hidden="true"></i> <span>{{time_elapsed_string($content->publish_date)}}</span>
                                                            <p>
                                                                {{$content->description}}
                                                            </p>
                                                        </div>
                                                    </a>
                                                    <div style="clear:both;"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div  class="col-md-12">
                                            <div class="news-thumnail-sub">
                                                <h1 style="color:black">មិនមានអត្ថបទដែរអ្នករកនោះទេ</h1>
                                            </div>
                                        </div>

                                    @endif
                                </div>
                            </div>
                            <div class="pagging-container">
                                @if(isset($contents))
                                    {{--{{$contents->links()}}--}}
                                    {!! $contents->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
                                @endif
                            </div>
                        </div><!--col-md-8-->

                        @include('frontend.side_bar')

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

