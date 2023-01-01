@extends('layouts.dashboard')
@section('title', 'Update Software')

@section('header', "Update Software")

@section('css')
<style>
ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 3;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 48px;
}
ul.timeline > li:before {
    content: ' ';
    background: var(--main-color);
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    left: 24px;
    width: 12px;
    height: 12px;
    z-index: 4;
}
</style>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body d-flex align-items-center pd-7 pb-0 row">
				<div class="col-md-12 mb-0">
					<div class="me-auto w-55">
						<h5 class="card-title text-white fs-30 font-w500 mt-4">Update Software</h5>
						<p class="mb-0 text-o7 fs-18 font-w500 pb-11">kustom font yang anda gunakan di website dengan google font</p>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="col-md-12">
        <div class="box">
			<div class="box-body">
                <div class="d-flex justify-content-between">
                    <div>
                        Versi Sekarang {{exec('git tag')}}
                    </div>
                    @if( version_compare( exec('git tag'), $current,'<') )
                        <a href="?update=true" class="btn btn-primary">Update Now {{$current}}</a>
                    @else
                        <a href="#" class="btn btn-light">No Update Available</a>
                    @endif
                </div>
                <div class="mt-4">
                    <h4>Changelog</h4>
                    {!! $changelog !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
