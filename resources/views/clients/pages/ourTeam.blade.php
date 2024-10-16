@extends('clients.layouts.index')
@section('title',"Thành viên của chúng tôi")
@section('color-header',"bg-primary header-bg")
@section('namePages',"Thành viên của chúng tôi")
@include('clients.components.breadcrumbs')
@section('content')
    @php
        $settings = \App\Models\settings::all();
        $title_our_team = $settings->filter(function($setting){
            return $setting->key == 'title_our_team';
        })->first();

        $des_our_team = $settings->filter(function($setting){
            return $setting->key == 'des_our_team';
        })->first();
    @endphp
    <main id="body-content">
        <section class="section-spacing pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-6 mx-auto text-center">
                        <div class="section-title text-center">
                            <span>Đội ngũ chúng tôi</span>
                            <h2 class="wow">
                                {!! $title_our_team->content !!}
                            </h2>
                                {!! $des_our_team->content !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse($allUser as $member)
                    <div class="col-md-6 col-xl-4 col-lg-6">
                        <div class="team-wrap">
                            <div class="img">
                                <a href="{{ route('teamSingle',$member->id) }}"
                                ><img
                                        src="{{ \Illuminate\Support\Facades\Storage::url('images/member/avatar/' .$member->avatar) }}"
                                        alt
                                    /></a>
                            </div>
                            <div class="content">
                                <h6>
                                    <a href="{{ route('teamSingle',$member->id) }}"
                                    >{{ $member->name }}</a
                                    >
                                </h6>
{{--                                <div class="post">VP of Engineering</div>--}}
                                <ul class="list-unstyled social-icons">
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
                                <div class="arrow-read-more">
                                    <a href="{{ route('teamSingle',$member->id) }}"
                                    >read more
                                        <i class="srn-arrow-right"></i
                                        ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
                <div class="d-flex justify-content-center">
                    {{ $allUser->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
