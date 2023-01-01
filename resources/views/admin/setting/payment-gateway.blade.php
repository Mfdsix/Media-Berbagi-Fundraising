@extends('layouts.dashboard')
@section('title', 'Payment Gateway')

@section('header', "Payment Gateway")

@section('css')
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body d-flex align-items-center pd-7 pb-0 row">
                <div class="col-md-12 mb-0">
                    <div class="me-auto w-55">
                        <h5 class="card-title text-white fs-30 font-w500 mt-4">Payment Gateway</h5>
                        <p class="mb-0 text-o7 fs-18 font-w500 pb-11">atur payment gateway yang anda gunakan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt--2">
    <div class="col-md-12">
        <form class="box" action="{{ url('admin/payment-gateway') }}" method="post">
            @csrf

            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="mb-4 mt-4">
                            <label for="vendor">Vendor Payment Gateway</label>
                            <select id="vendor-options" name="vendor" id="vendor" required class="form-control">
                                <option @if($setting->payment_gateway_vendor == 'faspay') selected @endif value="faspay">Faspay</option>
                                <option @if($setting->payment_gateway_vendor == 'tripay') selected @endif value="tripay">Tripay</option>
                                <option @if($setting->payment_gateway_vendor == 'durian') selected @endif value="durian">DurianPay</option>
                            </select>
                            @error('vendor')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div id="faspay-form" class="payment-gateway-form">
                            <div class="mb-4">
                                <label for="faspay_merchant_url">MODE</label>
                                <select name="faspay_merchant_url" id="faspay_merchant_url" class="form-control">
                                    <option @if(isset($datas['faspay_merchant_url']) && $datas['faspay_merchant_url'] == 'https://debit-sandbox.faspay.co.id/') selected @endif value="https://debit-sandbox.faspay.co.id/">Development</option>
                                    <option @if(isset($datas['faspay_merchant_url']) && $datas['faspay_merchant_url'] == 'https://web.faspay.co.id/') selected @endif value="https://web.faspay.co.id/">Production</option>
                                </select>
                                @error('faspay_merchant_url')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="faspay_merchant_name">MERCHANT NAME</label>
                                <input name="faspay_merchant_name" type="text" class="form-control" value="{{ isset($datas['faspay_merchant_name']) ? $datas['faspay_merchant_name'] : ''}}">
                                @error('faspay_merchant_name')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="faspay_merchant_id">MERCHANT ID</label>
                                <input name="faspay_merchant_id" type="text" class="form-control" value="{{ isset($datas['faspay_merchant_id']) ? $datas['faspay_merchant_id'] : ''}}">
                                @error('faspay_merchant_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="faspay_merchant_user">MERCHANT USER</label>
                                <input name="faspay_merchant_user" type="text" class="form-control" value="{{ isset($datas['faspay_merchant_user']) ? $datas['faspay_merchant_user'] : ''}}">
                                @error('faspay_merchant_user')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="faspay_merchant_password">MERCHANT PASSWORD</label>
                                <input name="faspay_merchant_password" type="text" class="form-control" value="{{ isset($datas['faspay_merchant_password']) ? $datas['faspay_merchant_password'] : ''}}">
                                @error('faspay_merchant_password')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div id="tripay-form" class="payment-gateway-form">
                        <div class="mb-4">
                                <label for="tripay_merchant_url">MODE</label>
                                <select name="tripay_merchant_url" id="tripay_merchant_url" class="form-control">
                                    <option @if(isset($datas['tripay_merchant_url']) && $datas['tripay_merchant_url'] == 'https://tripay.co.id/api-sandbox/') selected @endif value="https://tripay.co.id/api-sandbox/">Sandbox</option>
                                    <option @if(isset($datas['tripay_merchant_url']) && $datas['tripay_merchant_url'] == 'https://tripay.co.id/api/') selected @endif value="https://tripay.co.id/api/">Production</option>
                                </select>
                                @error('tripay_merchant_url')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tripay_merchant_code">MERCHANT CODE</label>
                                <input name="tripay_merchant_code" type="text" class="form-control" value="{{ isset($datas['tripay_merchant_code']) ? $datas['tripay_merchant_code'] : ''}}">
                                @error('tripay_merchant_code')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tripay_merchant_api_key">MERCHANT API KEY</label>
                                <input name="tripay_merchant_api_key" type="text" class="form-control" value="{{ isset($datas['tripay_merchant_api_key']) ? $datas['tripay_merchant_api_key'] : ''}}">
                                @error('tripay_merchant_api_key')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="tripay_merchant_private_key">MERCHANT PRIVATE KEY</label>
                                <input name="tripay_merchant_private_key" type="text" class="form-control" value="{{ isset($datas['tripay_merchant_private_key']) ? $datas['tripay_merchant_private_key'] : ''}}">
                                @error('tripay_merchant_private_key')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div id="durian-form" class="payment-gateway-form">
                            <input style="display: none;" type="hidden" name="durian_merchant_url" value="https://api.durianpay.id/v1/"/>

                            <div class="mb-4">
                                <label for="durian_merchant_api_key">MERCHANT API KEY</label>
                                <input name="durian_merchant_api_key" type="text" class="form-control" value="{{ isset($datas['durian_merchant_api_key']) ? $datas['durian_merchant_api_key'] : ''}}">
                                @error('durian_merchant_api_key')
                                <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                    </div>

                    </div>

                <div class="gr-btn text-end">
                    <button class="btn btn-primary btn-lg fs-16">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(".payment-gateway-form").hide();
    $(document).ready(function(){
        changeForm();

        $("#vendor-options").on("change", function(){
            changeForm();
        })
    })

    function changeForm(){
        var value = $("#vendor-options").val();

        $(".payment-gateway-form").hide();
        if(value == "faspay"){
            $("#faspay-form").show(500);
        }
        if(value == "tripay"){
            $("#tripay-form").show(500);
        }
        if(value == "durian"){
            $("#durian-form").show(500);
        }
    }

</script>
@endsection
