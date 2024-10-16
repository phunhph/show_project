@extends('clients.layouts.index')
@section('title',"Trang chi tiết dự án")
@section('color-header',"bg-primary header-bg")
@section('namePages',"Chi tiết thành viên")
@include('clients.components.breadcrumbs')
@section('content')
    <main id="body-content" class="bg-white">
        <section class>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-sm-12 mx-auto">
                        <div
                            class="portfolio-slider-wrap-outer portfolio-single"
                        >
                            <div class="square-top">
                                <img
                                    src="{{ asset('theme/client/assets/images/square_large.svg') }}"                            />
                            </div>
                            <div class="portfolio-slider-wrap">
                                <div class="team-single">
                                    <div class="img">
                                        <img
                                            src="{{ \Illuminate\Support\Facades\Storage::url('images/member/avatar/' .$member->avatar)  }}"
                                            alt
                                        />
                                    </div>
                                    <div class="team-content">
                                        <span>CEO OF COMPANY</span>
                                        <h1>
                                            <strong>{{ $member->name }}</strong>
                                        </h1>
                                            {!! $member->describe == '' ? 'Chưa có mô tả' : $member->describe !!}
                                    </div>
                                </div>
                                <div class="team-footer">
                                    <ul class="list-unstyled social-icons">
                                        <li>
                                            <a href="javascript:"
                                            ><i
                                                    class="bi bi-facebook"
                                                ></i
                                                ></a>
                                        </li>
                                        <li>
                                            <a href="javascript:"
                                            ><i
                                                    class="bi bi-twitter-x"
                                                ></i
                                                ></a>
                                        </li>
                                        <li>
                                            <a href="javascript:"
                                            ><i
                                                    class="bi bi-instagram"
                                                ></i
                                                ></a>
                                        </li>
                                        <li>
                                            <a href="javascript:"
                                            ><i
                                                    class="bi bi-linkedin"
                                                ></i
                                                ></a>
                                        </li>
                                        <li>
                                            <a href="javascript:"
                                            ><i
                                                    class="bi bi-youtube"
                                                ></i
                                                ></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-spacing pattern-white-bg section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-sm-12 mx-auto">
                    </div>
                </div>
            </div>
        </section>
{{--        <section class="section-spacing">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-9 col-lg-5 mx-auto text-center">--}}
{{--                        <div class="section-title text-center">--}}
{{--                            <span>Real User Reviews</span>--}}
{{--                            <h2 class="wow">--}}
{{--                                What our client’s are--}}
{{--                                <strong>Saying about us</strong>--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div--}}
{{--                    class="owl-carousel owl-theme"--}}
{{--                    id="testimonials-slider-shadow"--}}
{{--                >--}}
{{--                    <div class="item">--}}
{{--                        <div class="testimonial-shadow">--}}
{{--                            <div class="thumb-img">--}}
{{--                                <img src="{{ asset('theme/client/assets/images/thumb_1.jpg') }}           " alt />                 </div>--}}
{{--                            <h6 class="name">Rider Smith</h6>--}}
{{--                            <div class="post">--}}
{{--                                Marketing Envato Pty Ltd.--}}
{{--                            </div>--}}
{{--                            <div class="rating">--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star"></i>--}}
{{--                            </div>--}}
{{--                            <hr class="divider-default" />--}}
{{--                            <h2>--}}
{{--                                My business is growing faster and I’m very--}}
{{--                                happy with that--}}
{{--                            </h2>--}}
{{--                            <p>--}}
{{--                                Thank you for your excellent work. No one--}}
{{--                                could hear us as well as you and make our--}}
{{--                                wishes come true so beautifully and--}}
{{--                                beautifully.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <div class="testimonial-shadow">--}}
{{--                            <div class="thumb-img">--}}
{{--                                <img src="{{ asset('theme/client/assets/images/thumb_2.jpg') }}      " alt />                      </div>--}}
{{--                            <h6 class="name">Rider Smith</h6>--}}
{{--                            <div class="post">--}}
{{--                                Marketing Envato Pty Ltd.--}}
{{--                            </div>--}}
{{--                            <div class="rating">--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star"></i>--}}
{{--                            </div>--}}
{{--                            <hr class="divider-default" />--}}
{{--                            <h2>--}}
{{--                                My business is growing faster and I’m very--}}
{{--                                happy with that--}}
{{--                            </h2>--}}
{{--                            <p>--}}
{{--                                Thank you for your excellent work. No one--}}
{{--                                could hear us as well as you and make our--}}
{{--                                wishes come true so beautifully and--}}
{{--                                beautifully.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <div class="testimonial-shadow">--}}
{{--                            <div class="thumb-img">--}}
{{--                                <img src="{{ asset('theme/client/assets/images/thumb_3.jpg--}}
{{--') }}       " alt />                     </div>--}}
{{--                            <h6 class="name">Rider Smith</h6>--}}
{{--                            <div class="post">--}}
{{--                                Marketing Envato Pty Ltd.--}}
{{--                            </div>--}}
{{--                            <div class="rating">--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star"></i>--}}
{{--                            </div>--}}
{{--                            <hr class="divider-default" />--}}
{{--                            <h2>--}}
{{--                                My business is growing faster and I’m very--}}
{{--                                happy with that--}}
{{--                            </h2>--}}
{{--                            <p>--}}
{{--                                Thank you for your excellent work. No one--}}
{{--                                could hear us as well as you and make our--}}
{{--                                wishes come true so beautifully and--}}
{{--                                beautifully.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <div class="testimonial-shadow">--}}
{{--                            <div class="thumb-img">--}}
{{--                                <img src="{{ asset('theme/client/assets/images/thumb_4.jpg--}}
{{--') }}                 " alt />           </div>--}}
{{--                            <h6 class="name">Rider Smith</h6>--}}
{{--                            <div class="post">--}}
{{--                                Marketing Envato Pty Ltd.--}}
{{--                            </div>--}}
{{--                            <div class="rating">--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star"></i>--}}
{{--                            </div>--}}
{{--                            <hr class="divider-default" />--}}
{{--                            <h2>--}}
{{--                                My business is growing faster and I’m very--}}
{{--                                happy with that--}}
{{--                            </h2>--}}
{{--                            <p>--}}
{{--                                Thank you for your excellent work. No one--}}
{{--                                could hear us as well as you and make our--}}
{{--                                wishes come true so beautifully and--}}
{{--                                beautifully.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <div class="testimonial-shadow">--}}
{{--                            <div class="thumb-img">--}}
{{--                                <img src="{{ asset('theme/client/assets/images/thumb_5.jpg--}}
{{--') }}                 " alt />           </div>--}}
{{--                            <h6 class="name">Rider Smith</h6>--}}
{{--                            <div class="post">--}}
{{--                                Marketing Envato Pty Ltd.--}}
{{--                            </div>--}}
{{--                            <div class="rating">--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star"></i>--}}
{{--                            </div>--}}
{{--                            <hr class="divider-default" />--}}
{{--                            <h2>--}}
{{--                                My business is growing faster and I’m very--}}
{{--                                happy with that--}}
{{--                            </h2>--}}
{{--                            <p>--}}
{{--                                Thank you for your excellent work. No one--}}
{{--                                could hear us as well as you and make our--}}
{{--                                wishes come true so beautifully and--}}
{{--                                beautifully.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        <div class="testimonial-shadow">--}}
{{--                            <div class="thumb-img">--}}
{{--                                <img src="{{ asset('theme/client/assets/images/thumb_6.jpg--}}
{{--') }}                 " alt />           </div>--}}
{{--                            <h6 class="name">Rider Smith</h6>--}}
{{--                            <div class="post">--}}
{{--                                Marketing Envato Pty Ltd.--}}
{{--                            </div>--}}
{{--                            <div class="rating">--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star-fill"></i>--}}
{{--                                <i class="bi bi-star"></i>--}}
{{--                            </div>--}}
{{--                            <hr class="divider-default" />--}}
{{--                            <h2>--}}
{{--                                My business is growing faster and I’m very--}}
{{--                                happy with that--}}
{{--                            </h2>--}}
{{--                            <p>--}}
{{--                                Thank you for your excellent work. No one--}}
{{--                                could hear us as well as you and make our--}}
{{--                                wishes come true so beautifully and--}}
{{--                                beautifully.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--        <section class="section-spacing pt-0">--}}
{{--            <div class="container">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-md-9 col-lg-6 mx-auto text-center">--}}
{{--                        <div class="section-title text-center">--}}
{{--                            <span>Changing things with</span>--}}
{{--                            <h2 class="wow">--}}
{{--                                They are partners inspire--}}
{{--                                <strong>us to drive ongoing results</strong>--}}
{{--                            </h2>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-2 col-lg-4 col-sm-6 col-6 mb-0">--}}
{{--                        <div class="img-partner">--}}
{{--                            <img--}}
{{--                                src="{{ asset('theme/client/assets/images/partner/img-client1.png') }}"--}}
{{--                                alt--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-2 col-lg-4 col-sm-6 col-6 mb-0">--}}
{{--                        <div class="img-partner">--}}
{{--                            <img--}}
{{--                                src="{{ asset('theme/client/assets/images/partner/img-client2.png') }}"--}}
{{--                                alt--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-2 col-lg-4 col-sm-6 col-6 mb-0">--}}
{{--                        <div class="img-partner">--}}
{{--                            <img--}}
{{--                                src="{{ asset('theme/client/assets/images/partner/img-client3.png') }}"--}}
{{--                                alt--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-2 col-lg-4 col-sm-6 col-6 mb-0">--}}
{{--                        <div class="img-partner">--}}
{{--                            <img--}}
{{--                                src="{{ asset('theme/client/assets/images/partner/img-client4.png') }}"--}}
{{--                                alt--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-2 col-lg-4 col-sm-6 col-6 mb-0">--}}
{{--                        <div class="img-partner">--}}
{{--                            <img--}}
{{--                                src="{{ asset('theme/client/assets/images/partner/img-client5.png') }}"--}}
{{--                                alt--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-2 col-lg-4 col-sm-6 col-6 mb-0">--}}
{{--                        <div class="img-partner">--}}
{{--                            <img--}}
{{--                                src="{{ asset('theme/client/assets/images/partner/img-client6.png') }}"--}}
{{--                                alt--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row mt-4">--}}
{{--                    <div class="col-lg-5 col-md-9 mx-auto">--}}
{{--                        <div--}}
{{--                            class="partner-text arrow-read-more fun-fact wow fadeInUp"--}}
{{--                        >--}}
{{--                            <p>--}}
{{--                                Over--}}
{{--                                <span--}}
{{--                                ><small--}}
{{--                                        class="timer"--}}
{{--                                        data-to="75000"--}}
{{--                                        data-speed="2000"--}}
{{--                                    >75000</small--}}
{{--                                    >+ Clients</span--}}
{{--                                >--}}
{{--                                all over the world--}}
{{--                            </p>--}}
{{--                            <a--}}
{{--                                href="contact.html"--}}
{{--                                class="btn-link-secondary"--}}
{{--                            >Book Services Now--}}
{{--                                <i class="srn-arrow-right"></i--}}
{{--                                ></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
    </main>
@endsection
