@extends('backend.master')
@section('style')
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title pull-left">@if(isset($menu)) Edit Menu @else Create Menu @endif</h4><br/>
                            <hr/>
                        </div>
                        <div class="content">
                            @if(isset($menu))
                                <form method="POST" action="{{ route('backend.menu.edit',$menu->c_id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" value="{{old('title',$menu->c_title)}}" placeholder="Title" name="title" required>
                                        @if ($errors->has('title'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Ordering</label>
                                        <input type="number" class="form-control" value="{{old('ordering',$menu->ordering)}}" placeholder="Ordering" name="ordering" required>
                                        @if ($errors->has('ordering'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('ordering') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Display</label>
                                        <div class="checkbox">
                                            <input id="checkbox4" value="1" name="display" type="checkbox" @if($menu->c_is_show==1)checked @endif>
                                            <label for="checkbox4">Check to display | Uncheck to hide</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('backend.menu.store') }}">
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
                                        <label>Ordering</label>
                                        <input type="number" class="form-control" value="{{old('ordering')}}" placeholder="Ordering" name="ordering" required>
                                        @if ($errors->has('ordering'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('ordering') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Display</label>
                                        <div class="checkbox">
                                            <input id="checkbox4" value="1" name="display" type="checkbox" checked>
                                            <label for="checkbox4">Check to display | Uncheck to hide</label>
                                        </div>
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

@endsection