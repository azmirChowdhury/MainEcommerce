@extends('back_end.index')
@section('title')
    SEO | Meta
@endsection
@section('body')

    <!-- Button trigger modal -->
    @if(Session()->get('massage'))
        <script>
            $(document).ready(function () {
                $("#massage").modal('show');
            });
        </script>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="massage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Work Massage !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(Session::get('massage'))
                        <h5 class="text-success">{{Session::get('massage')}}</h5>
                    @else
                        <h5 class="text-danger">{{Session::get('err')}}</h5>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">ok</button>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> Seo link manage</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Utilities</a></li>
                            <li class="breadcrumb-item active">Seo scripting</li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Seo meta scripting</h4>
                                <button
                                    class="btn btn-success dropdown-toggle float-lg-right float-md-right float-xl-right float-sm-right"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown">Manager
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('add_meta_script')}}">Add script and meta</a>
                                </div>
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#Sr.</th>
                                        <th>Tag</th>
                                        <th>Tag position</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php($i=1)
                                    @foreach($tags as $tag)
                                        <tr>
                                            <td width="10">{{$i++}}</td>
                                            <td>
                                                <?php
                                                switch ($tag->position){
                                                    case 1:echo "Meta tag";
                                                    break;
                                                    case 2:echo "Head";
                                                    break;
                                                    case 3:echo "Body top";
                                                    break;
                                                    case 4:echo "Body bottom";
                                                    break;
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                <textarea class="form-control">{{$tag->tag}}</textarea>
                                            </td>
                                            <td>{{$tag->status==1?'Publish':"Unpublished"}}</td>



                                            <td width="70">
                                                @if($tag->status==0)
                                                    <a href="{{route('tag_publish',['id'=>$tag->id])}}" class="text-success"><i class="fa fa-arrow-circle-up"
                                                                                       title="Published"></i></a>
                                                @else
                                                    <a href="{{route('tag_unpublished',['id'=>$tag->id])}}" class="text-warning"><i class="fa fa-arrow-circle-down" title="Unpublished"></i></a>
                                                @endif
                                                    <a href="{{route('edit_meta',['id'=>$tag->id])}}" class="text-primary"><i class="fa fa-edit" title="Edit"></i></a>
                                                    <a class="text-danger"><i class="fa fa-trash  waves-effect waves-light" data-toggle="modal" data-target="#exampleModalCenter{{$tag->id}}" title="Delete"></i></a>

                                            </td>
                                        </tr>

                                    @endforeach

                                    @foreach($tags as $tag)
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCenter{{$tag->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-danger" id="exampleModalLongTitle">
                                                            Are you sure ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-danger">Delete <strong
                                                                class="text-primary font-18">{{$tag->tag}}</strong>tag?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel
                                                        </button>
                                                        <a href="{{route('tag_delete',['id'=>$tag->id])}}" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div>


        </div>
    </div>
@endsection
