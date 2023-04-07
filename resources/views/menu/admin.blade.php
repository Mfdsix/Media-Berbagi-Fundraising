<ul class="sidebar-menu tf">

    <li>
        <a href="{{ url('/admin') }}" class="@if(request()->is('admin')) active @endif">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/campaign') || request()->is('*/zakat') || request()->is('*/wakaf') || request()->is('*/archive')) active @endif">
            <i class='bx bxs-copy-alt'></i>
            <span>Publikasi Program</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/campaign') || request()->is('*/zakat') || request()->is('*/wakaf') || request()->is('*/archive')) active @endif">
            <li>
                <a class="@if(request()->is('*/campaign')) active @endif" href="{{ url('/admin/campaign') }}">Infaq</a>
            </li>
            <li>
                <a class="@if(request()->is('*/zakat')) active @endif" href="{{ url('/admin/zakat') }}">Zakat</a>
            </li>
            <li>
                <a class="@if(request()->is('*/wakaf')) active @endif" href="{{ url('/admin/wakaf') }}">Wakaf</a>
            </li>
            <li>
                <a class="@if(request()->is('*/qurban')) active @endif" href="{{ url('/admin/qurban') }}">Qurban</a>
            </li>
            <li>
                <a class="@if(request()->is('*/pendaftaran')) active @endif" href="{{ url('/admin/pendaftaran') }}">Pendaftaran</a>
            </li>
            <li>
                <a class="@if(request()->is('*/archive')) active @endif" href="{{ url('/admin/archive') }}">Archive</a>
            </li>
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
                <a class="@if(request()->is('*/category')) active @endif" href="{{ url('/admin/category') }}">Kategori</a>
            </li>
            <li>
                <a class="@if(request()->is('*/category-ordering')) active @endif" href="{{ url('/admin/category-ordering') }}">Urutkan Kategori</a>
            </li>
            <li>
                <a class="@if(request()->is('*/order')) active @endif" href="{{ url('/admin/order') }}">Urutkan Program</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/all_donation') || request()->is('*/not_confirmed/payment_gateway') || request()->is('*/manual_donation') || request()->is('*/kurban_confirm') || request()->is('*/topup')) active @endif">
            <i class='bx bx-transfer-alt'></i>
            <span>Transaksi</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/all_donation') || request()->is('*/not_confirmed/payment_gateway') || request()->is('*/manual_donation') || request()->is('*/kurban_confirm') || request()->is('*/topup')) active @endif">
            <li>
                <a class="@if(request()->is('*/all_donation')) active @endif" href="{{ url('/admin/all_donation') }}">Semua Transaksi</a>
            </li>
            <li>
                <a class="@if(request()->is('*/not_confirmed/payment_gateway')) active @endif" href="{{ url('/admin/not_confirmed/payment_gateway') }}">Transaksi Online</a>
            </li>
            <li>
                <a class="@if(request()->is('*/manual_donation')) active @endif" href="{{ url('/admin/manual_donation') }}">Transaksi Offline</a>
            </li>
            <!-- <li>
                <a class="@if(request()->is('*/kurban_confirm')) active @endif" href="{{ url('/admin/kurban_confirm') }}">Transaksi Qurban</a>
            </li> -->
        </ul>
    </li>

    <li>
        <a class="@if(request()->is('*/donation')) active @endif" href="{{ url('/admin/donation') }}">
            <i class='bx bxs-receipt'></i>
            <span>Dana Terkumpul</span>
        </a>
    </li>

    <li>
        <a class="@if(request()->is('*/registration')) active @endif" href="{{ url('/admin/registration') }}">
            <i class='bx bxs-spreadsheet'></i>
            <span>Pendaftaran</span>
        </a>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/funding_distribution') || request()->is('*/instance_right') || request()->is('*/mediaberbagi_right') || request()->is('*/update')) active @endif">
            <i class='bx bx-right-top-arrow-circle'></i>
            <span>Penyaluran Dana</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/funding_distribution') || request()->is('*/instance_right') || request()->is('*/mediaberbagi_right') || request()->is('*/update')) active @endif">
            <li>
                <a class="@if(request()->is('*/funding_distribution')) active @endif" href="{{ url('/admin/funding_distribution') }}">Input Penyaluran</a>
            </li>
            <li>
                <a class="@if(request()->is('*/instance_right')) active @endif" href="{{ url('/admin/instance_right') }}">Input Hak Lembaga</a>
            </li>
            <li>
                <a class="@if(request()->is('*/mediaberbagi_right')) active @endif" href="{{ url('/admin/mediaberbagi_right') }}">Input MediaBerbagi</a>
            </li>
            <li>
                <a class="@if(request()->is('*/update')) active @endif" href="{{ url('/admin/update') }}">Laporan Berita</a>
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
                <a class="@if(request()->is('*/donatur')) active @endif" href="{{ url('/admin/donatur') }}">Semua Donatur</a>
            </li>
            <li>
                <a class="@if(request()->is('*/donatur/success')) active @endif" href="{{ url('/admin/donatur/success') }}">Donatur Sukses</a>
            </li>
            <li>
                <a class="@if(request()->is('*/donatur/fail')) active @endif" href="{{ url('/admin/donatur/fail') }}">Donatur Gagal</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/fundraiser') || request()->is('*/fundraiser/leaderboard') || request()->is('*/fundraiser/transaction')) active @endif">
            <i class='bx bx-user-circle'></i>
            <span>Fundraiser</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/fundraiser') || request()->is('*/fundraiser/leaderboard') || request()->is('*/fundraiser/transaction')) active @endif">
        <li>
                <a class="@if(request()->is('*/fundraiser')) active @endif" href="{{ url('/admin/fundraiser') }}">List Fundraiser</a>
            </li>
        <li>
                <a class="@if(request()->is('*/fundraiser/leaderboard')) active @endif" href="{{ url('/admin/fundraiser/leaderboard') }}">Leaderboard</a>
            </li>
            <li>
                <a class="@if(request()->is('*/fundraiser/transaction')) active @endif" href="{{ url('/admin/fundraiser/transaction') }}">Transaksi</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/slider') || request()->is('*/partner') || request()->is('*/blog-category') || request()->is('*/blog') || request()->is('*/activity') || request()->is('*/content') || request()->is('*/product')) active @endif">
            <i class='bx bx-world'></i>
            <span>Web Utama</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/slider') || request()->is('*/partner') || request()->is('*/blog-category') || request()->is('*/blog') || request()->is('*/activity') || request()->is('*/content') || request()->is('*/product')) active @endif">
            <li>
                <a class="@if(request()->is('*/slider')) active @endif" href="{{ url('/admin/slider') }}">Slider</a>
            </li>
            <li>
                <a class="@if(request()->is('*/partner')) active @endif" href="{{ url('/admin/partner') }}">Partner</a>
            </li>
            <li>
                <a class="@if(request()->is('*/blog-category')) active @endif" href="{{ url('/admin/blog-category') }}">Kategori Blog</a>
            </li>
            <li>
                <a class="@if(request()->is('*/blog')) active @endif" href="{{ url('/admin/blog') }}">Blog</a>
            </li>
            <li>
                <a class="@if(request()->is('*/activity')) active @endif" href="{{ url('/admin/activity') }}">Kegiatan</a>
            </li>
            <li>
                <a class="@if(request()->is('*/content')) active @endif" href="{{ url('/admin/content') }}">Konten</a>
            </li>
            {{-- <li>
                <a class="@if(request()->is('*/product')) active @endif" href="{{ url('/admin/product') }}">Toko Online</a>
            </li> --}}
        </ul>
    </li>
    <hr>

    <p class="p-2">Pengaturan</p>

    <li>
        <a class="@if(request()->is('*/user')) active @endif" href="{{ url('/admin/user') }}">
            <i class='bx bxs-user-detail'></i>
            <span>User</span>
        </a>
    </li>
    <li>
        <a class="@if(request()->is('*/bank')) active @endif" href="{{ url('/admin/bank') }}">
            <i class='bx bxs-bank'></i>
            <span>Data Bank</span>
        </a>
    </li>
    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/notification') || request()->is('*/whatsapp')) active @endif">
            <i class='bx bxs-notification'></i>
            <span>Notifikasi Whatsapp</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/notification') || request()->is('*/whatsapp')) active @endif">
            <li>
                <a class="@if(request()->is('*/notification')) active @endif" href="{{ url('/admin/notification') }}">Template</a>
            </li>
            <li>
                <a class="@if(request()->is('*/whatsapp')) active @endif" href="{{ url('/admin/whatsapp') }}">Connect Whatsapp</a>
            </li>
        </ul>
    </li>
    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/notif') || request()->is('*/mail_setting')) active @endif">
            <i class='bx bx-mail-send'></i>
            <span>Email </span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/notif') || request()->is('*/mail_setting')) active @endif">
            <li>
                <a class="@if(request()->is('*/notif')) active @endif" href="{{ url('/admin/notif') }}">Notifikasi Email</a>
            </li>
            <li>
                <a class="@if(request()->is('*/mail_setting')) active @endif" href="{{ url('/admin/mail_setting') }}">Mail Setting</a>
            </li>
        </ul>
    </li>
    <li>
        <a class="@if(request()->is('*/mediaberbagi')) active @endif" href="{{ url('/admin/mediaberbagi') }}">
            <i class='bx bxs-cog'></i>
            <span>Mediaberbagi Setting</span>
        </a>
    </li>
    <li>
        <a class="@if(request()->is('*/data-usage')) active @endif" href="{{ url('/admin/data-usage') }}">
            <i class='bx bxs-save'></i>
            <span>Penggunaan Data</span>
        </a>
    </li>
    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/notif') || request()->is('*/mail_setting')) active @endif">
            <i class='bx bx-line-chart'></i>
            <span>Analytics </span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/google-analytics') || request()->is('*/facebook-pixel')) active @endif">
            <li>
                <a class="@if(request()->is('*/google-analytics')) active @endif" href="{{ url('/admin/google-analytics') }}">
                    <span>Google Analytics</span>
                </a>
            </li>
            <li>
                <a class="@if(request()->is('*/facebook-pixel')) active @endif" href="{{ url('/admin/facebook-pixel') }}">
                    <span>Facebook Pixel</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a class="@if(request()->is('*/google-font')) active @endif" href="{{ url('/admin/google-font') }}">
            <i class='bx bxl-google'></i>
            <span>Google Font</span>
        </a>
    </li>
    <li>
        <a class="@if(request()->is('*/payment-gateway')) active @endif" href="{{ url('/admin/payment-gateway') }}">
            <i class='bx bx-money'></i>
            <span>Payment Gateway</span>
        </a>
    </li>
    <li>
        <a class="@if(request()->is('*/setting')) active @endif" href="{{ url('/admin/setting') }}">
            <i class='bx bxs-cog'></i>
            <span>Pengaturan</span>
        </a>
    </li>
    {{-- <li>
        <a class="@if(request()->is('*/update-software')) active @endif" href="{{ url('/admin/update-software') }}">
            <i class='bx bx-refresh'></i>
            <span>Update Software</span>
        </a>
    </li> --}}
    {{-- <li>
        <a class="@if(request()->is('*/themes')) active @endif" href="{{ url('/admin/themes') }}">
            <i class='bx bx-layout'></i>
            <span>Themes</span>
        </a>
    </li> --}}
    <li>
        <a class="@if(request()->is('*/billing')) active @endif" href="{{ url('/admin/billing') }}">
            <i class='bx bx-money'></i>
            <span>Pembayaran</span>
        </a>
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
