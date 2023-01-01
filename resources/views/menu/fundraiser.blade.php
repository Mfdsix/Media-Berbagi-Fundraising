<li class="nav-item @if(request()->is('fundraiser')) active @endif">
	<a href="{{ url('fundraiser') }}">
		<i class="fas fa-home"></i>
		<p>Dashboard</p>
	</a>
</li>
<!--  -->
@if(auth()->user()->fundraiser->is_confirmed == 1)
<li class="nav-section">
	<span class="sidebar-mini-icon">
		<i class="fa fa-ellipsis-h"></i>
	</span>
	<h4 class="text-section">MENU UTAMA</h4>
</li>

<li class="nav-item @if(request()->is('fundraiser/funding*')) active @endif">
	<a href="{{ url('fundraiser/funding') }}">
		<i class="fas fa-handshake"></i>
		<p>Galang Dana</p>
	</a>
</li>
<li class="nav-item @if(request()->is('fundraiser/donation*')) active @endif">
	<a href="{{ url('fundraiser/donation') }}">
		<i class="fas fa-coins"></i>
		<p>Dana Terkumpul</p>
	</a>
</li>
<li class="nav-item @if(request()->is('fundraiser/update*')) active @endif">
	<a href="{{ url('fundraiser/update') }}">
		<i class="fas fa-newspaper"></i>
		<p>Buat Update</p>
	</a>
</li>
<li class="nav-item @if(request()->is('fundraiser/withdrawal*')) active @endif">
	<a href="{{ url('fundraiser/withdrawal') }}">
		<i class="fas fa-credit-card"></i>
		<p>Penarikan Dana</p>
	</a>
</li>
@endif