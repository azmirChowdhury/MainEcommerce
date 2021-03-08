@extends('front_end.index')
@section('front_title')
     {{$page_details->page_name}} | at {{env('app_name')}}
@endsection

@section('mates')

    <meta name="og:title" content="{{$page_details->page_name}}"/>

@endsection

@section('home_body')

    @foreach($BannersShow as $banner_page)

        @if($banner_page->banner_role==6)
            <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$banner_page->banner_image}});">
                <div class="container">
                    <div class="breadcrumb-content text-center">
                        <h2>{!! $banner_page->banner_name !!}</h2>
                        <ul>
                            <li>
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="active">Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif

    @endforeach



    <div class="about-us-area pt-90 pb-90">
        <div class="container">
            <div class="row">
                {!! $page_details->description !!}
            </div>
        </div>
    </div>





    <style>#product_menus{display: none;}</style>
    @endsection
