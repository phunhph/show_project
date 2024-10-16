<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm p-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/FPT_Polytechnic.png" alt="" height="22">
                    </span>
            <span class="logo-lg p-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/FPT_Polytechnic.png" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/FPT_Polytechnic.png" class="p-2" alt="" width="100%">
                    </span>
            <span class="logo-lg">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/FPT_Polytechnic.png" class="p-2" alt=""  width="100%">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.home') }}">
                        <i class="ri-bar-chart-grouped-line"></i><span data-key="t-base-ui">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.banner.index') }}">
                        <i class="ri-archive-fill"></i><span data-key="t-base-ui">Quản Lí Banner</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.technicals.index') }}">
                        <i class="ri-bubble-chart-line"></i><span data-key="t-base-ui">Công nghệ sử dụng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.domain.index') }}">
                        <i class="ri-briefcase-3-fill"></i><span data-key="t-base-ui">Lĩnh vực</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.levels.index') }}">
                        <i class="ri-projector-2-fill"></i><span data-key="t-base-ui">Mức Độ</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.projects.index') }}">
                        <i class="ri-slideshow-fill"></i><span data-key="t-base-ui">Quản lí dự án</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.members.index') }}">
                        <i class="ri-account-circle-line"></i><span data-key="t-base-ui">Thành Viên</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.settings.index') }}">
                        <i class="ri-briefcase-5-line"></i> <span data-key="t-base-ui">Cài đặt</span>
                    </a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
