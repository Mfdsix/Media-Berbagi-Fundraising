<ul class="sidebar-menu tf">

    <li>
        <a href="{{ url('/dashboard-program') }}" class="@if(request()->is('dashboard-program')) active @endif">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/campaign') || request()->is('*/zakat') || request()->is('*/wakaf') || request()->is('*/qurban')) active @endif">
            <i class='bx bxs-copy-alt'></i>
            <span>Publikasi Program</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/campaign') || request()->is('*/zakat') || request()->is('*/wakaf') || request()->is('*/qurban')) active @endif">
            <li>
                <a class="@if(request()->is('*/campaign')) active @endif" href="{{ url('/dashboard-program/campaign') }}">Infaq</a>
            </li>
            <li>
                <a class="@if(request()->is('*/zakat')) active @endif" href="{{ url('/dashboard-program/zakat') }}">Zakat</a>
            </li>
            <li>
                <a class="@if(request()->is('*/wakaf')) active @endif" href="{{ url('/dashboard-program/wakaf') }}">Wakaf</a>
            </li>
            <!-- <li>
                <a class="@if(request()->is('*/qurban')) active @endif" href="{{ url('/admin/qurban') }}">Qurban</a>
            </li> -->
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/category') || request()->is('*/category-ordering') || request()->is('*/order')) active @endif">
            <i class='bx bx-list-ol'></i>
            <span>Pengaturan Program</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/category') || request()->is('*/category-ordering') || request()->is('*/order')) active @endif">
            <li>
                <a class="@if(request()->is('*/category')) active @endif" href="{{ url('/dashboard-program/category') }}">Kategori</a>
            </li>
            <li>
                <a class="@if(request()->is('*/category-ordering')) active @endif" href="{{ url('/dashboard-program/category-ordering') }}">Urutkan Kategori</a>
            </li>
            <li>
                <a class="@if(request()->is('*/order')) active @endif" href="{{ url('/dashboard-program/order') }}">Urutkan Program</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/funding_distribution')) active @endif">
            <i class='bx bx-right-top-arrow-circle'></i>
            <span>Penyaluran Dana</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/funding_distribution') || request()->is('*/update')) active @endif">
            <li>
                <a class="@if(request()->is('*/funding_distribution')) active @endif" href="{{ url('/dashboard-program/funding_distribution') }}">Input Penyaluran</a>
            </li>
            <li>
                <a class="@if(request()->is('*/update')) active @endif" href="{{ url('/dashboard-program/update') }}">Input Berita</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/donatur*')) active @endif">
            <i class='bx bxs-user-circle'></i>
            <span>Data Donatur</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/donatur*')) active @endif">
            <li>
                <a class="@if(request()->is('*/donatur/success')) active @endif" href="{{ url('/dashboard-program/donatur/success') }}">Donatur Sukses</a>
            </li>
            <li>
                <a class="@if(request()->is('*/donatur/fail')) active @endif" href="{{ url('/dashboard-program/donatur/fail') }}">Donatur Gagal</a>
            </li>
            <li>
                <a class="@if(request()->is('*/donatur')) active @endif" href="{{ url('/dashboard-program/donatur') }}">Semua Donatur</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/fundraiser') || request()->is('*/fundraiser/leaderboard')) active @endif">
            <i class='bx bx-user-circle'></i>
            <span>Fundraiser</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/fundraiser') || request()->is('*/fundraiser/leaderboard')) active @endif">
        <li>
                <a class="@if(request()->is('*/fundraiser')) active @endif" href="{{ url('/dashboard-program/fundraiser') }}">List Fundraiser</a>
            </li>
        <li>
                <a class="@if(request()->is('*/fundraiser/leaderboard')) active @endif" href="{{ url('/dashboard-program/fundraiser/leaderboard') }}">Leaderboard</a>
            </li>
        </ul>
    </li>

    <hr>

    <li>
        <a class="darkmode-toggle" id="darkmode-toggle" onclick="switchTheme()">
            <div>
                <i class='bx bx-cog mr-10'></i>
                <span>darkmode</span>
            </div>

            <span class="darkmode-switch"></span>
        </a>
    </li>
    <li>
         Versi {{exec("git tag")}}
    </li>
</ul>
