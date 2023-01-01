<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Donasi</title>
    <style>
        @page{ margin: -5px }
        body {
            margin: -5px;
            background-image: url("{{ public_path('/assets/img/certificate.png') }}");
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-size: cover;
        }
        p{
            margin: 0px;
        }
        *{
            font-family: arial, sans-serif;
        }
        .img-back{
            width: 90%;
            height: auto;
        }
        .main-text{
            position: absolute;
            top: 250px;
            left: 0;
            right: 0;
        }
        .txt-name{
            text-align: center;
            color: #fbc25b;
            font-size: 56px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .txt-project{
            margin-top: 8px !important;
            padding-left: 450px !important;
            color: #fbc25b;
            font-size: 18px;
            font-style: italic;
        }
        .txt-donation{
            margin-top: 23px !important;
            text-align: center;
            color: #fbc25b;
            font-size: 52px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="main-page" style="position: relative">
        <!-- <img src="{{ public_path('/assets/img/certificate.png') }}" class="img-back"> -->
        <div class="main-text">
            <p class="txt-name">{{ $data->donature_name }}</p>
            <p class="txt-project">{{ $project ? $project->title : 'Donasi' }}</p>
            <p class="txt-donation">Rp {{ number_format($data->nominal,0,null, ".") }}</p>
        </div>
    </div>
</body>
</html>
