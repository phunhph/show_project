
@php
    $footer= \App\Models\settings::where('key','like','%footer_%')->get();

         $footer_1 = $footer->filter(function($setting){
            return $setting->key == 'footer_1';
        })->first();
           $title_1 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_title_1';
        })->first();
             $title_2 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_title_2';
        })->first();
               $title_3 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_title_3';
        })->first();
                 $title_4 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_title_4';
        })->first();
          $footer_2 = $footer->filter(function($setting){
            return $setting->key == 'footer_2';
        })->first();
           $footer_3 = $footer->filter(function($setting){
            return $setting->key == 'footer_3';
        })->first();
            $footer_4 = $footer->filter(function($setting){
            return $setting->key == 'footer_4';
        })->first();

               $link_1 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_link_1';
        })->first();

                  $link_2 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_link_2';
        })->first();

                     $link_3 = $footer->filter(function($setting){
            return $setting->key == 'footer_1_link_3';
        })->first();
@endphp
<div class="footer-wrap ">
    <div class="container">
        <div class="footer-subscribe">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4">
                    <div class="social-icons">
                        <ul class="list-unstyled">
                            <li>
                                <a href="javascript:"
                                ><i class="bi bi-facebook"></i
                                    ></a>
                            </li>
                            <li>
                                <a href="javascript:"
                                ><i class="bi bi-twitter-x"></i
                                    ></a>
                            </li>
                            <li>
                                <a href="javascript:"
                                ><i class="bi bi-instagram"></i
                                    ></a>
                            </li>
                            <li>
                                <a href="javascript:"
                                ><i class="bi bi-linkedin"></i
                                    ></a>
                            </li>
                            <li>
                                <a href="javascript:"
                                ><i class="bi bi-youtube"></i
                                    ></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="align-items-center row form-inputs">
                        <div class="col-md-6 col-lg-7 text-lg-end">
                            <h6>Subscribe Our Newsletter</h6>
                            Best for one-man bands, web creators, and
                            freelancers.
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="d-flex">
                                <input
                                    type="text"
                                    name="subscribe"
                                    placeholder="Enter your email address"
                                    class="form-control bordered"
                                />
                                <button
                                    type="submit"
                                    class="btn btn-secondary bordered"
                                >
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-xxl-5 col-lg-5">
                    <div class="row">
                        <div class="col-xxl-6 col-sm-6">
                            <div class="footer-widget">
                                <h4 class="widget-title">{{ $title_1->content }}</h4>
                                <p class="footer-text">{{ $footer_1->content }}</p>
                                <div class="social-icons">
                                    <ul class="list-unstyled">
                                        <li><a href="{{ $link_1->content }}"><i class="bi bi-facebook"></i></a></li>
                                        <li><a href="{{ $link_3->content }}"><i class="bi bi-instagram"></i></a></li>
                                        <li><a href="{{ $link_2->content }}"><i class="bi bi-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-5 col-sm-6 ms-auto">
                            <div class="footer-widget">
                                <h4 class="widget-title">{{ $title_2->content }}</h4>
                                <ul class="list-unstyled icons-listing mb-0 widget-listing">
                                    {!! $footer_2->content !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-lg-7 mr-top-footer">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="footer-widget">
                                <h4 class="widget-title">{{ $title_3->content }}</h4>
                                <ul class="list-unstyled icons-listing mb-0 widget-listing">
                                    {!! $footer_3->content !!}
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 ol-12">
                            <div class="footer-widget">
                                <h4 class="widget-title">{{ $title_4->content }}</h4>
                                <div class="footer-widget-contact">
                                    <ul class="list-unstyled">
                                        {!! $footer_4->content !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tiny-footer">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-0">Copyright &copy; <span id="yearText"></span>
                        <strong>Cao đẳng FPT.</strong> </div>
                    <div class="col-md-6">
                        <div class="tiny-footer-links">
                            <ul class="list-unstyled list-inline">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div><a id="back-to-top" href="javascript:" class="back-to-top"><i class="bi bi-chevron-up"></i></a>
