@extends('backend.master')
@section('style')
    <link href="{{url('css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title pull-left">@if(isset($slide)) Edit Slide @else Create Slide @endif</h4><br/>
                            <hr/>
                        </div>
                        <div class="content">
                            @if(isset($slide))
                                <form method="POST" action="{{ route('backend.slide.update',$slide->slide_id) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{old('title',$slide->s_title)}}" placeholder="Title" name="title" required>
                                        @if ($errors->has('title'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Link</label>
                                        <input type="url" class="form-control" value="{{old('link',$slide->link)}}" placeholder="Link" name="link" required>
                                        @if ($errors->has('link'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('link') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Ordering</label>
                                        <input type="number" class="form-control" value="{{old('ordering',$slide->ordering)}}" placeholder="Ordering" name="ordering" required>
                                        @if ($errors->has('ordering'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('ordering') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    @if($slide->s_img)
                                        <div class="form-group">
                                            <label>Current image</label>
                                            <img class="img-responsive" src="{{URL('img/slide',$slide->s_img)}}" width="50%" />
                                            <input type="hidden" value="{{$slide->s_img}}" name="oldPhoto">
                                        </div>
                                    @endif
                                    <div class="form-group">

                                        <label>Update Image</label>

                                        <input type="file" name="photo" id="uploadPhoto" class="file-uploading" accept="image/*">

                                        @if ($errors->has('photo'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('photo') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('backend.slide.store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{old('title')}}" placeholder="Title" name="title" required>
                                        @if ($errors->has('title'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Link</label>
                                        <input type="url" class="form-control" value="{{old('link')}}" placeholder="Link" name="link" required>
                                        @if ($errors->has('link'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('link') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Ordering</label>
                                        <input type="number" class="form-control" value="{{old('ordering')}}" placeholder="Ordering" name="ordering" required>
                                        @if ($errors->has('ordering'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('ordering') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">

                                        <label>Upload Image</label>

                                        <input type="file" name="photo" id="uploadPhoto" class="file-uploading" accept="image/*" required>
                                        <span>Recommend size : Width: 752px x Height: 468 px</span>
                                        @if ($errors->has('photo'))
                                            <span style="color:red">
                                                <strong>{{ $errors->first('photo') }}</strong>
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
    <script src="{{url('js/fileinput.js')}}" type="text/javascript"></script>
    <script>
        $(function () {
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
        });
    </script>
@endsection