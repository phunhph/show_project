<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from mannatstudio.com/html/serenite/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Feb 2024 06:53:30 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title> @yield('title')</title>
    <meta name="author" content="Mannat Studio">
    <meta name="description"
          content="Serenite is a Responsive HTML5 Template for SaaS, cryptocurrency, app and tech companies, as well as for digital studios.">
    <meta name="keywords"
          content="Serenite, themeforest template, app, app landing page, App Showcase, cryptocurrency, digital studio, saas, saas landing, saas theme, software, software company website, software startup, startup, startup landing page, startup wordpress, technology">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('theme/client/assets/images/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/client/assets/css/styles.min.css') }}">
    @stack('styles')

</head>

<body>
<div id="pageloader">
    <div class="loader-item"><img src="{{ asset('theme/client/assets/images/tail-spin.svg') }}" width="80" alt></div>
</div>
<div class="home-default @yield('color-header')">
    @include('clients.layouts.header')

    <article class="mobile-offcanvas offcanvas-right" id="signup"><button class="btn-close"><i
                class="bi bi-x"></i></button>
        <div class="popup-wrapper">
            <div class="content">
                <h3>Create an account</h3>
                <div class="social-login-btn"><a href="javascript:" class="gm"><i class="bi bi-google"></i> With
                        Google </a><a href="javascript:" class="fb"><i class="bi bi-facebook"></i> With Facebook</a>
                </div>
                <div class="or-text"><span>Or Signup with your email</span></div>
            </div>
            <div class="form-wrap">
                <div class>
                    <div class="mb-4"><input type="text" class="form-control bordered bottom-only"
                                             placeholder="Mobile Number or Email"></div>
                    <div class="mb-4"><input type="text" class="form-control bordered bottom-only"
                                             placeholder="Full Name"></div>
                    <div class="mb-4"><input type="text" class="form-control bordered bottom-only"
                                             placeholder="Username"></div>
                    <div class="mb-4"><input type="text" class="form-control bordered bottom-only"
                                             placeholder="Password"></div>
                    <div class="mb-4 info-form"><small>By signing up, you agree to our <a
                                href="javscript:">Terms</a> , <a href="javscript:">Data Policy</a> and <a
                                href="javscript:">Cookies Policy</a>.</small></div>
                    <div class="d-grid"><button type="button" class="btn btn-outline-primary btn-sm"><span
                                class="outer-wrap"><span data-text="Singup">Singup</span></span></button></div>
                </div>
            </div>
        </div>
    </article>
    @yield('components')
</div>
    @yield('content')
    @include('clients.layouts.footer')
<div class="overlay overlay-hugeinc">
    <form id="searchForm"  action="{{ route('search') }}" method="post" class="form-inline mt-2 mt-md-0">
        @csrf
        <div class="form-inner">
            <div class="form-inner-div hstack"><i class="srn-search"></i>
                <div class="w-100"><input id="searchInput" name="nameSearch" class="form-control form-light" type="text" placeholder="Search"
                                          aria-label="Search"></div><a href="#" class="overlay-close link-oragne"><i
                        class="bi bi-x"></i></a>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent default form submission
                document.getElementById("searchForm").submit(); // Submit the form
            }
        });
    });
</script>
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="{{ asset('theme/client/assets/js/scripts.min.js') }}"></script>
<script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"
        integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA=="
        data-cf-beacon='{"rayId":"85c6bfd12b229f68","version":"2024.2.1","r":1,"token":"64224fc8786846928480d180dfc466bd","b":1}'
        crossorigin="anonymous"></script>
</body>
<!-- Mirrored from mannatstudio.com/html/serenite/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 28 Feb 2024 06:53:33 GMT -->

</html>
