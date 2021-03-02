@extends('back_end.index')
@section('title')
    E-mail
@endsection
@section('body')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Email</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Email</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Send mail</a></li>
                        </ol>

                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <!-- end row -->
                <div class="row">
                    <div class="col-12">

                        <div class="email mb-3">

                            <div class="card">
                                <div class="form-group">
                                    @if(Session::get('massage'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <strong>Good! </strong>{{Session::get('massage')}}.
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">

                                    {{Form::open(['method'=>'post','route'=>'send_mail'])}}
                                    @if($errors->any())
                                        <ol class="text-danger">
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ol>
                                    @endif
                                    <div class="form-group">
                                        <input type="email"
                                               value="{{old('to_mail')?old('to_mail'):''}}{{old('to_mail')==false&&isset($email)?$email:''}}"
                                               name="to_mail" class="form-control" placeholder="To">
                                        <input type="hidden" value="{{isset($email)?$id:'mail'}}" name="type">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="subject" value="{{old('subject')}}"
                                               class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                <textarea name="description" class="summernote" id="editor">
                        {{old('description')}}
                </textarea>
                                    </div>

                                    <div class="btn-toolbar form-group mb-0">
                                        <div class="">
                                            {{--                    <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="far fa-save"></i></button>--}}
                                            {{--                    <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="far fa-trash-alt"></i></button>--}}
                                            <button class="btn btn-primary waves-effect waves-light"><span>Send</span>
                                                <i class="fab fa-telegram-plane m-l-10"></i></button>
                                        </div>
                                    </div>

                                    {{Form::close()}}

                                </div>


                            </div> <!-- card -->

                        </div> <!-- end Col-9 -->

                    </div>

                </div><!-- End row -->

            </div>
@endsection
