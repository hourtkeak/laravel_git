@extends('backend.master')
@section('style')
    <style>
        .modal-content{
            z-index: 9999;
        }
        .modal-backdrop{
            z-index: 1 !important;
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
                            <h4 class="title pull-left">Slides</h4>
                            <a href="{{route('backend.slide.add')}}" class="btn btn-primary btn-fill pull-right"><i class="pe-7s-plus"></i> Add slide</a>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>

                                    <th>Image</th>

                                    <th>Title</th>

                                    <th>URL</th>

                                    <th>Ordering</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($slides))
                                    @foreach($slides as $slide)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                <img src="{{URL('img/slide',$slide->s_img)}}" width="100px">
                                            </td>
                                            <td>{{$slide->s_title}}</td>
                                            <td><a href="{{$slide->link}}">{{$slide->link}}</a></td>
                                            <td>{{$slide->ordering}}</td>
                                            <td>
                                                <div class="col-xs-6">

                                                    <a href="{{route('backend.slide.edit',$slide->slide_id)}}" rel="tooltip" data-original-title="Edit Slide" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                                                </div>

                                                <div class="col-xs-6">

                                                    <a data-href="{{route('backend.slide.delete',$slide->slide_id)}}" href="#" rel="tooltip" data-toggle="modal" data-target="#confirm-delete" data-original-title="Delete Slide" class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                    {{--<a data-href="{{route('backend.tag.delete',$tag->tag_id)}}" href="#" rel="tooltip" data-toggle="modal" data-target="#confirm-delete" data-original-title="Delete tag" class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>--}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                                    </div>

                                    <div class="modal-body">
                                        <p>You are about to delete one track, this procedure is irreversible.</p>
                                        <p>Do you want to proceed?</p>
                                        <p class="debug-url"></p>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger btn-ok">Delete</a>
                                    </div>
                                </div>
                            </div>
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
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
            @if(Session::has('success'))
                $.notify({
                icon: 'pe-7s-display2',
                message: "{{Session::get('success')}}"

            },{
                type: 'success',
                timer: 4000
            });
            @endif
        });
    </script>
@endsection