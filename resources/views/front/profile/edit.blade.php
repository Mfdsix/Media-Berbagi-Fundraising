@extends('layouts.mb-app')

@section('title', 'Edit Profil')
@section('css')
{{--font awesome --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<style type="text/css">
    .img-round{
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }
    .btn-primary{
        background: var(--primary-color) !important;
        border-color: var(--primary-color);
    }
    .btn-primary:hover{
        border-color: var(--primary-color);
    }
    .password{
        overflow: hidden;
        border: 1px solid #ced4da;
    }
    .password input,.password button{
        border: none;
    }
    .password button,.password button:focus,.password button:hover{
        background: transparent;
        outline: none !important;
    }
</style>
@endsection

@section('content')
@include('layouts.mb-nav-top-secondary-3', ['title' => 'Akun Saya'])

<!-- MAIN -->
<main id="main-page-belum-login" class="min-vh-100 bg-white padding-b-100px">
    <div class="container">
    <div class="row">

        <div class="col-12">

        @include('layouts.notif')

        <form form method="POST" class="bg-white rounded p-4 mb-2" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-4">
                @if($user->path_foto != null)
                <img id="img-profile" src="{{ asset('storage/'.$user->path_foto) }}" class="img-round">
                @else
                <img id="img-profile" src="{{ asset('images/user.png') }}" class="img-round">
                @endif
                <p class="mt-3">
                    <small><button type="button" id="btn-change-foto" class="rounded-pill btn btn-primary btn-sm">Ubah Foto</button></small>
                </p>
            </div>

            <input type="file" accept="png,jpeg,jpg" name="foto" style="display: none;">

            <div class="mb-3">
                <label class="text-secondary">Nama Lengkap</label>
                <input type="text" name="name" class="rounded-pill form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ $user->name }}">
                @error('name')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="text-secondary">Email</label>
                <input type="email" name="email" class="rounded-pill form-control @error('email') is-invalid @enderror" placeholder="Alamat Email" value="{{ $user->email }}">
                @error('email')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- password lama with toggle eye --}}
            <div class="mb-4">
                <label class="text-secondary">Password Lama</label>
                <div class="input-group rounded-pill password">
                    <input type="password" name="password_lama" class="form-control @error('password_lama') is-invalid @enderror" placeholder="Password Lama">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="btn-toggle-password-lama">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                @error('password_lama')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- password baru with toggle eye --}}
            <div class="mb-4">
                <label class="text-secondary">Password Baru</label>
                <div class="input-group rounded-pill password">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Baru">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text" id="btn-toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                @error('password')
                <div class="text-twelve text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="submit mt-3 mb-2 btn-primary btn font-weight-bold">Simpan</button>
            </div>
        </div>
        
    </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    // btn toggle eye password
    $('#btn-toggle-password').click(function(){
        var input = $('input[name="password"]');
        if(input.attr('type') == 'password'){
            input.attr('type', 'text');
        }else{
            input.attr('type', 'password');
        }
    });
    // btn toggle eye password lama
    $('#btn-toggle-password-lama').click(function(){
        var input = $('input[name="password_lama"]');
        if(input.attr('type') == 'password'){
            input.attr('type', 'text');
        }else{
            input.attr('type', 'password');
        }
    });

    $(document).ready(function(){
        $("#btn-change-foto").on("click", function(){
            $("input[name='foto']").click();
        });

        $("input[name='foto']").on("change", function(){
            if($(this).val() != null){
                var input = this;
                var url = $(this).val();
                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                if (input.files && input.files[0] && (ext == "png" || ext == "jpeg" || ext == "jpg"))
                {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-profile').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                else
                {
                    alert("Format Tidak Didukung");
                    $(this).val("");
                }
            }
        })
    });
</script>
@endsection