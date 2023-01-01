<?php 
if(!function_exists("popup")) {
    function popup($text, $type = 'default') {
        if($type == 'error'){
            $color = '#ffffff';
            $bg = '#dc3545';
        }else if($type == 'warning'){
            $color = '#ffffff';
            $bg = '#ffc107';
        }else if($type == 'success'){
            $color = '#ffffff';
            $bg = '#28a745';
        }else if($type == 'primary'){
            $color = '#28a745';
            $bg = 'var(--primary-color)';
        }else{
            $color = '#9f9f9f';
            $bg = '#ffffff';
        }
        echo '<style>
        .popup{
            position: fixed;
            top:24px;
            left: 50%;
            z-index: 999;
            width: 100%;
            display:flex;
            justify-content:center;
            transform:translate(-50%, -200%);
            animation-name: fadedown;
            animation-duration: 4s;
        }
        .popup-wrap{
            max-width:320px;
            padding:12px 24px;
            border-radius:100px;
            background:'.$bg.';
        }
        .popup-text{
            text-align:center;
            color:'.$color.';
        }
        @keyframes fadedown{
            0%{
                transform:translate(-50%, -200%);
            }
            20%{
                transform:translate(-50%, 0);
            }
            80%{
                transform:translate(-50%, 0);
            }
            100%{
                transform:translate(-50%, -200%);
            }
        }
    </style>
    <div class="popup">
        <div class="shadow popup-wrap">
            <div class="popup-text">'.$text.'</div>
        </div>
    </div>';      
    }
}