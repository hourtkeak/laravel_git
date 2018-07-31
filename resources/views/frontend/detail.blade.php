@extends('frontend.master')
@section('title',$content->text_title)
@section('meta')
    {{--for facebook share--}}
    <meta property="og:url"           content="{{URL::current()}}" />
    <meta property="og:type"          content="http://www.keiladaily/" />
    <meta property="og:title"         content="{{$content->text_title}}" />
    <meta property="og:description"   content="{{$content->description}}" />
    <meta property="og:image"         content="{{URL('/img/uploads',$content->media)}}"/>
    <meta name="description" content="{{$content->description}}">
    {{--for SEO--}}
    <meta name="keyword" content="Hot news, politics, business, education, entertainment, sports, scholarship, online course, stars, celebrities, football, lifestyle in Cambodia">
    <meta property="og:image:width" content="640" />
    <meta property="og:image:height" content="442" />
@endsection
@section('style')
    <style>
        .detail_paragraph iframe,.detail_paragraph img{
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <section id="subpage">
        <div class="container">
            <div class="box-detail">
                <div class="subpage-body">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="detail_news_section">

                                <div id="page-detail-bar" class="sub-page-bar-news">
                                    {{--<h1>{{@$content->getMenu->c_title}}</h1>--}}
                                </div>
                                <div class="detail_new-title">
                                    <h1>{{$content->text_title}}</h1>
                                </div>

                                <div class="more_info">
                                    <span id="datetimeKhmer"></span>
                                </div>

                                <div class="detail_paragraph">
                                    <p>
                                        សូមប្រិយមិត្តជួយ Subscribe ឆានែលយូធូបរបស់យើងខ្ញុំផង៖ &nbsp;
                                        <a href="https://www.youtube.com/channel/UCMAft9pvnU3BlnD-SVICrRg" target="_blank">
                                            <img style="margin-bottom: -5px; width: auto !important;" src="//lh3.googleusercontent.com/EJ4ZaRm_FMl66vgen29D6bdiGvlE0WOhLHH0Up7SxdBhdnL_rb0p5UxkT_6lBhE=w90" width="90" height="26" alt="Subscribe" title="Subscribe">
                                        </a>
                                    </p>
                                    {!! $content->full_text !!}

                                    <div class="tag-content">
                                        @if(count($content->tagArray) > 0)
                                            <div class="tag-title">ពាក្យទាក់ទង៖</div>
                                                <div>
                                                    @foreach($content->tagArray as $tag)
                                                        <a class="tag" href="{{url('tag',str_replace(' ', '-', $tag))}}">{{$tag}}</a>
                                                    @endforeach
                                                </div>
                                        @endif
                                    </div>
                                    {{--facebook comment and like plugin--}}

                                    <div class="social_share">
                                        <div class="col-xs-6" style="padding:0 0 10px 0">
                                            <div class="fb-like" data-href="{{URL::current()}}" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>

                                        </div>
                                        {{--<div class="col-xs-6">--}}
                                            {{--<div class="fb-share-button" data-href="{{URL::current()}}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>--}}
                                        {{--</div>--}}

                                        <div class="col-xs-6 text-right">
                                            <a class="btn btn-primary" href="#" target="_target"  onClick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}','popup','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=250,height=350'); return false;">
                                                <i class="fa fa-facebook"></i> Share to Facebook
                                            </a>
                                        </div>

                                        <div class="col-xs-12">
                                            <div class="comment-bar"> <a href="#fb-comment-article"> <b>Comment</b> </a></div>
                                        </div>

                                        <div style="clear:both"></div>

                                    </div>
                                    <div id="fb-comment-article">

                                        <div class="fb-comments" data-href="{{URL::current()}}" data-numposts="5"></div>
                                    </div>

                                    {{--end facebook like and comment--}}
                                </div>
                            </div>

                            {{--related news--}}
                            <div class="read-other">
                                <div class="latest-news">
                                    <div class="row">
                                        @if(isset($relatedContents))
                                            @foreach($relatedContents as $relatedContent)
                                                <div  class="col-md-6">
                                                    <div class="news-thumnail">

                                                        <div class="news-img-thumbs">
                                                            <a href="{{URL('page',[$relatedContent->getMenu->c_id,$relatedContent->id])}}">
                                                                <img src="{{URL('/img/thumbs',$relatedContent->media)}}"/>
                                                            </a>
                                                        </div>
                                                        <div class="news-title">
                                                            <div class="date-release">
                                                                <i class="fa fa-calendar" aria-hidden="true"></i> <span>{{date("d-m-Y h:i A", strtotime($relatedContent->publish_date))}}</span>
                                                            </div>
                                                            <h1 class="box dot1">
                                                                <a href="{{URL('page',[$relatedContent->getMenu->c_id,$relatedContent->id])}}">
                                                                    {{$relatedContent->text_title}}
                                                                </a>
                                                            </h1>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{--end related news--}}

                        </div><!--col-md-8-->

                       @include('frontend.side_bar')

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {

            Date.prototype.getAmPm = function () {
                if (this.getHours() >= 12) {
                    return 1
                }
                ; // pm
                return 0; // am
            }

            var locale = {
                en: {
                    month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September ', 'October', 'November', 'December'],
                    ampm: ['am', 'pm']
                },
                km: {
                    month: ['មករា', 'កុម្ភៈ', 'មីនា', 'មេសា', 'ឧសភា',
                        'មិថុនា', 'កក្កដា', 'សីហា', 'កញ្ញា', 'តុលា', 'វិច្ឆិកា', 'ធ្នូ'],
                    ampm: ['ព្រឹក', 'ល្ងាច']
                }
            };

            var toLocaleNumber = function (num, lang, zeroPadding) {
                if (typeof num !== 'number') return null;

                var numInteger = parseInt(num);
                var numString = numInteger.toString();

                if (zeroPadding > 0 && numString.length < zeroPadding) {
                    numString = '0' + numString;
                }

                // support only khmer
                if (lang !== 'km') {
                    return numString
                }
                ;

                var khmerNumber = '';
                var numbersKhmer = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩'];

                for (var i = 0; i < numString.length; i++) {
                    khmerNumber += numbersKhmer[parseInt(numString[i])];
                }

                return khmerNumber;
            };
            var isMobile = false; //initiate as false
            // device detection
            if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
                || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
            if(isMobile==true){
                var formatDate = function (date, lang) {
                    var formattedDate = null;

                    formattedDate = toLocaleNumber(d.getDate(), lang, 2)
                        + '-'
                        + locale[lang]['month'][d.getMonth()]
                        + '-'
                        + toLocaleNumber(d.getFullYear(), lang)
                        + ' ';

                    return formattedDate;
                };
                var d = new Date("<?php $time=$content->publish_date;$time=strtotime($time); echo $time=date("Y-m-d",$time); ?>");
                $value=(formatDate(d, 'km'));
                $("#datetimeKhmer").html($value);
            }
            else{
                var formatDate = function (date, lang) {
                    var formattedDate = null;
                    var hours = d.getHours();
                    if (hours > 12) {
                        hours -= 12;
                    }
                    ;

                    formattedDate = toLocaleNumber(d.getDate(), lang, 2)
                        + '-'
                        + locale[lang]['month'][d.getMonth()]
                        + '-'
                        + toLocaleNumber(d.getFullYear(), lang)
                        + ' '
                        + toLocaleNumber(hours, lang, 2)
                        + ':'
                        + toLocaleNumber(d.getMinutes(), lang, 2)
                        + ' '
                        + locale[lang]['ampm'][d.getAmPm()];

                    return formattedDate;
                };
                var d = new Date("<?php $time=$content->publish_date;$time=strtotime($time); echo $time=date("Y-m-d H:i",$time); ?>");
                $value=(formatDate(d, 'km'));
                $("#datetimeKhmer").html($value);
            }

        });
    </script>
@endsection

