<ul class="sidebar-menu tf">

    <li>
        <a href="{{ url('/fundraiser') }}" class="@if(request()->is('fundraiser')) active @endif">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li>
        <a href="{{ url('/fundraiser/commission') }}" class="@if(request()->is('fundraiser/commission')) active @endif">
            <i class='bx bxs-wallet'></i>
            <span>Riwayat Komisi</span>
        </a>
    </li>

    <li>
        <a href="{{ url('/fundraiser/withdrawal') }}" class="@if(request()->is('fundraiser/withdrawal')) active @endif">
            <i class='bx bxs-download'></i>
            <span>Penarikan Komisi</span>
        </a>
    </li>

    <li>
        <a href="{{ url('/fundraiser/transaction') }}" class="@if(request()->is('fundraiser/transaction')) active @endif">
            <i class='bx bxs-exit'></i>
            <span>Riwayat Transaksi</span>
        </a>
    </li>

    <li>
        <a class="@if(request()->is('*/bank')) active @endif" href="{{ url('/fundraiser/bank') }}">
            <i class='bx bxs-bank'></i>
            <span>Data Bank</span>
        </a>
    </li>

    <li>
        <a href="{{ url('/fundraiser/profile') }}" class="@if(request()->is('fundraiser/profile')) active @endif">
            <i class='bx bxs-user'></i>
            <span>Profil</span>
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
