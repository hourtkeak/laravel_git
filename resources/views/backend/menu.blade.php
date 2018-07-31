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
                            <h4 class="title pull-left">Menu</h4>
                            <a href="{{route('backend.menu.add')}}" class="btn btn-primary btn-fill pull-right"><i class="pe-7s-plus"></i> Add menu</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>

                                    <th>Title</th>

                                    <th>Is_display</th>

                                    <th>Ordering</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($MENUS))
                                    @foreach($MENUS as $menu)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$menu->c_title}}</td>
                                            <td>
                                                @if($menu->c_is_show==1)
                                                    <span class="label label-success">Yes</span>
                                                @else
                                                    <span class="label label-danger">No</span>
                                                @endif
                                            </td>
                                            <td>{{$menu->ordering}}</td>
                                            <td>
                                                <div class="col-xs-6">

                                                    <a href="{{route('backend.menu.edit',$menu->c_id)}}" rel="tooltip" data-original-title="Edit menu" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                                                </div>

                                                <div class="col-xs-6">

                                                    <a href="{{route('backend.menu.delete',$menu->c_id)}}" rel="tooltip" data-original-title="Delete menu" class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

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
                icon: 'pe-7s-menu',
                message: "{{Session::get('success')}}"

            },{
                type: 'success',
                timer: 4000
            });
            @endif
        });
    </script>
@endsection