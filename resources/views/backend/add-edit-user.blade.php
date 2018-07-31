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
                            <h4 class="title pull-left">@if(isset($user)) Edit User @else Create User @endif</h4><br/>
                            <hr/>
                        </div>
                        <div class="content">
                            @if(isset($user))
                                <form method="POST" action="{{ route('backend.user.update',$user->id) }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{old('name',$user->name)}}" placeholder="Name" name="name" required>
                                        @if ($errors->has('name'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" value="{{old('email',$user->email)}}" placeholder="Email" name="email" required>
                                        @if ($errors->has('email'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password">
                                        @if ($errors->has('password'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm New Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                    </div>

                                    <div class="form-group">
                                        <label>Choose role</label>
                                        <select name="level" class="form-control">
                                            <option value="1" @if($user->level==1) selected @endif>Admin</option>
                                            <option value="2" @if($user->level==2) selected @endif>User</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                                    <div class="clearfix"></div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{old('name')}}" placeholder="Name" name="name" required>
                                        @if ($errors->has('name'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" value="{{old('email')}}" placeholder="Email" name="email" required>
                                        @if ($errors->has('email'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                        @if ($errors->has('password'))
                                            <span style="color:red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Choose role</label>
                                        <select name="level" class="form-control">
                                            <option value="1">Admin</option>
                                            <option value="2">User</option>
                                        </select>
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