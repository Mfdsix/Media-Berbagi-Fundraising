@extends('layouts.dashboard')
@section('title', 'Profil')

@section('header', 'Profil')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body d-flex align-items-center pd-7 pb-0 row">
                <div class="col-md-12 mb-0">
                    <div class="me-auto w-55">
                        <h5 class="card-title text-white fs-30 font-w500 mt-4">Profil</h5>
                        <p class="mb-0 text-o7 fs-18 font-w500 pb-11">update profil anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form class="box" enctype="multipart/form-data" method="post">
            <div class="box-body">
                <div class="row">
                    @if(isset($data))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    @csrf
                    <div class="col-md-12 col-lg-12">
                        <div class="mb-4">
                            <label class="label-fundraiser-text" for="type">Jenis Registrant</label>
                            <select name="type" id="type" class="form-control">
                                <option @if($fundraiser->type == 'personal') selected @endif value="personal">Perorangan</option>
                                <option @if($fundraiser->type == 'instance') selected @endif value="instance">Lembaga</option>
                            </select>
                            @error('type')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="label-fundraiser-text" for="fullname">Nama Fundraiser</label>
                            <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Contoh : Media Berbagi" value="{{ $fundraiser->fullname }}">
                            @error('fullname')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="label-fundraiser-text" for="email">Alamat Email</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Contoh : mediaberbagi@gmail.com" value="{{ $fundraiser->email }}">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="label-fundraiser-text" for="phone">No Whatsapp</label>
                            <input class="form-control" type="text" id="phone" name="phone" placeholder="Contoh : 08472929273838" value="{{ $fundraiser->phone }}">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="label-fundraiser-text" for="person_in_charge">Penanggung Jawab</label>
                            <input class="form-control" type="text" id="person_in_charge" name="person_in_charge" value="{{ $fundraiser->person_in_charge }}">
                            @error('person_in_charge')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="label-fundraiser-text" for="province">Provinsi</label>
                            <select name="province" id="province" class="form-control">
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces as $k => $v)
                                <option @if($fundraiser->province == $v) selected @endif value="{{ $v }}">{{ $v }}</option>
                                @endforeach
                            </select>
                            @error('province')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="gr-btn text-end">
                            <button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
