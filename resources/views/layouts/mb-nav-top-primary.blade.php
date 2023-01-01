<nav id="nav-top-primary">
    <div class="container">
        <div class="row h-75px">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div>
                    <button type="button" class="nav-top-primary__button__burger" data-open="false">
                        <svg width="29" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4.31152" width="20.1213" height="4.3117" rx="2.15585" fill="white"/>
                            <rect x="4.31152" y="22.9957" width="20.1213" height="4.3117" rx="2.15585" fill="white"/>
                            <rect y="11.4979" width="28.7447" height="4.3117" rx="2.15585" fill="white"/>
                        </svg>
                    </button>
                </div>
                <div class="d-flex align-items-center">
                    <button type="button" class="nav-top-primary__button__search" data-open="false">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_238_3862)">
                            <path d="M9.68834 0C4.34633 0 0 4.34633 0 9.68834C0 15.0306 4.34633 19.3767 9.68834 19.3767C15.0306 19.3767 19.3767 15.0306 19.3767 9.68834C19.3767 4.34633 15.0306 0 9.68834 0ZM9.68834 17.5881C5.33246 17.5881 1.78862 14.0442 1.78862 9.68838C1.78862 5.33251 5.33246 1.78862 9.68834 1.78862C14.0442 1.78862 17.5881 5.33246 17.5881 9.68834C17.5881 14.0442 14.0442 17.5881 9.68834 17.5881Z" fill="white"/>
                            <path d="M21.738 20.4734L16.6106 15.346C16.2612 14.9966 15.6954 14.9966 15.346 15.346C14.9966 15.6951 14.9966 16.2615 15.346 16.6106L20.4734 21.738C20.6481 21.9126 20.8768 22 21.1057 22C21.3344 22 21.5633 21.9126 21.738 21.738C22.0874 21.3889 22.0874 20.8225 21.738 20.4734Z" fill="white"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_238_3862">
                            <rect width="22" height="22" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </button>
                    <button type="button" class="nav-top-primary__button__image" data-open="false">
                        @guest
                            <img src="{{ getThumb(asset('images/user.png'),128,128) }}" alt="User 1">
                        @endguest

                        @auth
                            @if(Auth::user()->path_foto == null)
                                <img src="{{ getThumb(asset('images/user.png'),128,128) }}" alt="User 1">
                            @else
                                <img src="{{ getThumb( asset('/storage/'.Auth::user()->path_foto),128,128) }}">
                            @endif
                        @endauth
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- CATEGORY -->
    <div id="nav-top-primary-burger" class="container-fluid">
        <h3 class="nav-top-primary__title">Kategori Program</h3>
        <div class="d-flex flex-wrap" style="gap: 16px 20px;">
            @foreach($categories as $k => $v)
            <a href='/program/c/{{ $v->id }}' class="nav-top-primary__category">
                @if($v->image == null)
                <img src="https://images.unsplash.com/photo-1639599629730-5710b6e18363?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80">
                @else
                <img src="{{ getThumb(asset('/storage/'.$v->image),254,87) }}">
                @endif
                <div class="nav-top-primary__cover">
                    <h2 class="nav-top-primary__cover__title">{{ $v->category }}</h2>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <!-- SEARCH -->
    <div id="nav-top-primary-search" class="container-fluid">
        <div class="row">
            <form action="{{ url('search') }}" method="GET" class="col-12 px-2 position-relative">
                <input class="nav-top-primary__search__input" type="text" name="q" placeholder="Coba cari “Bencana alam”">
                <button class="nav-top-primary__search__submit" type="submit">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_238_4322)">
                        <path d="M7.04606 0C3.16097 0 0 3.16097 0 7.04606C0 10.9314 3.16097 14.0921 7.04606 14.0921C10.9314 14.0921 14.0921 10.9314 14.0921 7.04606C14.0921 3.16097 10.9314 0 7.04606 0ZM7.04606 12.7913C3.87816 12.7913 1.30081 10.214 1.30081 7.04609C1.30081 3.87819 3.87816 1.30081 7.04606 1.30081C10.214 1.30081 12.7913 3.87816 12.7913 7.04606C12.7913 10.214 10.214 12.7913 7.04606 12.7913Z" fill="#646464"/>
                        <path d="M15.809 14.8898L12.08 11.1608C11.8259 10.9067 11.4144 10.9067 11.1603 11.1608C10.9062 11.4147 10.9062 11.8266 11.1603 12.0805L14.8893 15.8095C15.0164 15.9365 15.1827 16 15.3492 16C15.5155 16 15.682 15.9365 15.809 15.8095C16.0631 15.5556 16.0631 15.1437 15.809 14.8898Z" fill="#646464"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_238_4322">
                        <rect width="16" height="16" fill="white"/>
                        </clipPath>
                        </defs>
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <!-- IMAGE: NOT LOGIN -->
    @guest
    <div id="nav-top-primary-image" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h4 class="nav-top-primary-image_title px-4">Yuk Bergabung menjadi pasukan kebaikan {{ envdb('APP_NAME') }} indonesia</h4>
            </div>
        </div>
        <form form method="POST" action="{{ route('login') }}" class="row">
            @include('layouts.notif')
            @csrf
            @if(request()->has('t'))
            <input type="hidden" name="url" value="{{ trim(base64_decode(request()->t)) }}">
            @endif
            <div class="col-12 mb-2">
                <input class="nav-top-primary-image__input" type="email" name="email" placeholder="Alamat Email">
                @error('email')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <input class="nav-top-primary-image__input" type="password" name="password" placeholder="Kata Sandi">
                @error('password')
                <div class="text-twelve  text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-12 text-right mt-2 mb-1">
                <a href="/forgot-password" class="nav-top-primary-image__lupa__sandi">Lupa kata sandi?</a>
            </div>
            <div class="col-12 mb-4">
                <button type="submit" class="nav-top-primary-image__button__login">Login</button>
            </div>
            <div class="col-12 text-center mb-5">
                <p class="nav-top-primary-image__daftar__sekarang">Belum punya akun? <a href="/register">Daftar sekarang</a></p>
            </div>
            <!-- <div class="col-12 text-center mt-2 mb-3">
                <p class="nav-top-primary-image__atau__masuk">Atau masuk dengan</p>
            </div>
            <div class="col-12 mb-2">
                <img class="nav-top-primary-image__image__gf" src="{{ asset('assets/media-berbagi/assets/images/website/nav-login-google.png') }}" alt="Google">
                <button type="button" class="nav-top-primary-image__button__gf">Google</button>
            </div>
            <div class="col-12 mt-1">
                <img class="nav-top-primary-image__image__gf" src="{{ asset('assets/media-berbagi/assets/images/website/nav-login-facebook.png') }}" alt="Google">
                <button type="button" class="nav-top-primary-image__button__gf">Facebook</button>
            </div> -->
        </form>
    </div>
    @endguest
    <!-- IMAGE: LOGIN -->
    @auth
    <div id="nav-top-primary-image-login" class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center mb-3">
                <div class="akun-image-circle mx-auto">
                    @if(Auth::user()->path_foto == null)
                    <img src="{{ getThumb(asset('images/user.png'),128,128) }}" alt="User 1">
                    @else
                    <img src="{{ getThumb( asset('/storage/'.Auth::user()->path_foto),128,128) }}" alt="#">
                    @endif
                </div>
            </div>
            <div class="col-12 text-center">
                <div class="position-relative">
                    <b>{{ $user->name }}</b>
                    <a href="{{ url('my-account/edit') }}" class="akun-login-input-pencil">
                        <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-pencil.svg') }}" alt="#">
                    </a>
                </div>
                @if($user->is_fundraiser == 1)
                <p class="akun-login-founder">Fundraser {{envdb('APP_NAME')}}</p>
                @else
                <p class="akun-login-founder">Donatur {{envdb('APP_NAME')}}</p>
                @endif
            </div>
        </div>
        @if($user->is_fundraiser == 1)
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <div class="w-45pc text-center">
                    <p class="akun-text-two-line-title">Pencapian</p>
                    <div class="akun-text-two-line-text">{{ ($user->fundraiser->success_transaction > 0 && $user->fundraiser->transaction > 0) ? ceil($user->fundraiser->success_transaction / $user->fundraiser->transaction * 100) : 0 }}%</div>
                </div>
                <div class="mx-auto">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-line.svg') }}" alt="#">
                </div>
                <div class="w-45pc text-center">
                    <p class="akun-text-two-line-title">Total Klik</p>
                    <div class="akun-text-two-line-text">{{ $user->fundraiser->clicks }}</div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <a href="/fundraiser" class="col-12 d-flex flex-wrap align-items-center pt-3">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-chart.svg') }}" alt="#">
                </div>
                <span class="akun-label-icon-2">Buka Dashboard</span>
                <div class="ml-auto">
                    <span class="akun-label-new py-1 px-3 mr-4">New</span>
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-right.svg') }}" alt="#">
                </div>
                <div class="w-100 mt-3" style="border-bottom: 0.5px solid #DFDFDF;"></div>
            </a>
            <a href="#" class="col-12 d-flex flex-wrap align-items-center pt-3">
                <div class="mr-4">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-help.svg') }}" alt="#">
                </div>
                <span class="akun-label-icon-2">Bantuan</span>
                <div class="ml-auto">
                    <img src="{{ asset('assets/media-berbagi/assets/images/svg/akun-login-right.svg') }}" alt="#">
                </div>
                <div class="w-100 mt-3" style="border-bottom: 0.5px solid #DFDFDF;"></div>
            </a>
        </div>
        @else
            @if(Auth::user()->level == 'admin')
            <div class="row">
                <div class="col-12 mt-2">
                    <form action="/admin">
                        <button type="submit" class="akun-button-keluar">Ke Dashboard</button>
                    </form>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-12 mt-2">
                    <form action="/register/fundraiser">
                        <button type="submit" class="akun-button-keluar">Daftar Jadi Fundraiser</button>
                    </form>
                </div>
            </div>
            @endif
        @endif
        <div class="row">
            <div class="col-12 mt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="akun-button-keluar">Keluar</button>
                </form>
            </div>
        </div>
    </div>
    @endauth
</nav>
