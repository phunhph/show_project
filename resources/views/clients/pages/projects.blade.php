@extends('clients.layouts.index')
@section('title',"Dự án")
@section('color-header',"bg-primary header-bg")
@section('namePages',"Tất cả dự án")
@include('clients.components.breadcrumbs')
@section('content')
    @php
        $settings = \App\Models\settings::all();
        $title_project = $settings->filter(function($setting){
            return $setting->key == 'title_project';
        })->first();

        $des_project = $settings->filter(function($setting){
            return $setting->key == 'des_project';
        })->first();
    @endphp
    <main id="body-content" class="bg-white">
        <section class="section-spacing pt-0">
            <div class="container">
                <div class="row">
                    <div
                        class="col-xl-5 col-lg-9 col-md-12 mx-auto text-center"
                    >
                        <div class="section-title text-center">
                            <span>Latest Case Studies</span>
                            <h2 class="wow">
                                {!! $title_project->content !!}
                            </h2>
                            <p>
                                {!! $des_project->content !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="portfolio-flters" class="list-unstyled">

                            <li data-filter="*" class="filter-active">
                                <a href="javascript:">All</a>
                            </li>
                            @forelse($domainsAll as $domain)
                                <li data-filter=".{{ to_slug($domain->name) }}">
                                    <a href="javascript:">{{ $domain->name }}</a>
                                </li>
                            @empty
                            @endforelse

                        </ul>
                    </div>
                </div>
                <div class="isotope-gallery row four-column">
                    @forelse($projects as $project)
                        @php
                            $image = \App\Models\images::where([['is_active',0],['type',1],['projects_id',$project->id]])->first();
                            $domains = \App\Models\project_domains::with(['domain' => function($qr){
                              $qr->withTrashed();
                            }])->where('projects_id',$project->id)->get();
                        @endphp
                    <div
                        class="gallery-item col-xl-3 col-lg-4 col-md-6 col-12 @forelse($domains as $key => $valueDomain){{ to_slug($valueDomain->domain->name) }} @empty
                                    @endforelse"
                    >
                        <div class="portfolio-gallery-item">

                            <div class="item-img">
                                <div class="portfolio-img-gallery"><a href="{{ \Illuminate\Support\Facades\Storage::url('images/projects/avatar/' .$image->image) }}"
                                                                      class="portfolio-img-gallery" title="Title Come here"><img
                                            src="{{ \Illuminate\Support\Facades\Storage::url('images/projects/avatar/' .$image->image) }}" class="rounded" alt></a>
                                    <div class="img-over"><i class="bi bi-plus-lg"></i></div>
                                </div><a href="{{ route('single',$project->slug) }}" class="arrow"><i class="srn-arrow-right"></i></a>
                            </div>
                            <div class="item-content">
                                <h6><a href="{{ route('single',$project->slug) }}">{{ $project->name }}</a></h6>
                                <div class="sub-head">
                                    @forelse($domains as $key => $valueDomain)
                                        {{ $valueDomain->domain->name }}{{ $loop->last ? '' : ' & ' }}
                                    @empty
                                    @endforelse
                                </div>
                                {{--                                <p>We use the latest technologies it voluptatem accusantium We do this by discerning the--}}
                                {{--                                    ships</p>--}}
                            </div>
                        </div>
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
