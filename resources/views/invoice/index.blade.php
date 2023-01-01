<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    {{-- font google poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Kwitansi</title>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }
        .text-primary{
            color:#087734;
        }
        .bg-primary{
            background-color:#087734;
        }
        .border-primary{
            border-color:#087734;
        }
        #invoice{
            width: 1400px !important;
            height: 760px !important;
        }
    </style>
</head>
<body>

    <div class="flex flex-col p-8 h-screen" id="invoice">
        <div class="flex border-b border-gray-100 pb-8">
            <div class="w-3/5">
                
                <div class="flex flex-row items-center">
                    <div class="flex-1">
    
                        @if($web_set->path_logo)
                        <img src="{{ getThumb(asset('storage/' . $web_set->path_logo),128) }}" alt="Media Berbagi" class="w-72">
                        @else
                        <img src="{{ getThumb(asset('assets/media-berbagi/assets/images/website/logo-media-berbagi.png'),128) }}" alt="Media Berbagi" class="w-72">
                        @endif
    
                    </div>
                    <div class="flex-1 border-l border-gray-100 pl-12">
    
                        <div class="font-bold text-xl">{{ envdb('APP_NAME') }}</div>
                        <div class="text-gray-600 mt-2">{{ envdb('MAIL_FROM_ADDRESS') }}</div>
                        <div class="text-gray-600 mt-2">{{ isset(Auth::user()->phone) ? Auth::user()->phone : "" }}</div>
    
                    </div>
                </div>
    
            </div>
            <div class="w-2/5">
                
                <svg class="w-full" viewBox="0 0 562 106" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect width="562" height="106" rx="21" fill="#087734"/>
                    <rect width="562" height="106" rx="21" fill="url(#pattern0)"/>
                    <path d="M86.48 52.6C88.1067 52.9467 89.4133 53.76 90.4 55.04C91.3867 56.2933 91.88 57.7333 91.88 59.36C91.88 61.7067 91.0533 63.5733 89.4 64.96C87.7733 66.32 85.4933 67 82.56 67H69.48V38.92H82.12C84.9733 38.92 87.2 39.5733 88.8 40.88C90.4267 42.1867 91.24 43.96 91.24 46.2C91.24 47.8533 90.8 49.2267 89.92 50.32C89.0667 51.4133 87.92 52.1733 86.48 52.6ZM76.32 50.28H80.8C81.92 50.28 82.7733 50.04 83.36 49.56C83.9733 49.0533 84.28 48.32 84.28 47.36C84.28 46.4 83.9733 45.6667 83.36 45.16C82.7733 44.6533 81.92 44.4 80.8 44.4H76.32V50.28ZM81.36 61.48C82.5067 61.48 83.3867 61.2267 84 60.72C84.64 60.1867 84.96 59.4267 84.96 58.44C84.96 57.4533 84.6267 56.68 83.96 56.12C83.32 55.56 82.4267 55.28 81.28 55.28H76.32V61.48H81.36ZM117.887 44.68V67H111.047V63.96C110.354 64.9467 109.407 65.7467 108.207 66.36C107.034 66.9467 105.727 67.24 104.287 67.24C102.581 67.24 101.074 66.8667 99.7672 66.12C98.4605 65.3467 97.4472 64.24 96.7272 62.8C96.0072 61.36 95.6472 59.6667 95.6472 57.72V44.68H102.447V56.8C102.447 58.2933 102.834 59.4533 103.607 60.28C104.381 61.1067 105.421 61.52 106.727 61.52C108.061 61.52 109.114 61.1067 109.887 60.28C110.661 59.4533 111.047 58.2933 111.047 56.8V44.68H117.887ZM136.44 67L129.64 57.64V67H122.8V37.4H129.64V53.76L136.4 44.68H144.84L135.56 55.88L144.92 67H136.44ZM159.967 61.2V67H156.487C154.007 67 152.074 66.4 150.687 65.2C149.3 63.9733 148.607 61.9867 148.607 59.24V50.36H145.887V44.68H148.607V39.24H155.447V44.68H159.927V50.36H155.447V59.32C155.447 59.9867 155.607 60.4667 155.927 60.76C156.247 61.0533 156.78 61.2 157.527 61.2H159.967ZM167.217 42.36C166.017 42.36 165.03 42.0133 164.257 41.32C163.51 40.6 163.137 39.72 163.137 38.68C163.137 37.6133 163.51 36.7333 164.257 36.04C165.03 35.32 166.017 34.96 167.217 34.96C168.39 34.96 169.35 35.32 170.097 36.04C170.87 36.7333 171.257 37.6133 171.257 38.68C171.257 39.72 170.87 40.6 170.097 41.32C169.35 42.0133 168.39 42.36 167.217 42.36ZM170.617 44.68V67H163.777V44.68H170.617ZM194.21 67.28C192.157 67.28 190.317 66.9467 188.69 66.28C187.064 65.6133 185.757 64.6267 184.77 63.32C183.81 62.0133 183.304 60.44 183.25 58.6H190.53C190.637 59.64 190.997 60.44 191.61 61C192.224 61.5333 193.024 61.8 194.01 61.8C195.024 61.8 195.824 61.5733 196.41 61.12C196.997 60.64 197.29 59.9867 197.29 59.16C197.29 58.4667 197.05 57.8933 196.57 57.44C196.117 56.9867 195.544 56.6133 194.85 56.32C194.184 56.0267 193.224 55.6933 191.97 55.32C190.157 54.76 188.677 54.2 187.53 53.64C186.384 53.08 185.397 52.2533 184.57 51.16C183.744 50.0667 183.33 48.64 183.33 46.88C183.33 44.2667 184.277 42.2267 186.17 40.76C188.064 39.2667 190.53 38.52 193.57 38.52C196.664 38.52 199.157 39.2667 201.05 40.76C202.944 42.2267 203.957 44.28 204.09 46.92H196.69C196.637 46.0133 196.304 45.3067 195.69 44.8C195.077 44.2667 194.29 44 193.33 44C192.504 44 191.837 44.2267 191.33 44.68C190.824 45.1067 190.57 45.7333 190.57 46.56C190.57 47.4667 190.997 48.1733 191.85 48.68C192.704 49.1867 194.037 49.7333 195.85 50.32C197.664 50.9333 199.13 51.52 200.25 52.08C201.397 52.64 202.384 53.4533 203.21 54.52C204.037 55.5867 204.45 56.96 204.45 58.64C204.45 60.24 204.037 61.6933 203.21 63C202.41 64.3067 201.237 65.3467 199.69 66.12C198.144 66.8933 196.317 67.28 194.21 67.28ZM229.7 55.48C229.7 56.12 229.66 56.7867 229.58 57.48H214.1C214.206 58.8667 214.646 59.9333 215.42 60.68C216.22 61.4 217.193 61.76 218.34 61.76C220.046 61.76 221.233 61.04 221.9 59.6H229.18C228.806 61.0667 228.126 62.3867 227.14 63.56C226.18 64.7333 224.966 65.6533 223.5 66.32C222.033 66.9867 220.393 67.32 218.58 67.32C216.393 67.32 214.446 66.8533 212.74 65.92C211.033 64.9867 209.7 63.6533 208.74 61.92C207.78 60.1867 207.3 58.16 207.3 55.84C207.3 53.52 207.766 51.4933 208.7 49.76C209.66 48.0267 210.993 46.6933 212.7 45.76C214.406 44.8267 216.366 44.36 218.58 44.36C220.74 44.36 222.66 44.8133 224.34 45.72C226.02 46.6267 227.326 47.92 228.26 49.6C229.22 51.28 229.7 53.24 229.7 55.48ZM222.7 53.68C222.7 52.5067 222.3 51.5733 221.5 50.88C220.7 50.1867 219.7 49.84 218.5 49.84C217.353 49.84 216.38 50.1733 215.58 50.84C214.806 51.5067 214.326 52.4533 214.14 53.68H222.7ZM245.748 61.2V67H242.268C239.788 67 237.855 66.4 236.468 65.2C235.081 63.9733 234.388 61.9867 234.388 59.24V50.36H231.668V44.68H234.388V39.24H241.228V44.68H245.708V50.36H241.228V59.32C241.228 59.9867 241.388 60.4667 241.708 60.76C242.028 61.0533 242.561 61.2 243.308 61.2H245.748ZM259.718 67.32C257.531 67.32 255.558 66.8533 253.798 65.92C252.065 64.9867 250.691 63.6533 249.678 61.92C248.691 60.1867 248.198 58.16 248.198 55.84C248.198 53.5467 248.705 51.5333 249.718 49.8C250.731 48.04 252.118 46.6933 253.878 45.76C255.638 44.8267 257.611 44.36 259.798 44.36C261.985 44.36 263.958 44.8267 265.718 45.76C267.478 46.6933 268.865 48.04 269.878 49.8C270.891 51.5333 271.398 53.5467 271.398 55.84C271.398 58.1333 270.878 60.16 269.838 61.92C268.825 63.6533 267.425 64.9867 265.638 65.92C263.878 66.8533 261.905 67.32 259.718 67.32ZM259.718 61.4C261.025 61.4 262.131 60.92 263.038 59.96C263.971 59 264.438 57.6267 264.438 55.84C264.438 54.0533 263.985 52.68 263.078 51.72C262.198 50.76 261.105 50.28 259.798 50.28C258.465 50.28 257.358 50.76 256.478 51.72C255.598 52.6533 255.158 54.0267 255.158 55.84C255.158 57.6267 255.585 59 256.438 59.96C257.318 60.92 258.411 61.4 259.718 61.4ZM281.867 48.4C282.667 47.1733 283.667 46.2133 284.867 45.52C286.067 44.8 287.4 44.44 288.867 44.44V51.68H286.987C285.28 51.68 284 52.0533 283.147 52.8C282.294 53.52 281.867 54.8 281.867 56.64V67H275.027V44.68H281.867V48.4ZM290.776 55.8C290.776 53.5067 291.203 51.4933 292.056 49.76C292.936 48.0267 294.123 46.6933 295.616 45.76C297.11 44.8267 298.776 44.36 300.616 44.36C302.19 44.36 303.563 44.68 304.736 45.32C305.936 45.96 306.856 46.8 307.496 47.84V44.68H314.336V67H307.496V63.84C306.83 64.88 305.896 65.72 304.696 66.36C303.523 67 302.15 67.32 300.576 67.32C298.763 67.32 297.11 66.8533 295.616 65.92C294.123 64.96 292.936 63.6133 292.056 61.88C291.203 60.12 290.776 58.0933 290.776 55.8ZM307.496 55.84C307.496 54.1333 307.016 52.7867 306.056 51.8C305.123 50.8133 303.976 50.32 302.616 50.32C301.256 50.32 300.096 50.8133 299.136 51.8C298.203 52.76 297.736 54.0933 297.736 55.8C297.736 57.5067 298.203 58.8667 299.136 59.88C300.096 60.8667 301.256 61.36 302.616 61.36C303.976 61.36 305.123 60.8667 306.056 59.88C307.016 58.8933 307.496 57.5467 307.496 55.84ZM332.885 44.44C335.498 44.44 337.578 45.2933 339.125 47C340.698 48.68 341.485 51 341.485 53.96V67H334.685V54.88C334.685 53.3867 334.298 52.2267 333.525 51.4C332.751 50.5733 331.711 50.16 330.405 50.16C329.098 50.16 328.058 50.5733 327.285 51.4C326.511 52.2267 326.125 53.3867 326.125 54.88V67H319.285V44.68H326.125V47.64C326.818 46.6533 327.751 45.88 328.925 45.32C330.098 44.7333 331.418 44.44 332.885 44.44ZM365.234 38.92C368.194 38.92 370.781 39.5067 372.994 40.68C375.208 41.8533 376.914 43.5067 378.114 45.64C379.341 47.7467 379.954 50.1867 379.954 52.96C379.954 55.7067 379.341 58.1467 378.114 60.28C376.914 62.4133 375.194 64.0667 372.954 65.24C370.741 66.4133 368.168 67 365.234 67H354.714V38.92H365.234ZM364.794 61.08C367.381 61.08 369.394 60.3733 370.834 58.96C372.274 57.5467 372.994 55.5467 372.994 52.96C372.994 50.3733 372.274 48.36 370.834 46.92C369.394 45.48 367.381 44.76 364.794 44.76H361.554V61.08H364.794ZM393.937 67.32C391.75 67.32 389.777 66.8533 388.017 65.92C386.284 64.9867 384.91 63.6533 383.897 61.92C382.91 60.1867 382.417 58.16 382.417 55.84C382.417 53.5467 382.924 51.5333 383.937 49.8C384.95 48.04 386.337 46.6933 388.097 45.76C389.857 44.8267 391.83 44.36 394.017 44.36C396.204 44.36 398.177 44.8267 399.937 45.76C401.697 46.6933 403.084 48.04 404.097 49.8C405.11 51.5333 405.617 53.5467 405.617 55.84C405.617 58.1333 405.097 60.16 404.057 61.92C403.044 63.6533 401.644 64.9867 399.857 65.92C398.097 66.8533 396.124 67.32 393.937 67.32ZM393.937 61.4C395.244 61.4 396.35 60.92 397.257 59.96C398.19 59 398.657 57.6267 398.657 55.84C398.657 54.0533 398.204 52.68 397.297 51.72C396.417 50.76 395.324 50.28 394.017 50.28C392.684 50.28 391.577 50.76 390.697 51.72C389.817 52.6533 389.377 54.0267 389.377 55.84C389.377 57.6267 389.804 59 390.657 59.96C391.537 60.92 392.63 61.4 393.937 61.4ZM422.846 44.44C425.459 44.44 427.539 45.2933 429.086 47C430.659 48.68 431.446 51 431.446 53.96V67H424.646V54.88C424.646 53.3867 424.259 52.2267 423.486 51.4C422.712 50.5733 421.672 50.16 420.366 50.16C419.059 50.16 418.019 50.5733 417.246 51.4C416.472 52.2267 416.086 53.3867 416.086 54.88V67H409.246V44.68H416.086V47.64C416.779 46.6533 417.712 45.88 418.886 45.32C420.059 44.7333 421.379 44.44 422.846 44.44ZM434.839 55.8C434.839 53.5067 435.265 51.4933 436.119 49.76C436.999 48.0267 438.185 46.6933 439.679 45.76C441.172 44.8267 442.839 44.36 444.679 44.36C446.252 44.36 447.625 44.68 448.799 45.32C449.999 45.96 450.919 46.8 451.559 47.84V44.68H458.399V67H451.559V63.84C450.892 64.88 449.959 65.72 448.759 66.36C447.585 67 446.212 67.32 444.639 67.32C442.825 67.32 441.172 66.8533 439.679 65.92C438.185 64.96 436.999 63.6133 436.119 61.88C435.265 60.12 434.839 58.0933 434.839 55.8ZM451.559 55.84C451.559 54.1333 451.079 52.7867 450.119 51.8C449.185 50.8133 448.039 50.32 446.679 50.32C445.319 50.32 444.159 50.8133 443.199 51.8C442.265 52.76 441.799 54.0933 441.799 55.8C441.799 57.5067 442.265 58.8667 443.199 59.88C444.159 60.8667 445.319 61.36 446.679 61.36C448.039 61.36 449.185 60.8667 450.119 59.88C451.079 58.8933 451.559 57.5467 451.559 55.84ZM472.427 67.32C470.481 67.32 468.747 66.9867 467.227 66.32C465.707 65.6533 464.507 64.7467 463.627 63.6C462.747 62.4267 462.254 61.12 462.147 59.68H468.907C468.987 60.4533 469.347 61.08 469.987 61.56C470.627 62.04 471.414 62.28 472.347 62.28C473.201 62.28 473.854 62.12 474.307 61.8C474.787 61.4533 475.027 61.0133 475.027 60.48C475.027 59.84 474.694 59.3733 474.027 59.08C473.361 58.76 472.281 58.4133 470.787 58.04C469.187 57.6667 467.854 57.28 466.787 56.88C465.721 56.4533 464.801 55.8 464.027 54.92C463.254 54.0133 462.867 52.8 462.867 51.28C462.867 50 463.214 48.84 463.907 47.8C464.627 46.7333 465.667 45.8933 467.027 45.28C468.414 44.6667 470.054 44.36 471.947 44.36C474.747 44.36 476.947 45.0533 478.547 46.44C480.174 47.8267 481.107 49.6667 481.347 51.96H475.027C474.921 51.1867 474.574 50.5733 473.987 50.12C473.427 49.6667 472.681 49.44 471.747 49.44C470.947 49.44 470.334 49.6 469.907 49.92C469.481 50.2133 469.267 50.6267 469.267 51.16C469.267 51.8 469.601 52.28 470.267 52.6C470.961 52.92 472.027 53.24 473.467 53.56C475.121 53.9867 476.467 54.4133 477.507 54.84C478.547 55.24 479.454 55.9067 480.227 56.84C481.027 57.7467 481.441 58.9733 481.467 60.52C481.467 61.8267 481.094 63 480.347 64.04C479.627 65.0533 478.574 65.8533 477.187 66.44C475.827 67.0267 474.241 67.32 472.427 67.32ZM489.092 42.36C487.892 42.36 486.905 42.0133 486.132 41.32C485.385 40.6 485.012 39.72 485.012 38.68C485.012 37.6133 485.385 36.7333 486.132 36.04C486.905 35.32 487.892 34.96 489.092 34.96C490.265 34.96 491.225 35.32 491.972 36.04C492.745 36.7333 493.132 37.6133 493.132 38.68C493.132 39.72 492.745 40.6 491.972 41.32C491.225 42.0133 490.265 42.36 489.092 42.36ZM492.492 44.68V67H485.652V44.68H492.492Z" fill="white"/>
                    <defs>
                    <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_251_114" transform="translate(0 -0.285368) scale(0.000984252 0.00521839)"/>
                    </pattern>
                    <image id="image0_251_114" width="1016" height="301" xlink:href="data:image/png;base64,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"/>
                    </defs>
                </svg>

                <div class="flex mt-2">
                    <div class="text-gray-400">Tanggal</div>
                    <div class="text-primary font-medium ml-2">{{Carbon\Carbon::parse($data->created_at)->format('d-M-Y') }}</div>
                    <div class="flex-1"></div>
                    {{-- <div class="text-gray-400">Cabang/Perwakilan/UPZ</div>
                    <div class="text-primary font-medium ml-2">Jawa Barat</div> --}}
                </div>
    
            </div>
        </div>
        <div class="pt-8 flex-1 flex pb-4">
            <div class="w-3/5 pr-12 border-r border-gray-100 h-full flex flex-col">

                <div>
                    <table class="w-full">
                        <tr>
                            <td class="py-2">
                               <div class="font-bold text-lg">Identitas</div>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 text-lg text-gray-600">Nama Donatur</td>
                            <td class="py-2 text-lg text-primary">{{ $data->donature_name }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-lg text-gray-600">Telp./HP</td>
                            <td class="py-2 text-lg text-primary">{{ $data->donature_phone }}</td>
                        </tr>
                        <tr>
                            <td class="py-2 text-lg text-gray-600">Alamat email</td>
                            <td class="py-2 text-lg text-primary">{{ $data->donature_email }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
    
                                {{-- checkbox tailwind --}}
                                <div class="flex justify-between mt-4">
                                    <div class="flex items-start">
                                        <input type="checkbox" class="form-checkbox text-primary w-8 h-8" id="checkbox-1">
                                        <label for="checkbox-1" class="ml-4 text-lg text-gray-600">
                                            Donasi yang saya sampaikan berasal dari dana halal dan
                                            bukan dari aktivitas yang melanggar hukum di
                                            Republik Indonesia
                                        </label>
                                    </div>
                                </div>
    
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="flex-1"></div>

                <div class="flex">
                    <div class="flex-1">
                        <div class="text-primary font-semibold">Penerima Dana</div>
                        <div class="pt-12 flex">
                            (
                            <div class="w-48"></div>
                            )
                        </div>
                        <div class="mt-1 text-gray-400">Nama Jelas & Tanda Tangan</div>
                    </div>
                    <div class="flex-1">
                        <div class="text-primary font-semibold">Donatur</div>
                        <div class="pt-12 flex">
                            (
                            <div class="w-48"></div>
                            )
                        </div>
                        <div class="mt-1 text-gray-400">Nama Jelas & Tanda Tangan</div>
                    </div>
                </div>

            </div>
            <div class="w-2/5 pl-8 h-full flex flex-col">

                <div class="font-bold font-lg">Rincian Donasi</div>
                <div class="flex">

                    <div class="text-gray-400">{{ $data->fund_type }}</div>
                    <div class="text-primary font-medium pl-4">Rp. {{ number_format($data->nominal,0, ',', '.') }}</div>
                    <div class="flex-1"></div>
                    <div class="text-gray-400">{{ ($data->payment_method == "Admin" || $data->payment_method == "Gerai") ? "Offline" : ucfirst($data->payment_type)."/".$data->payment_method }}</div>
                </div>
                <div class="text-gray-400 mt-2">Dalam Program</div>
                <div class="mt-2 text-primary font-medium">
                    {{ $data->project->title }}
                </div>

                @if ($data->payment_type == "bank")
                    <div class="mt-6 h-16 flex items-center justify-center rounded-2xl text-2xl font-semibold bg-primary text-white">Transfer via Rekening Bank</div>
                @elseif($data->payment_type == "ewallet")
                    <div class="mt-6 h-16 flex items-center justify-center rounded-2xl text-2xl font-semibold bg-primary text-white">Transfer dengan E-Wallet</div>
                @else
                <div class="mt-6 h-16 flex items-center justify-center rounded-2xl text-2xl font-semibold bg-primary text-white">Dengan Uang Kas</div>
                @endif

                <table class="mt-3">
                    @if($data->payment_type == "bank")
                    <tr>
                        <td class="pt-2 text-gray-400">Nama Bank</td>
                        <td class="pt-2 text-primary font-medium">{{ $data->payment_method }}</td>
                    </tr>
                    <tr>
                        <td class="pt-2 text-gray-400">Nomor Rekening</td>
                        <td class="pt-2 text-primary font-medium">{{ $data->bank->bank_number }}</td>
                    </tr>
                    @elseif ($data->payment_type == "ewallet")
                    <tr>
                        <td class="pt-2 text-gray-400">Ewallet</td>
                        <td class="pt-2 text-primary font-medium">{{ $data->payment_method }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="pt-2 text-gray-400">Tanggal Transfer</td>
                        <td class="pt-2 text-primary font-medium">{{Carbon\Carbon::parse($data->created_at)->format('d-M-Y') }}</td>
                    </tr>
                    <tr>
                        <td class="pt-2 text-gray-400">ID Transaksi</td>
                        <td class="pt-2 text-primary font-medium">{{ $data->bill_no }}</td>
                    </tr>
                </table>

                <div class="flex-1"></div>

                <div class="mt-4 rounded-2xl border-2 p-4 border-primary">
                    <span class="text-gray-400 pr-4">Terbilang</span>
                    <span class="text-primary font-medium text-lg">@php $digit = new \NumberFormatter("id", \NumberFormatter::SPELLOUT); @endphp
                        {{$digit = strtoupper($digit->format($data->nominal))." RUPIAH"}}</span>
                </div>

            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        html2canvas(document.getElementById('invoice'),{useCORS: true}).then(function(canvas) {
            var a = document.createElement('a');
            // toDataURL defaults to png, so we need to request a png, then convert for file download.
            a.href = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            a.download = '{{ date("Ymdhis") }}.png';
            a.click();
            window.close();
        });
    </script>
</body>
</html>