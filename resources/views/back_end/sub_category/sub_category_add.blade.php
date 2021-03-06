@extends('back_end.index')
@section('title')
    Add |Subcategory
@endsection
@section('body')
    <script type="text/javascript">
    $(document).ready(function (){
        $( "#collum" ).prop( "disabled", true );
        $('#parents_category').on('change',function (){
            var id=$('#parents_category').val()
            $.ajax({
                url:'{{$mainUrl}}/dashboard/category/subcategory/blocks/load',
                type:"GET",
                data:'id='+id,
                success:function(data){
                    $( "#collum" ).prop( "disabled", false );
                    $('#collum').html(data);

                }
            })

        })


    })
    </script>



    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add sub-Category</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Add Category category</a></li>
                            <li class="breadcrumb-item active">Add sub Category category</li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
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
                                    <div class="m-b-5">
                                        <a href="{{route('manage_subcategory')}}" type="button" class="font-24"><i
                                                class="fa fa-arrow-circle-left"></i></a>
                                    </div>
                                <h4 class="mt-0 header-title">Add sub Category</h4>
                                {{Form::open(['method'=>'POST','route'=>'sub_category_save'])}}

                                <label class="text-muted">Subcategory Name</label>

                                <input type="text" class="form-control" required maxlength="50" value="{{old('category_name')}}" name="category_name"
                                       id="defaultconfig"/>
                                <div class="m-t-20">
                                    <div class="form-group">
                                        <label>Parents category</label><br>
                                        <select name="parent_category_id" id="parents_category" required class="form-control select2">
                                            <option>----Select category----</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->parents_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="m-t-20">
                                    <div class="form-group">
                                        <label>Select Collum</label><br>
                                        <select name="collum_id" id="collum" required class="form-control select2">
                                            <option> ---- Select collum ---- </option>
                                        </select>
                                    </div>


                                    <div class="m-t-20">
                                        <div class="form-group">
                                            <label>Status</label><br>
                                            <select name="status" class="form-control">
                                                <option value="1" selected>Publish</option>
                                                <option value="0">Unpublished</option>
                                            </select>
                                        </div>


                                        <div class="m-t-10">
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
