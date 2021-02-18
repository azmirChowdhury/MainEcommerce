@extends('back_end.email.index')
@section('mail_body')

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
                <input type="email" value="{{old('to_mail')}}" name="to_mail" class="form-control" placeholder="To">
            </div>

            <div class="form-group">
                <input type="text" name="subject" value="{{old('subject')}}" class="form-control" placeholder="Subject">
            </div>
            <div class="form-group">
                <textarea name="description"  class="summernote" id="editor">
{{old('description')}}
                </textarea>
            </div>

            <div class="btn-toolbar form-group mb-0">
                <div class="">
{{--                    <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="far fa-save"></i></button>--}}
{{--                    <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i class="far fa-trash-alt"></i></button>--}}
                    <button class="btn btn-primary waves-effect waves-light"> <span>Send</span> <i class="fab fa-telegram-plane m-l-10"></i> </button>
                </div>
            </div>

       {{Form::close()}}

    </div>

{{--    <script>--}}
{{--        CKEDITOR.editorConfig = function( config ) {--}}
{{--            // config.toolbarGroups = [--}}
{{--            // ];--}}
{{--            config.resize_enabled = true;--}}
{{--        };--}}
{{--    </script>--}}
@endsection
