@extends('front_end.index')
@section('front_title')
    Contact Us | at {{env('app_name')}}
@endsection

@section('mates')
    <meta name="og:url" content="{{env('app_url').env('app_name') .'-contacts-us'}}"/>
    <meta name="og:title" content="contact us.at {{env('app_name')}}"/>
    <meta name="og:description" content="Contact us" />
    <script src="https://www.google.com/recaptcha/api.js"></script>
@endsection

@section('home_body')

    @foreach($BannersShow as $banner_contact)

        @if($banner_contact->banner_role==5)
                <div class="breadcrumb-area bg-img" style="background-image:url({{asset('/').$banner_contact->banner_image}});">
                    <div class="container">
                        <div class="breadcrumb-content text-center">
                            <h2>{{$banner_contact->banner_name}}</h2>
                            <ul>
                                <li>
                                    <a href="{{url('/')}}">Home</a>
                                </li>
                                <li class="active">Contacts</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

    @endforeach


    <div class="contact-area pt-85 pb-90">
        <div class="container">
            <div class="contact-info-wrap mb-50">
                @if(Session::get('massage'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{Session::get('massage')}}</strong>
                    </div>
                @endif
                @if($errors->any()||Session::get('ErrorMassage'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @if($errors->any())
                        @foreach($errors->all() as $error)
                            <ol>
                                <li><strong>{{$error!=null?$error:Session::get('ErrorMassage')}}</strong></li>
                            </ol>
                        @endforeach
                    @else
                            <ol>
                                <li><strong>{{Session::get('ErrorMassage')}}</strong></li>
                            </ol>
                    @endif
                    </div>
                @endif
                <h3>contact info</h3>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="single-contact-info text-center mb-30">
                            <i class="ti-location-pin"></i>
                            <h4>our address</h4>
                            <p>{{$contacts->address}}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-contact-info extra-contact-info text-center mb-30">
                            <ul>
                                <li><i class="ti-mobile"></i> <a href="tel:{{$contacts->phone_number}}">{{$contacts->phone_number}}</a></li>
                                <li><i class="ti-email"></i> <a href="mailto:{{$contacts->email}}">{{$contacts->email}}</a></li>
                                @if($contacts->telephone_number!=null)
                                <li><i class="la la-phone"></i> <a href="tel:{{$contacts->telephone_number}}">{{$contacts->telephone_number}}</a></li>
                                @endif
                                @if($contacts->fax!=null)
                                <li><i class="la la-fax"></i> <a href="fax:{{$contacts->fax}}">{{$contacts->fax}}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-contact-info text-center mb-30">
                            <i class=" ti-alarm-clock"></i>
                            <h4>openning hour</h4>
                            <p>Everyday. 9:00am - 5:00pm </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="get-in-touch-wrap">
                <h3>Get In Touch</h3>
                <div class="contact-from contact-shadow">

                        {{Form::open(['id'=>'contact-form','method'=>'post','route'=>'contact_massage_send'])}}

                        <div class="row">
                            <div class="col-lg-6">
                                <input name="name" value="{{old('name')}}" type="text" placeholder="Name">
                            </div>
                            <div class="col-lg-6">
                                <input name="email" value="{{old('email')}}" type="email" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <input name="subject" value="{{old('subject')}}" type="text" placeholder="Subject">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="massage" placeholder="Your Message">{{old('massage')}}</textarea>
                            </div>
                            <div class="col-lg-12">


{{--                                <div class="g-recaptcha" data-sitekey="{{env('Contacts_Site_key_reCaptcha')}}"></div>--}}

                                <div class="button-box">
                                    <button type="submit" class="g-recaptcha"  data-sitekey="{{env('recaptcha_site_key')}}"
                                            data-callback='onMassage'
                                            data-action='submit'>Send</button>
                                </div>

                            </div>

                        </div>
                    {{Form::close()}}

                    <p class="form-messege"></p>
                </div>
            </div>
            <div class="contact-map pt-90">
                <div id="map"  >
                    <iframe class="col-md-12 col-lg-12"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117341.82659269888!2d91.37356797975582!3d23.20914569448354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3753719278440267%3A0x4072c4ccd7716fc!2sParshuram%20Upazila!5e0!3m2!1sen!2sbd!4v1614582518498!5m2!1sen!2sbd" width="1170" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>


    <script>
        function onMassage(token) {
            document.getElementById("contact-form").submit();
        }
    </script>
    <style>#product_menus{display: none;}</style>
@endsection
