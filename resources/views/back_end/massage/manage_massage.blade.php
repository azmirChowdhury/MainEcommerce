@extends('back_end.index')
@section('title')
    Message | {{env('app_name')}}
@endsection
@section('body')
    @if(Session()->get('massage')||Session::get('err'))
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
                    @elseif(Session::get('err'))
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
                        <h4 class="page-title">Message</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Message</a></li>
                            <li class="breadcrumb-item active">Message inbox</li>
                        </ol>

                    </div>
                </div>
            </div>



            <div class="page-content-wrapper">
                <!-- end row -->
                <div class="row">
                    <div class="col-12 col">
                        <!-- Left sidebar -->

                        <!-- End Left sidebar -->


                        <!-- Right Sidebar -->
                        <div class=" mb-3">

                            <div class="card">
                                <div class="btn-toolbar p-3" role="toolbar">
                                    <div class="btn-group mo-mb-2">
{{--                                       <button type="button" onclick="document.getElementById('marked_delete').submit()" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>--}}
                                       <button data-toggle="modal"
                                               data-target="#delete_message_popup"  class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>

                                    </div>


                                </div>

                                <ul class="message-list">
                                    {{Form::open(['method'=>'post','id'=>'marked_delete','route'=>'delete_message'])}}
                                    @foreach($messages as $message)
                                    <li class="{{$message->status==0?'unread':''}}">
                                        <div class="col-mail col-mail-1">
                                            <div class="checkbox-wrapper-mail">
                                                <input type="checkbox" name="Select_message[]" value="{{$message->id}}" id="chk{{$message->id}}">
                                                <label for="chk{{$message->id}}" class="toggle"></label>
                                            </div>
                                            <a href="{{route('full_view_message',['name'=>str_replace(' ','-',$message->name),'id'=>$message->id])}}" class="title">{{$message->name}}</a>
                                        </div>
                                        <div class="col-mail col-mail-2">
                                            <a href="{{route('full_view_message',['name'=>str_replace(' ','-',$message->name),'id'=>$message->id])}}" class="subject">{!!$message->status==0?"<span class='badge-success badge mr-2'>New</span>":'' !!}{!!$message->status==2?"<span class='badge-info badge mr-2'>replied</span>":'' !!} <span class="teaser">{{$message->subject}}</span>
                                            </a>
                                            <div class="date">{{$message->created_at->month}}/{{$message->created_at->day}}/{{$message->created_at->year}}</div>
                                        </div>
                                    </li>
                                    @endforeach
                                {{Form::close()}}

                                </ul>
                            </div> <!-- card -->


                        </div> <!-- end Col-9 -->

                    </div>

                </div><!-- End row -->

            </div>


        </div>
    </div>


    <div class="modal fade" id="delete_message_popup"
         tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
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
                    <p>Delete Message ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Cancel
                    </button>
                    <a href="#" onclick="event.preventDefault();document.getElementById('marked_delete').submit()" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

@endsection
