<ul class="sidebar-menu tf">

    <li>
        <a href="{{ url('/gerai') }}" class="@if(request()->is('gerai')) active @endif">
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
                <a class="@if(request()->is('*/manual_donation')) active @endif" href="{{ url('/gerai/manual_donation') }}">Transaksi Offline</a>
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
