@extends('layouts.mb-app')

@section('title', 'Landing Fundraiser')
@section('css')
@endsection

@section('content')
<!-- NAV TOP -->
@include('layouts.mb-nav-top-secondary-2', ['title' => 'Landing Fundraiser'])
<!-- PAGE FUNDRAISER SEBELUM LOGIN MAIN -->
<main id="page-fundraiser-landing" class="bg-white">
    <div class="container">
        <div class="row margin-b-32px">
            <div class="col-12 text-center">
                <p class="p-fundraiser-text">Terima kasih atas kesediaan Anda untuk bergabung dalam {{envdb('APP_NAME')}}. Untuk melanjutkan menggunakan fitur Fundraiser, silahkan lengkapi data berikut ini.</p>
            </div>
        </div>
        <form method="post" class="row">
            @csrf
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="type">Jenis Registrant</label>
                <select name="type" id="type" class="input-fundraiser-form" onchange="selectType()">
                    <option @if(old('type') == 'personal') selected @endif value="personal">Perorangan</option>
                    <option @if(old('type') == 'instance') selected @endif value="instance">Lembaga</option>
                </select>
                @error('type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="fullname">Nama Fundraiser</label>
                <input class="input-fundraiser-form" type="text" id="fullname" name="fullname" placeholder="Contoh : Media Berbagi" value="{{ old('name') ?? ($user ? $user->name : null) }}">
                @error('fullname')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="email">Alamat Email</label>
                <input class="input-fundraiser-form" type="text" id="email" name="email" placeholder="Contoh : mediaberbagi@gmail.com" value="{{ old('email') ?? ($user ? $user->email : null) }}">
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="phone">No Whatsapp</label>
                <input class="input-fundraiser-form" type="text" id="phone" name="phone" placeholder="Contoh : 08472929273838" value="{{ old('phone') ?? ($user ? $user->phone : null) }}">
                @error('phone')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 margin-b-24px d-none" id="pic">
                <label class="label-fundraiser-text" for="person_in_charge">Penanggung Jawab</label>
                <input class="input-fundraiser-form" type="text" id="person_in_charge" name="person_in_charge" value="{{ old('person_in_charge') }}">
                @error('person_in_charge')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="nama_affiliater">Kota</label>
                <input class="input-fundraiser-form" type="text" id="nama_affiliater">
            </div> -->
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="province">Provinsi</label>
                <select name="province" id="province" class="input-fundraiser-form" onchange="selectCity()">
                    <option value="">Pilih Provinsi</option>
                    @foreach($provinces as $v)
                    <option @if(old('province') == $v->provinsi) selected @endif value="{{ $v->provinsi }}" data-city="{{base64_encode(json_encode($v->kota))}}">{{ $v->provinsi }}</option>
                    @endforeach
                </select>
                @error('province')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="city">Kota</label>
                <select name="city" id="city" class="input-fundraiser-form">
                    <option value="">Pilih kota</option>
                </select>
                @error('city')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <!-- <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="nama_affiliater">Referensi</label>
                <input class="input-fundraiser-form" type="text" id="nama_affiliater">
            </div>
             -->
             @if(!$user)
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="nama_affiliater">Password</label>
                <div class="position-relative">
                    <!-- <svg class="input-fundraiser-form-password-svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.073 12.194L4.212 8.33297C2.692 9.98997 2.116 11.65 2.106 11.684L2 12L2.105 12.316C2.127 12.383 4.421 19 12.054 19C12.983 19 13.829 18.898 14.606 18.727L11.86 15.981C10.8713 15.9325 9.93595 15.518 9.23598 14.818C8.53601 14.118 8.12147 13.1827 8.073 12.194ZM12.054 4.99997C10.199 4.99997 8.679 5.40397 7.412 5.99797L3.707 2.29297L2.293 3.70697L20.293 21.707L21.707 20.293L18.409 16.995C21.047 15.042 21.988 12.358 22.002 12.316L22.107 12L22.002 11.684C21.98 11.617 19.687 4.99997 12.054 4.99997ZM13.96 12.546C14.147 11.869 13.988 11.107 13.468 10.586C12.948 10.065 12.185 9.90697 11.508 10.094L10 8.58597C10.618 8.20595 11.3285 8.00322 12.054 7.99997C14.26 7.99997 16.054 9.79397 16.054 12C16.051 12.7253 15.8479 13.4357 15.467 14.053L13.96 12.546Z" fill="black"/>
                    </svg> -->
                    <input name="password" class="input-fundraiser-form pr-5" type="password" id="nama_affiliater">
                </div>
            </div>
            <div class="col-12 margin-b-24px">
                <label class="label-fundraiser-text" for="nama_affiliater">Konfirmasi Password</label>
                <div class="position-relative">
                    <!-- <svg class="input-fundraiser-form-password-svg" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.073 12.194L4.212 8.33297C2.692 9.98997 2.116 11.65 2.106 11.684L2 12L2.105 12.316C2.127 12.383 4.421 19 12.054 19C12.983 19 13.829 18.898 14.606 18.727L11.86 15.981C10.8713 15.9325 9.93595 15.518 9.23598 14.818C8.53601 14.118 8.12147 13.1827 8.073 12.194ZM12.054 4.99997C10.199 4.99997 8.679 5.40397 7.412 5.99797L3.707 2.29297L2.293 3.70697L20.293 21.707L21.707 20.293L18.409 16.995C21.047 15.042 21.988 12.358 22.002 12.316L22.107 12L22.002 11.684C21.98 11.617 19.687 4.99997 12.054 4.99997ZM13.96 12.546C14.147 11.869 13.988 11.107 13.468 10.586C12.948 10.065 12.185 9.90697 11.508 10.094L10 8.58597C10.618 8.20595 11.3285 8.00322 12.054 7.99997C14.26 7.99997 16.054 9.79397 16.054 12C16.051 12.7253 15.8479 13.4357 15.467 14.053L13.96 12.546Z" fill="black"/>
                    </svg> -->
                    <input name="password_confirmation" class="input-fundraiser-form pr-5" type="password" id="nama_affiliater">
                </div>
            </div>
            @endif
            <div class="col-12 mb-4">
                <button type="submit" class="button-fundraiser-submit">Jadi Fundraiser</button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('js')
<script>
    function selectType() {
        let type = $("#type").val()
        if (type == "personal") {
            if(!$("#pic").hasClass("d-none")) {
                $("#pic").addClass("d-none")
            }
        } else {
           $("#pic").removeClass("d-none")
        }
    }
    function selectCity() {
        let html = "<option value=''>Pilih kota</option>"
        let city = $("#province option:selected").data('city')
        city = JSON.parse(atob(city))

        city.forEach(e=>{
            html += "<option>"+e+"</option>"
        })
        $("#city").html(html)
    }
</script>
<!-- FUNDRAISER JS -->
<script src="{{ asset('assets/media-berbagi/styles/js/fundraiser.js') }}"></script>
@endsection
