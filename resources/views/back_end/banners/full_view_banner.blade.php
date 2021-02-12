@extends('back_end.index')
@section('title')
    Banner | Details
@endsection
@section('body')


    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Banner details</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Appearance</a></li>
                            <li class="breadcrumb-item active">Banner</li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="page-content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-20">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <div class="m-b-5">
                                            <a href="{{route('banners_manage')}}" type="button" class="font-24"><i class="fa fa-arrow-circle-left"></i></a>
                                        </div>
                                        <tr class="">
                                            <td align="center">
                                                <img class="border-info"  src="{{asset('/').$banner->banner_image}}" alt="banner image" >
                                                <h3 class="text-center"></h3>
                                            </td>
                                        </tr>

                                    </table>
                                </div>


                                <div class="row" id="table-head">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title text-success">Banner Information</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="table-responsive">
                                                    <table class="table mb-0">
                                                        @if($category==null)
                                                        <tr>
                                                            <th>For banner :</th>
                                                            <td>
                                                                <?php
                                                                switch ($banner->banner_role){
                                                                    case 1:echo "After slider";
                                                                        break;
                                                                    case 2:echo"After featured product";
                                                                        break;
                                                                    case 3:echo"Customer banner";
                                                                        break;
                                                                    case 4:echo"Shop banner";
                                                                        break;
                                                                    case 5:echo"Contact page banner";
                                                                        break;
                                                                    case 6:echo"About us banner";

                                                                }

                                                                ?>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if($category!=null)
                                                        <tr>
                                                            <th> For category :</th>
                                                            <td>{{$category->category_name}}</td>
                                                        </tr>
                                                        @endif



                                                        <tr>
                                                            <th>Publication status :</th>
                                                            @if($banner->status==1)
                                                                <td style="color:green;font-weight: bold;">Published</td>
                                                            @else
                                                                <td style="color:red;font-weight: bold;">Unpublished</td>
                                                            @endif
                                                        </tr>


                                                    </table>
                                                </div>
                                            </div>
                                        </div>
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

