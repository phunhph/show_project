
@php
    $footer= \App\Models\settings::where('key','like','%footer_%')->get();
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
<header>

    @php
       if(Route::current()->getName() == '/'){
           $arrayHeader = ["logo_dark","primary"];
       }else{
           $arrayHeader = ["logo_light","light"];
       }
    @endphp
    <nav class="navbar navbar-expand-lg header-anim py-2">
        <div class="container"><a class="navbar-brand" href="{{ route('/') }}"><img
                    src="https://upload.wikimedia.org/wikipedia/commons/2/20/FPT_Polytechnic.png" alt></a>
            <form class="d-flex order-lg-last ms-3 align-items-center">
                <a href="#" id="search_home"><i class="srn-search"></i> </a>
                <button
                    class="navbar-toggler x collapsed" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
            </form>
            <div class="navbar-collapse offcanvas offcanvas-start offcanvas-collapse" id="navbarCollapse">
                <div class="offcanvas-header"><a class="navbar-brand" href="{{ route('/') }}"><img
                            src="https://upload.wikimedia.org/wikipedia/commons/2/20/FPT_Polytechnic.png" alt></a><button class="navbar-toggler x collapsed"
                                                                                                          type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarCollapse"
                                                                                                          aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="bi bi-x-lg"></i></button></div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown"><a class="nav-link" href="{{ route('/') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link" href="{{ route('ourteam') }}">OurTeam</a>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link" href="{{ route('projects') }}">Projects</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
