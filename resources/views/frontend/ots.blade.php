@extends('frontend.master')
@section('content')

    <?php
    $baseUrl = 'https://www.googleapis.com/youtube/v3/';
    // https://developers.google.com/youtube/v3/getting-started
    $apiKey = 'AIzaSyAN5a8beMcfasnL0iwmxEEccs_VojpmE48';
    // If you don't know the channel ID see below(Change channel Name)
    //$username = 'Cambodian Music Chords';
    //$params = ['forUsername'=> $username, 'part'=> 'contentDetails', 'key'=> $apiKey];
    //$url = $baseUrl . 'channels?' . http_build_query($params);
    //$json = json_decode(file_get_contents($url), true);
    //$channelId = $json['items'][0]['id'];
    $channelId = 'UCMAft9pvnU3BlnD-SVICrRg';

    $params = [
        'id' => $channelId,
        'part' => 'contentDetails',
        'key' => $apiKey
    ];
    $url = $baseUrl . 'channels?' . http_build_query($params);
    $json = json_decode(file_get_contents($url), true);

    $playlist = $json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

    $params = [
        'part' => 'snippet',
        'playlistId' => $playlist,
        'maxResults' => '14',
        'key' => $apiKey,
        'order' => "date"

    ];
    $url = $baseUrl . 'playlistItems?' . http_build_query($params);
    $json = json_decode(file_get_contents($url), true);

    $videos = [];
    foreach ($json['items'] as $video)
        $videos[] = $video['snippet']['resourceId']['videoId'];
    /*
    while(isset($json['nextPageToken'])){
        $nextUrl = $url . '&pageToken=' . $json['nextPageToken'];
        $json = json_decode(file_get_contents($nextUrl), true);
        $videos[] = $video['snippet']['resourceId']['videoId'];
    }
    */
    ?>

    <section id="subpage">
        <div class="container">

            <div class="box-subpage">
                <div id="sub-page-bar" class="sub-page-bar-news">
                    <h1>
                        ទូរទស្សន៍កីឡាអនឡាញ
                    </h1>
                </div>
                <div class="subpage-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="latest-news">
                                <div class="row">
                                    <br>
                                    <div class="col-md-4 col-sm-12">
                                        <a href="https://www.youtube.com/channel/UCMAft9pvnU3BlnD-SVICrRg" target="_blank" class="btn btn-block btn-lg btn-warning">
                                            <i class="fa fa-video-camera"></i> ព័ត៌មានជាវីដេអូ
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <a href="#" target="_blank" class="btn btn-block btn-lg btn-success">
                                            <i class="fa fa-youtube-play"></i> ផ្សាយផ្ទាល់កន្លងមក
                                        </a>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <a href="http://onlinesportstv.asia/live" target="_blank" class="btn btn-block btn-lg btn-danger">
                                            <i class="fa fa-bullhorn"></i> ផ្សាយផ្ទាល់(LIVE)
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <br/>
                                    @foreach($videos as $vid)
                                    <div class="col-md-6">
                                        <iframe style="margin-bottom: 15px" width="100%" height="220" src="https://www.youtube.com/embed/{{$vid}}?rel=0&amp;controls=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!--col-md-8-->

                        @include('frontend.side_bar')

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

