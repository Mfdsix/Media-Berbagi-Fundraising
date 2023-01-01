<ul class="sidebar-menu tf">

    <li>
        <a href="{{ url('/accounting') }}" class="@if(request()->is('accounting')) active @endif">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr>

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
                <a class="@if(request()->is('*/all_donation')) active @endif" href="{{ url('/accounting/all_donation') }}">Semua Transaksi</a>
            </li>
            <li>
                <a class="@if(request()->is('*/not_confirmed/payment_gateway')) active @endif" href="{{ url('/accounting/not_confirmed/payment_gateway') }}">Transaksi Online</a>
            </li>
            <li>
                <a class="@if(request()->is('*/manual_donation')) active @endif" href="{{ url('/accounting/manual_donation') }}">Transaksi Offline</a>
            </li>
        </ul>
    </li>

    <li>
        <a class="@if(request()->is('*/donation')) active @endif" href="{{ url('/accounting/donation') }}">
            <i class='bx bxs-receipt'></i>
            <span>Dana Terkumpul</span>
        </a>
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
        @if(request()->is('*/funding_distribution') || request()->is('*/instance_right') || request()->is('*/mediaberbagi_right')) active @endif">
            <li>
                <a class="@if(request()->is('*/funding_distribution')) active @endif" href="{{ url('/accounting/funding_distribution') }}">Input Penyaluran</a>
            </li>
            <li>
                <a class="@if(request()->is('*/instance_right')) active @endif" href="{{ url('/accounting/instance_right') }}">Input Hak Lembaga</a>
            </li>
            <li>
                <a class="@if(request()->is('*/mediaberbagi_right')) active @endif" href="{{ url('/accounting/mediaberbagi_right') }}">Input Hak Media Berbagi</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-submenu">
        <a href="javascript:void(0)" class="sidebar-menu-dropdown
        @if(request()->is('*/fundraiser/leaderboard')) active @endif">
            <i class='bx bx-user-circle'></i>
            <span>Fundraiser</span>
            <div class="dropdown-icon">
                <i class='bx bx-chevron-down'></i>
            </div>
        </a>
        <ul class="sidebar-menu sidebar-menu-dropdown-content
        @if(request()->is('*/fundraiser/withdrawal')) active @endif">
            <li>
                <a class="@if(request()->is('*/fundraiser/withdrawal')) active @endif" href="{{ url('/accounting/fundraiser/withdrawal') }}">Penarikan Komisi</a>
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
