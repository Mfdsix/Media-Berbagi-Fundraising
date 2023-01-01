<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/global.css">
    <link rel="stylesheet" href="./assets/css/variable.css">
    <link rel="stylesheet" href="./assets/css/wallet.css">

    <title>Payment Page</title>
</head>

<body>

    <div id="navbar-top">
        <div class="navbar-simple-wrapper">
            <button onclick="window.history.back()" class="btn-transparent">
                <img src="./assets/img/icons/back-light.svg" alt="">
            </button>
            <h4 class="navbar-wrapper-title">Dompet Kebaikan</h4>
        </div>
    </div>

    <div class="screen">
        <div class="row">

            <div class="col-12">
                <div class="wallet-section">
                    
                    <div class="wallet-box">
                        <div class="wallet-detail">
                            <h4 class="wallet-label">Saldo dompet</h4>
                            <h4 class="wallet-amount">Rp{{ number_format($user->saldo, 0, ',', '.') }}</h4>
                        </div>

                        <a href="{{ url('top_up/nominal') }}" class="btn-go-topup">Isi Saldo</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="topup-history-section">
                    <hr class="mt-2 mb-3">
                    @forelse($history as $key => $value)
                        <h4 class="topup-month">{{ base64_decode($key) }}</h4>
                        @foreach($value as $row)
                        <div class="topup-card">
                            <div class="topup-detail-wrapper">
                                <h4 class="topup-label">Topup Saldo - Transfer {{ $row->payment_method }}</h4>
                                <h4 class="topup-amount">+Rp{{ number_format($row->nominal,0,',','.') }}</h4>
                            </div>
                       
                            <div class="topup-detail-wrapper">
                                <h4 class="topup-date">@if($row->status == 3) Berhasil @elseif($row->status == 2 ) Menunggu Verifikasi @else Menunggu Pembayaran @endif</h4>
                                <h4 class="topup-status">{{ $row['can_topup'] }}</h4>
                            </div>
                        </div>
                        @endforeach

                    @empty
                    <div class="text-muted bg-light p-4">Tidak ada transaksi</div>
                    @endforelse
                    {{-- <div class="topup-card">
                        <div class="topup-detail-wrapper">
                            <h4 class="topup-label">Topup Saldo - BCA Virtual Account</h4>
                            <h4 class="topup-amount">+Rp50.000</h4>
                        </div>

                        <div class="topup-detail-wrapper">
                            <h4 class="topup-date">22 July 2021</h4>
                            <h4 class="topup-status">Dibatalkan</h4>
                        </div>
                    </div>
                    <div class="topup-card">
                        <div class="topup-detail-wrapper">
                            <h4 class="topup-label">Topup Saldo - BCA Virtual Account</h4>
                            <h4 class="topup-amount">+Rp50.000</h4>
                        </div>

                        <div class="topup-detail-wrapper">
                            <h4 class="topup-date">22 July 2021</h4>
                            <h4 class="topup-status">Dibatalkan</h4>
                        </div>
                    </div> --}}

                    {{-- <hr class="mt-2 mb-3"> --}}

                    {{-- <h4 class="topup-month">July 2021</h4>
                    <div class="topup-card">
                        <div class="topup-detail-wrapper">
                            <h4 class="topup-label">Topup Saldo - BCA Virtual Account</h4>
                            <h4 class="topup-amount">+Rp50.000</h4>
                        </div>

                        <div class="topup-detail-wrapper">
                            <h4 class="topup-date">22 July 2021</h4>
                            <h4 class="topup-status">Dibatalkan</h4>
                        </div>
                    </div> --}}

                    {{-- <hr class="my-2"> --}}
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="./assets/js/global.js"></script>
    <script src="./assets/js/toast/toast.js"></script>
    <script src="./assets/js/instruksi.js"></script>
</body>

</html>