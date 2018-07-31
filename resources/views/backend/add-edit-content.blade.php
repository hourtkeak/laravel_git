@extends('backend.master')
@section('style')
    <link href="{{url('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/summernote/css/summernote.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('datepicker/css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/tag/bootstrap-tagsinput.css')}}">
    <style>
        .modal-content{
            z-index: 9999;
        }
        .modal-backdrop{
            z-index: 1 !important;
        }
        #sn-checkbox-open-in-new-window{
            opacity: 1 !important;
            margin-left: -22px;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title pull-left">@if(isset($content)) Edit Article @else Create Article @endif</h4><br/>
                            <hr/>
                        </div>
                        <div class="content">
                            @if(isset($content))
                                <form method="POST" action="{{ route('backend.content.update',$content->id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Choose Category</label>
                                        <select name="cat_id" class="form-control" required>
                                            <option value="">-- Please Select --</option>
                                            @foreach($MENUS as $menu)
                                                <option value="{{$menu->c_id}}" @if($menu->c_id === $content->cat_id) selected @endif>{{$menu->c_title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cat_id'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('cat_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" required value="{{old('title',$content->text_title)}}" placeholder="Title" name="title">
                                        @if ($errors->has('title'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="short_desc" required>{{old('short_desc',$content->description)}}</textarea>
                                        @if ($errors->has('short_desc'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('short_desc') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="summernote form-control" name="contents" required>{{old('contents',$content->full_text)}}</textarea>
                                        @if ($errors->has('contents'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('contents') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    @if($content->media)
                                    <div class="form-group">
                                        <label>Current Thumbnail</label>
                                        <img src="{{URL('img/thumbs',$content->media)}}" class="img-responsive" />
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label>Change Thumbnail</label>
                                        <input type="file" name="photo" id="uploadPhoto" class="file-uploading" accept="image/*">
                                        @if ($errors->has('photo'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Feature Article</label>
                                        <div class="checkbox">
                                            <input id="checkbox4" value="1" name="feature" type="checkbox" @if($content->feature==1) checked @endif>
                                            <label for="checkbox4">Check to set</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Publish</label>
                                        <div class="checkbox">
                                            <input id="checkbox1" value="1" name="publish" type="checkbox" @if($content->display==1) checked @endif>
                                            <label for="checkbox1">Check to publish | Uncheck for draft</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Publish date</label>
                                        <input type='text' name="publish_date" value="{{date('m/d/Y h:i A',strtotime($content->publish_date))}}" class="form-control" id='datetimepicker' />
                                        @if ($errors->has('publish_date'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('publish_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Tag</label> <span>(Click Enter to separate your tag)</span>
                                        <input type="text" name="tag" class="form-control" value="{{@$content->tagList}}" />
                                        @if ($errors->has('tag'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('tag') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('backend.content.store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Choose Category</label>
                                        <select name="cat_id" class="form-control" required>
                                            <option value="">-- Please Select --</option>
                                            @foreach($MENUS as $menu)
                                                <option value="{{$menu->c_id}}">{{$menu->c_title}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('cat_id'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('cat_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{old('title')}}" required placeholder="Title" name="title">
                                        @if ($errors->has('title'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea class="form-control" name="short_desc" required>{{old('short_desc')}}</textarea>
                                        @if ($errors->has('short_desc'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('short_desc') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="summernote form-control" name="contents" required>{{old('contents')}}</textarea>
                                        @if ($errors->has('contents'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('contents') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Upload Thumbnail</label>
                                        <input type="file" name="photo" id="uploadPhoto" required class="file-uploading" accept="image/*">
                                        @if ($errors->has('photo'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Feature Article</label>
                                        <div class="checkbox">
                                            <input id="checkbox4" value="1" name="feature" type="checkbox" checked>
                                            <label for="checkbox4">Check to set</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Publish</label>
                                        <div class="checkbox">
                                            <input id="checkbox1" value="1" name="publish" type="checkbox" checked>
                                            <label for="checkbox1">Check to publish | Uncheck for draft</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Publish date</label>
                                        <input type='text' name="publish_date" required class="form-control" id='datetimepicker' />
                                        @if ($errors->has('publish_date'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('publish_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Tag</label> <span>(Click Enter to separate your tag)</span>
                                        <input type="text" class="form-control" name="tag" data-role="tagsinput" />
                                        {{--<input type="text" name="tag" class="form-control" required placeholder="sport,technology,ronaldo" />--}}
                                        @if ($errors->has('tag'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('tag') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Create</button>
                                    <div class="clearfix"></div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('datepicker/moment.min.js')}}"></script>
    {{--<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>--}}
    <script src="{{asset('css/summernote/js/summernote.js')}}"></script>
    <script src="{{asset('/js/summernote_clean.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/summernote-image-title.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/fileinput.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('datepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();
            //Date picker
            $('#datetimepicker').datetimepicker();

            $("#uploadPhoto").fileinput({

                showUpload: false,

                layoutTemplates: {

                    main1: "{preview}\n" +

                    "<div class=\'input-group {class}\'>\n" +

                    "   <div class=\'input-group-btn\'>\n" +

                    "       {browse}\n" +

                    "       {upload}\n" +

                    "       {remove}\n" +

                    "   </div>\n" +

                    "   {caption}\n" +

                    "</div>"

                }

            });

            $('.summernote').summernote({
                imageTitle: {
                    specificAltField: true,
                },
                height:500,

                cleaner:{

                    notTime: 2400, // Time to display Notifications.

                    action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.

                    newline: '<br>', // Summernote's default is to use '<p><br></p>'

                    notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification

                    icon: '<i class="note-icon">[Your Button]</i>',

                    keepHtml: false, // Remove all Html formats

                    keepClasses: false, // Remove Classes

                    badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents

                    badAttributes: ['style', 'start'] // Remove attributes from remaining tags

                },
                popover: {
                    image: [
                        ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']],
                        ['custom', ['imageTitle']],
                    ],
                },


            });
        });


    </script>
    <script src="{{asset('js/typeahead.bundle.js')}}"></script>
    <script src="{{asset('assets/tag/bootstrap-tagsinput.js')}}"></script>
    {{--Tag input--}}
    <script>
        function getTag() {
            var element = [];
            var data = [
            @foreach($tagArray as $tag)
                "{!! $tag !!}",
            @endforeach
            ];

            for(var i = 0 ; i < data.length; i++) {
                element.push({"name":data[i]});
            }
            return element;
        }
        const toto = getTag();
        var citynames = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: toto
        });
        citynames.initialize();

        $('input[name="tag"]').tagsinput({
            typeaheadjs: {
                name: 'citynames',
                displayKey: 'name',
                valueKey: 'name',
                source: citynames.ttAdapter()
            }
        });
    </script>

@endsection
