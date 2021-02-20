<div class="slider-area pt-20">
    <div class="container">
        <div class="slider-active-4 owl-carousel dot-style-2">

            @foreach($sliderView as $slider)
            <div class="slider-height-8 bg-img res-white-overly-xs" style="background-image:url({{asset('/').$slider->slider_image}});">

                <div class="row align-items-center">
                    <div class="ml-auto col-lg-9 col-md-12 col-12 col-sm-12">
                        <div class="slider-content-8 slider-animated-1" >
                            <h1 class="animated">{{$slider->slider_title}}</h1>
                            <p class="animated">{!! $slider->slider_description !!}</p>

                            @if($slider->button_name!=null)
                            <div class="slider-btn-8 default-btn btn-hover hover-border-none">
                                <a style="background-color:{{$slider->button_color}}" class="animated black-color" href="{{$slider->button_url}}" target="_blank">{{$slider->button_name}}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
