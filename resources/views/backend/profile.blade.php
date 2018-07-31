@extends('backend.master')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Edit Profile</h4>
                    </div>
                    <div class="content">
                        <form method="POST" action="{{ route('backend.user.profile',Auth::user()->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" value="{{old('name',Auth::user()->name)}}" placeholder="Name" name="name" required>
                                @if ($errors->has('name'))
                                    <span style="color:red">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" class="form-control" value="{{old('email',Auth::user()->email)}}" placeholder="Email" name="email" required>
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

                            <button type="submit" class="btn btn-info btn-fill pull-right">Update profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                    </div>
                    <div class="content">
                        <div class="author">
                            <a href="#">
                                <img class="avatar border-gray" src="{{asset('assets/img/faces/face-3.jpg')}}" alt="..."/>

                                <h4 class="title">{{Auth::user()->name}}<br />
                                    <small>Email: {{Auth::user()->email}}</small>
                                </h4>
                            </a>
                        </div>
                        <p class="description text-center">Role: @if(Auth::user()->level==1) ADMIN @else USER @endif</p>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                        <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            @if(Session::has('success'))
                $.notify({
                icon: 'pe-7s-user',
                message: "{{Session::get('success')}}"

            },{
                type: 'success',
                timer: 4000
            });
            @endif
        });
    </script>
@endsection