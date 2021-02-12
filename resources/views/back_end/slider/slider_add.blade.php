@extends('back_end.index')
@section('title')
    Add | Slider
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add new Slider</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Appearance</a></li>
                            <li class="breadcrumb-item active">Add new slider</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card m-b-20">

                            <div class="card-body">
                                @if(Session::get('massage'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Good! </strong>{{Session::get('massage')}}.
                                    </div>
                                @endif
                                <div class="m-b-5">
                                    <a href="{{route('slider_index')}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
                                </div>
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <strong>Something wrong! </strong>
                                        <ol>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach

                                        </ol>
                                    </div>
                                @endif
                                {{Form::open(['method'=>'post','enctype'=>'multipart/form-data','route'=>'save_slider'])}}

                                <h4 class="mt-0 header-title">Add new slider</h4>
                                <div class="form-group">
                                    <label>Slider title<sup class="text-danger"> *</sup></label>
                                    <input type="text" name="slider_title" value="{{old('slider_title')}}" autocomplete="off" class="form-control"  placeholder="Slider title"/>
                                </div>


                                <div class="form-group">
                                    <label>Slider description</label>
                                    <textarea id="editor" name="slider_description">{{old('slider_description')}}</textarea>
                                </div>
                                    <div class="form-group">
                                    <label>Slider image</label>
                                    <input type="file" name="slider_image" class="filestyle" data-buttonname="btn-primary" accept="image/*">
                                        <p>slider image width must be 1170px height 569px</p>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" onclick="myFunction()" id="check_box">
                                        <label for="add button" title="if you add button in slider click the checkbox">    Add button ? </label>
                                    </div>

                                    <div class="form-group" id="slider_button_content">
                                    <label>Button name</label>
                                    <input type="text"  name="button_name" value="{{old('button_name')}}" placeholder="Enter button name" class="form-control" >
                                        <br>
                                        <label>Color name /# code</label>
                                        <input type="text" name="color_name" value="{{old('color_name')}}" class="form-control" placeholder="color name or color code ">
                                        <br>
                                        <label>Button URL/Link</label>
                                        <input type="text"  name="button_url" value="{{old('button_url')}}" placeholder="Enter button URl" class="form-control" >
                                        <br>
                                    </div>

                            </div>

                        </div>



                    </div> <!-- end col -->



                    <div class="col-lg-4">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <h4 class="mt-0 header-title">Publish</h4>

                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <select  name="status" class="form-control">
                                            <option value="1" >Publish</option>
                                            <option value="0" >Unpublished</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>




                        <div class="card m-b-20 col-lg-10">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="form-group m-b-0 d-flex ">
                                            <a href="{{route('slider_index')}}" type="reset" class="btn btn-secondary waves-effect m-l-30 ">
                                                Cancel
                                            </a>
                                            <input type="submit" class="btn btn-primary waves-effect m-l-10" value="save">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                {{Form::close()}}

            </div>

            <!-- end page content-->
        </div> <!-- container-fluid -->

    </div>
<script type="text/javascript">

    function myFunction() {
        var checkBox = document.getElementById("check_box");
        var content = document.getElementById("slider_button_content");
        if (checkBox.checked == true){
            content.style.display = "block";
        } else {
            content.style.display = "none";
        }
    }

</script>

@endsection
