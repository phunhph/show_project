@extends('clients.layouts.index')
@push('styles')
    <link rel="stylesheet" href="{{ asset('theme/client/assets/css/home-default.css') }}">
@endpush
@section('title',"Trang chủ")
@include('clients.components.banner')
@section('content')
    @php
        $settings = \App\Models\settings::all();
        $logo_business = \App\Models\settings::where('key','like','%business_logo_%')->get();
        $image_business = $settings->filter(function($setting){
            return $setting->key == 'business_image';
        })->first();

           $content_business = $settings->filter(function($setting){
            return $setting->key == 'content_business';
        })->first();
        $title_question_case = $settings->filter(function($setting){
            return $setting->key == 'title_question_case';
        })->first();
        $question_case = \App\Models\settings::where('key','like','%question_case_%')->get();
    @endphp
    <main id="body-content">
        <section class="section-spacing logo-carousel">
            <div class="container">
                <div class="owl-carousel owl-theme top-right-arrow" id="client-home-default">
                    @forelse($logo_business as $logo)
                        <div class="item">
                            <div class="img-partner"><img src="{{ $logo->content }}" alt></div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
        <section class="section-spacing">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-xl-7 wow slideInLeft"><img src="{{ $image_business->content }}" alt></div>
                    <div class="col-lg-6 col-xl-5 col-sm-12">
                        {!! $content_business->content !!}
                        <a href="{{ route('projects') }}" class="btn btn-secondary"><span class="outer-wrap"><span
                                    data-text="Xem thêm">Xem thêm</span></span></a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-spacing">
            <div class="container pos-rel">
                <div class="row align-items-center">
                    <div class="mx-auto col-xl-12 col-lg-12 mt-12 mt-xl-0">
                        <div class="section-title text-start"><span>Nhận câu trả lời của bạn nhanh chóng</span>
                            <h2 class="wow">{!! $title_question_case->content !!}</h2>

                        </div>
                        <div class="theme-accordian">
                            <div class="accordion accordion-flush theme-accordian" id="accordionFlushExampleSimple">
                                @forelse($question_case as $key => $question)
                                    @php
                                        $questionPos = strpos($question->content, "Question");

                                        // Tìm vị trí của "Answer" sau "Question"
                                        $answerPos = strpos($question->content, "Answer", $questionPos);

                                        // Lấy ra đoạn văn bản từ vị trí của "Question" đến trước "Answer"
                                        $questionText =  trim(str_replace("Question:", "", substr($question->content, $questionPos, $answerPos - $questionPos) ));

                                        // Lấy ra đoạn văn bản từ vị trí của "Answer" đến cuối

                                        $answerText = trim(str_replace("Answer:", "", substr($question->content, $answerPos)));

                                    @endphp

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-gap-heading{{ $key }}"><button
                                                class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#flush-gap-collapse{{ $key }}" aria-expanded="false"
                                                aria-controls="flush-gap-collapse{{ $key }}">{{ $questionText }}</button></h2>
                                        <div id="flush-gap-collapse{{ $key }}" class="accordion-collapse collapse"
                                             aria-labelledby="flush-gap-heading{{ $key }}"
                                             data-bs-parent="#accordionFlushExampleSimple">
                                            <div class="accordion-body">{{ $answerText }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </main>
@endsection
