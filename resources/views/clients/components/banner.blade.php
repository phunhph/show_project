@section('components')
<div class="container home-default-banner mt-2">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @forelse($banners as $key => $value)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : ''}}" aria-current="true" aria-label="Slide {{ $key }}"></button>
            @empty
            @endforelse
        </div>
        <div class="carousel-inner">
            @forelse($banners as $key => $value)
            <div class="carousel-item {{ $key == 0 ? 'active' : ''}}">
                <img src="{{ \Illuminate\Support\Facades\Storage::url('images/banner/' .$value->image) }}" width="1280" height="505" alt="...">
            </div>
            @empty
            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>



<b class="screen-overlay"></b>
@endsection
