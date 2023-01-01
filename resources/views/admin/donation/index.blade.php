@extends('layouts.dashboard') @section('title', 'Dana Terkumpul')
@section('header', 'Dana Terkumpul') @section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body d-flex align-items-center pd-7 pb-0 row">
                <div class="col-md-6 mb-0">
                    <div class="me-auto w-55">
                        <h5 class="card-title text-white fs-30 font-w500 mt-4">
                            Dana Terkumpul
                        </h5>
                        <p class="mb-0 text-o7 fs-18 font-w500 pb-11">
                            pantau progress donasu campaign aktif
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-0"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt--2">
    <div class="col-md-12 mb-3">
        <h3>Program Instan</h3>
    </div>
    @if(count($instant) == 0)
    <div class="col-md-12 mb-3">
        <div class="box">
            <div class="box-body">
                <h3>Belum Ada Penggalangan Dana</h3>
                <p>mulai galang dana sekarang</p>
            </div>
        </div>
    </div>
    @else @foreach($instant as $k => $v)
    <div class="col-md-12 mb-3">
        <div class="box mb-4">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2 mb-0">
                        <img
                            class="img-responsive"
                            src="{{ asset('assets/img/sedekah-icon.svg') }}"
                            alt="Card image cap"
                        />
                    </div>
                    <div class="col-md-10 mb-0">
                        <a
                            href="{{
                                url('/admin/donation/instant/'.$v['key'])
                            }}"
                        >
                            <h4 class="mb-0">{{ $v["title"] }}</h4>
                        </a>
                        <p class="text-primary">Tidak Terikat</p>
                        <div class="row">
                            <div class="col-6 mb-0 text-primary">
                                {{
                                    str_replace(
                                        ",",
                                        ".",
                                        number_format($v["donations"])
                                    )
                                }}
                            </div>
                            <div class="col-6 mb-0 text-right">
                                {{ $v["donatur"] }} Donatur
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach @endif
</div>

<div class="row mt--2">
    <div class="col-md-12 mb-3">
        <h3>Program Terikat</h3>
    </div>
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <form action="{{ url()->current() }}">
            <input @if(request()->q) value="{{ request()->q }}" @endif name="q" type="text" class="form-control" placeholder="Cari data...">
        </form>
    </div>
    @if(count($datas) == 0)
    <div class="col-md-12 mb-3">
        <div class="box">
            <div class="box-body">
                <h3>Belum Ada Penggalangan Dana</h3>
                <p>mulai galang dana sekarang</p>
            </div>
        </div>
    </div>
    @else @foreach($datas as $k => $v)
    <div class="col-md-12 mb-3">
        <div class="box mb-4">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2 mb-0">
                        @if($v->path_featured == null)
                        <img
                            class="img-responsive"
                            src="{{ asset('images/project.jpg') }}"
                            alt="Card image cap"
                        />
                        @else
                        <img
                            class="img-responsive"
                            src="{{ asset('storage/'.$v->path_featured) }}"
                            alt="Card image cap"
                        />
                        @endif
                    </div>
                    <div class="col-md-10 mb-0">
                        <a href="{{ url('/admin/donation/' . $v->id) }}">
                            <h4 class="mb-0">{{ $v->title }}</h4>
                        </a>
                        <p class="text-primary">Program</p>
                        <div class="bg-grey" style="border-radius: 0.25rem">
                            <div class="progress">
                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="width: {{ $v->percentage }}%"
                                    aria-valuenow="{{ $v->percentage }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-0 text-primary">
                                {{ str_replace(',', '.', number_format($v->donations)) }}
                            </div>
                            <div class="col-6 mb-0 text-right">
                                {{ $v->donatur }} Donatur
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="col-md-12 mt-4">
        {{ $datas->links() }}
    </div>
    @endif
</div>

@endsection @section('js') @endsection
