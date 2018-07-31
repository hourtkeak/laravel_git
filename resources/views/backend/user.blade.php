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
                            <h4 class="title pull-left">User</h4>
                            <a href="{{route('backend.user.add')}}" class="btn btn-primary btn-fill pull-right"><i class="pe-7s-plus"></i> Add user</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Role</th>

                                    <th>Created Date</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->level==1)
                                                    <span class="label label-success">Admin</span>
                                                @else
                                                    <span class="label label-warning">User</span>
                                                @endif
                                            </td>
                                            <td>{{date('d/M/Y',strtotime($user->created_at))}}</td>
                                            <td>
                                                <div class="col-xs-6">

                                                    <a href="{{route('backend.user.edit',$user->id)}}" rel="tooltip" data-original-title="Edit user" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                                                </div>

                                                <div class="col-xs-6">

                                                    <a href="{{route('backend.user.delete',$user->id)}}" rel="tooltip" data-original-title="Delete user" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
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