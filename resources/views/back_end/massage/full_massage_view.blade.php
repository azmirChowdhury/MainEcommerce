@extends('back_end.index')
@section('title')
    {{$message->name}} | {{env('app_name')}}
@endsection
@section('body')

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
                        <h4 class="page-title">Message</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Message</a></li>
                            <li class="breadcrumb-item active">Read message</li>
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
                                <div class=" p-3" role="toolbar">
                                    <div class="btn-group mo-mb-2">
                                        <a  href="{{route('inbox_massage')}}" class="btn btn-primary waves-light waves-effect"><i class="fa fa-arrow-circle-left"></i></a>
                                    </div>

                                    <div class="card-body">

                                        <div class="media m-b-30">
                                            <img class="d-flex mr-3 rounded-circle thumb-md" src="https://ui-avatars.com/api/?name={{$message->name}}&color=7F9CF5&background=000000" alt="image">
                                            <div class="media-body">
                                                <h4 class="font-14 m-0">{{$message->name}}</h4>
                                                <small class="text-muted">{{$message->email}}</small>
                                            </div>
                                        </div>

                                        <h4 class="mt-0 font-16">{{$message->subject}}</h4>

                                        {!! $message->massage !!}
                                        <hr/>

                                        <div class="row">

                                        </div>

                                        <a href="{{route('message_reply',['email'=>$message->email,'id'=>$message->id])}}" class="btn btn-secondary waves-effect m-t-30"><i class="mdi mdi-reply"></i> Reply</a>
                                    </div>
                                </div> <!-- card -->

                                </div>
                            </div> <!-- card -->


                        </div> <!-- end Col-9 -->

                    </div>

                </div><!-- End row -->

            </div>


        </div>
    </div>

@endsection

