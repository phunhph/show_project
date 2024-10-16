@section('components')
    <section class="breadcrumbs-page">
        <div class="container">
            <h1>@yield('namePages')</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="javascript:"
                        ><i class="bi-house"></i
                            ></a>
                    </li>
                    <li class="breadcrumb-item">Pages</li>
                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        @yield('namePages')
                    </li>
                </ol>
            </nav>
        </div>
    </section>
@endsection
