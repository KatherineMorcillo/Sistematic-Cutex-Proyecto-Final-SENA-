<div class="app-menu">

    <!-- Brand Logo -->
    <div class="d-flex flex-column align-items-center justify-content-center py-2">
        <a href="index.html" class="logo-dark">
            <img src="{{ url('images/logo.jpg')}}" alt="dark logo sdfsdfsdfdsdfsdfsdfdsfsdf" width="100" height="100">
        </a>
        <div class="mt-10">
            <h5> {{ Auth::user()->name }}</h5>
        </div>
    </div>

    <!-- menu-left -->
    <div class="scrollbar">

        <!-- User box -->
        <div class="user-box text-center">
            <img src="assets/images/users/user-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block" data-bs-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user me-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings me-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock me-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted mb-0">Admin Head</p>
        </div>

        <!--- Menu -->
        @switch(Auth::user()->rol_id)
            @case(1)
                @include('layouts.components.menu.admin')
                @break
            @case(2)
                @include('layouts.components.menu.vendedor')
                @break
            @case(3)
                @include('layouts.components.menu.auxiliar')
                @break
        @endswitch
        <!--- End Menu -->
        <div class="clearfix"></div>
    </div>
</div>
