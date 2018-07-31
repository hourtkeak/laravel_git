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
                            <h4 class="title pull-left">Articles</h4>
                            <form id="custom-search-form" action="{{route('backend.search')}}" method="GET" class="form-search form-horizontal pull-left">
                                <div class="input-append span12">
                                    <input type="text" class="search-query" name="keyword" value="{{old('keyword',@$keyword)}}" style="width: 400px" required placeholder="Search article">
                                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                            <a href="{{route('backend.content.add')}}" class="btn btn-primary btn-fill pull-right"><i class="pe-7s-plus"></i> Add new</a>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>

                                        <th>Image</th>

                                        <th>Title</th>

                                        <th>Category</th>

                                        <th>Views</th>

                                        <th>Publish Date</th>

                                        <th>Author</th>

                                        <th>Share</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($contents))
                                        <?php $count = 1; ?>
                                        @foreach($contents as $content)
                                            <tr>
                                                <td>{{$contents ->perPage()*($contents->currentPage()-1)+$count}}</td>
                                                <td>
                                                    <img src="{{URL('img/thumbs',$content->media)}}" width="100px">
                                                </td>
                                                <td>{{$content->text_title}}</td>
                                                <td>{{@$content->getMenu->c_title}}</td>
                                                <td>{{$content->count}}</td>
                                                <td>{{date('d-m-Y h:i A', strtotime($content->publish_date))}}</td>
                                                <td>{{@$content->getAuthor->name}}</td>
                                                <td>
                                                    <a class="btn btn-primary" href="#" target="_target"  onClick="window.open('https://www.facebook.com/sharer/sharer.php?u={{URL('/')}}/page/{{$content->getMenu->c_id}}/{{$content->id}}','popup','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=250,height=350'); return false;">
                                                        <i class="fa fa-facebook"></i> Share to Facebook
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="col-xs-6">

                                                        <a href="{{route('backend.content.edit',$content->id)}}" rel="tooltip" data-original-title="Edit Article" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                                                    </div>

                                                    <div class="col-xs-6">

                                                        <a data-href="{{route('backend.content.delete',$content->id)}}" href="#" rel="tooltip" data-original-title="Delete Article" data-toggle="modal" data-target="#confirm-delete" class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $count++; ?>
                                        @endforeach
                                    @elseif(isset($result))
                                        <?php $count = 1; ?>
                                        @foreach($result as $res)
                                            <tr>
                                                <td>{{$result ->perPage()*($result->currentPage()-1)+$count}}</td>
                                                <td>
                                                    <img src="{{URL('img/thumbs',$res->media)}}" width="100px">
                                                </td>
                                                <td>{{$res->text_title}}</td>
                                                <td>{{@$res->getMenu->c_title}}</td>
                                                <td>{{$res->count}}</td>
                                                <td>{{date('d-m-Y h:i A', strtotime($res->publish_date))}}</td>
                                                <td>{{@$res->getAuthor->name}}</td>
                                                <td>
                                                    <div class="col-xs-6">

                                                        <a href="{{route('backend.content.edit',$res->id)}}" rel="tooltip" data-original-title="Edit Article" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>

                                                    </div>

                                                    <div class="col-xs-6">

                                                        <a data-href="{{route('backend.content.delete',$res->id)}}" href="#" rel="tooltip" data-original-title="Delete Article" data-toggle="modal" data-target="#confirm-delete" class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>

                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $count++; ?>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div>
                                @if(isset($contents))
                                    <div>Showing {{($contents->currentpage()-1)*$contents->perpage()+1}} to {{($contents->currentpage()-1) * $contents->perpage() + $contents->count()}}
                                        of  {{$contents->total()}} entries
                                    </div>
                                @elseif(isset($result))
                                    <div>Showing {{($result->currentpage()-1)*$result->perpage()+1}} to {{($result->currentpage()-1) * $result->perpage() + $result->count()}}
                                        of  {{$result->total()}} entries
                                    </div>
                                @endif

                            </div>
                            <div class="pull-right">
                                @if(isset($contents))
                                    {{$contents->links()}}
                                @elseif(isset($result))
                                    {!! $result->appends(\Illuminate\Support\Facades\Input::except('page'))->links() !!}
                                @endif
                            </div>
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
                icon: 'pe-7s-news-paper',
                message: "{{Session::get('success')}}"

            },{
                type: 'success',
                timer: 4000
            });
            @endif
        });
    </script>
@endsection