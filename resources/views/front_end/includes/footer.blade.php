<footer class="footer-area section-padding-2 bg-bluegray pt-80">
    <div class="container-fluid">
        <div class="footer-top pb-40">
            <div class="row">
                <div class="col-lg-3 col-md-8 col-12 col-sm-12">
                    <div class="footer-widget mb-30">
                        @if(!empty($appearance_image->id))
                            <a href="#">
                                <img width="80" src="{{asset('/').$appearance_image->logo}}"
                                     alt="{{env('app_name')}}logo">
                            </a>
                        @endif
                        <div class="footer-about">
                            @foreach($notesFooter as $description)
                                {!! $description->description !!}
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6 col-sm-6">
                    <div class="footer-widget mb-30 ml-55">
                        <div class="footer-title-3">
                            <h3>Company</h3>
                        </div>
                        <div class="footer-list-3">
                            <ul>
                                @foreach($PagesFooter as $companyLink)
                                    @if($companyLink->collum_id==1)
                                        <li><a href="{{route('view_page_details',['name'=>$companyLink->page_name,'id'=>$companyLink->id])}}">{{$companyLink->page_name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 col-sm-6">
                    <div class="footer-widget mb-30 footer-ngtv-mrg1">
                        <div class="footer-title-3">
                            <h3>Product</h3>
                        </div>
                        <div class="footer-list-3">
                            <ul>

                                @foreach($PagesFooter as $companyLink)
                                    @if($companyLink->collum_id==2)
                                        <li><a href="{{route('view_page_details',['name'=>$companyLink->page_name,'id'=>$companyLink->id])}}">{{$companyLink->page_name}}</a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 col-sm-6">
                    <div class="footer-widget mb-30 ml-35">
                        <div class="footer-title-3">
                            <h3>Helps</h3>
                        </div>
                        <div class="footer-list-3">
                            <ul>

                                @foreach($PagesFooter as $companyLink)
                                    @if($companyLink->collum_id==3)
                                        <li><a href="{{route('view_page_details',['name'=>$companyLink->page_name,'id'=>$companyLink->id])}}">{{$companyLink->page_name}}</a></li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 col-sm-6">
                    <div class="footer-widget mb-30 ml-135">
                        <div class="footer-title-3">
                            <h3>Social Netowrk</h3>
                        </div>
                        <div class="footer-list-3">
                            <ul>
                                @foreach($SocialLink as $socialLink)
                                    <li><a href="{{$socialLink->url}}"
                                           target="_blank">{{$socialLink->platform_name}}</a></li>
                                @endforeach
                                @foreach($PagesFooter as $companyLink)
                                    @if($companyLink->collum_id==4)
                                        <li><a href="{{route('view_page_details',['name'=>$companyLink->page_name,'id'=>$companyLink->id])}}">{{$companyLink->page_name}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom pt-40 border-top-1">
            <div class="row">
{{--                <div class="col-xl-7 col-lg-10 col-md-11 ml-auto mr-auto">--}}
{{--                    <div class="footer-tag-wrap">--}}
{{--                        <div class="footer-tag-title">--}}
{{--                            <span>Tags :</span>--}}
{{--                        </div>--}}
{{--                        <div class="footer-tag-list">--}}
{{--                            <ul>--}}
{{--                                <li><a href="#">Minimal eCommerce</a></li>--}}
{{--                                <li><a href="#">Marketing</a></li>--}}
{{--                                <li><a href="#">User Exprience</a></li>--}}
{{--                                <li><a href="#">Ali Express</a></li>--}}
{{--                                <li><a href="#">Web </a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
            <div class="copyright-3 text-center pt-20 pb-20 border-top-1">
                <p>Copyright © <a href="#">{{env('app_name')}}</a>. All Right Reserved</p>
            </div>
        </div>
    </div>
</footer>
