@extends('clients.layouts.index')
@section('title',"Chi tiết dự án")
@section('color-header',"bg-primary header-bg")
@section('namePages',"Chi tiết dự án")
@include('clients.components.breadcrumbs')
@section('content')
    @php
        $domains = \App\Models\project_domains::with(['domain' => function($qr){
          $qr->withTrashed();
        }])->where('projects_id',$project->id)->get();
        $idDomains = $domains->map(function($item){
          return $item->domains_id;
        })->toArray();
           $relatedProjects = \App\Models\projects::with(['images','domains.domain'])->where('id', '!=', $project->id)
            ->whereHas('domain', function ($query) use ($idDomains) {
                $query->whereIn('domains_id', $idDomains);
            })
            ->limit(5)
            ->get();
         $technicals = \App\Models\technical_projects::with(['technical' => function($qr){
          $qr->withTrashed();
        }])->where('projects_id',$project->id)->get();
    @endphp

    <main id="body-content" class="bg-white">
        <section class="section-spacing pattern-white-bg">
            <div class="container-full ">
                <div class="row justify-content-center align-content-center">
                    <div class="col-lg-5 col-xl-4 col-sm-6">
                        <div class="portfolio-slider-wrap-outer">
                            <div class="square-top">
                                <img
                                    src="{{ asset('theme/client/assets/images/square_large.svg') }}"
                                    alt
                                />
                            </div>
                            <div class="portfolio-slider-wrap">
                                <div
                                    class="owl-carousel owl-theme"
                                    id="portfolio-slider-single"
                                >
                                    @forelse($desribe as $value)
                                        <div class="item">
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url('description/' .$value->image) }}"
                                                alt
                                            />
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-6 col-sm-6 ">
                        <div
                            class="portfolio-single-details section-padding"
                        >
                            <div
                                class="hstack justify-content-between wow fadeInUp"
                                data-wow-delay="0.1s"
                            >
                                <div class="client-details">
                                    <div class="head">Công nghệ sử dụng</div>
                                    <h6>@forelse($technicals as $key => $valueTechnical)
                                            <a href="{{ route('projects') }}?technical={{ $valueTechnical->technical->name }}" class="text-white link-redirect fs-5"> {{ $valueTechnical->technical->name }}</a>{{ $loop->last ? '' : ' / ' }}
                                        @empty
                                        @endforelse</h6>
                                </div>
                                <div class="client-details">
                                    <div class="head">Lĩnh vực</div>
                                    <h6>     @forelse($domains as $key => $valueDomain)
                                            <a href="{{ route('projects') }}?domain={{  to_slug($valueDomain->domain->name) }}" class="text-white link-redirect fs-5">{{ $valueDomain->domain->name }}</a>{{ $loop->last ? '' : ' / ' }}
                                        @empty
                                        @endforelse</h6>
                                </div>
                                <div class="client-details">
                                    <div class="head">Tác giả</div>
                                    @php
                                        $members = explode( ',', $project->added_by);
                                    @endphp
                                    <h6>@forelse($members as $key => $member)
                                            <a href="{{ route('projects') }}?member={{  $member }}" class="text-white link-redirect fs-5">  {{ $member }}</a>{{ $loop->last ? '' : ' , ' }}
                                        @empty
                                        @endforelse</h6>
                                </div>
                            </div>
                            <div
                                class="hstack justify-content-between wow fadeInUp"
                                data-wow-delay="0.2s"
                            >
                                <div class="client-details">
                                    <a
                                        href="{{ $project->deploy_link }}"
                                        class="btn btn-outline-light is-icon-right"
                                    ><span class="outer-wrap"
                                        ><span data-text="Visit Website"
                                            >Visit Website</span
                                            ></span
                                        >
                                        <i class="srn-external-link"></i
                                        ></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-spacing portfolio-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-xl-8 col-sm-12 mx-auto">
                        <div class="section-content">
                            {!! $project->description !!}
                        </div>
                        <div class="section-content">
                            <h3>Related Projects</h3>
                            <div
                                class="owl-carousel owl-theme top-right-arrow"
                                id="portfolio-related-slider"
                            >
                                @forelse($relatedProjects as $relatedProject)
                                <div class="item">
                                    <div class="portfolio-gallery-item">
                                        <div class="item-img">
                                            <div
                                                class="portfolio-img-gallery"
                                            >
                                                <a
                                                    href=""
                                                    class="portfolio-img-gallery"
                                                    title="Title Come here"
                                                ><img
                                                        src="{{ \Illuminate\Support\Facades\Storage::url('images/projects/avatar/' .$relatedProject->images->filter(function($r) {
                                                            return $r->is_active == 0 && $r->type == 1;
                                                                 })->first()->image ) }}"
                                                        class="rounded"
                                                        alt
                                                    /></a>
                                                <div class="img-over">
                                                    <i
                                                        class="bi bi-plus-lg"
                                                    ></i>
                                                </div>
                                            </div>
                                            <a
                                                href="{{ route('single',$relatedProject->id) }}"
                                                class="arrow"
                                            ><i
                                                    class="srn-arrow-right"
                                                ></i
                                                ></a>
                                        </div>
                                        <div class="item-content">
                                            <h6>
                                                <a
                                                    href="{{ route('single',$relatedProject->id) }}"
                                                >{{ $relatedProject->name }}</a
                                                >
                                            </h6>
                                            <div class="sub-head">
                                                @forelse($relatedProject->domains as $key => $valueTechnical)
                                                    {{ $valueTechnical->domain->name }}{{ $loop->last ? '' : ' & ' }}
                                                @empty
                                                @endforelse
                                            </div>
{{--                                            <p>--}}
{{--                                                We use the latest--}}
{{--                                                technologies it voluptatem--}}
{{--                                                accusantium We do this by--}}
{{--                                                discerning the ships--}}
{{--                                            </p>--}}
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
