@extends('backend.master')
@section('style')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="header">
                            <h4 class="title pull-left">@if(isset($menu)) Edit Menu @else Create Menu @endif</h4><br/>
                            <hr/>
                        </div>
                        <div class="content">
                            @if(isset($tag))
                                <form method="POST" action="{{ route('backend.tag.edit',$tag->tag_id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{old('title',$tag->name)}}" placeholder="Title" name="title" required>
                                        @if ($errors->has('title'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('backend.tag.store') }}">
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
                                    <button type="submit" class="btn btn-info btn-fill">Create</button>
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

@endsection