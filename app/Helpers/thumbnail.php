<?php

if ( !function_exists('getThumb') )
{
    function getThumb($url, $width = 100, $height = null){
        //Ignore if localhost
        if(preg_match('/^(http|https|ftp):\/\/(localhost|127\.0\.0\.1)|192\.168\.1\.9/i', $url)){
            return $url;
        }
        //thumbnail using free wp service
        $url = preg_replace('#^https?://#', '', $url);
        $cdn = "https://i0.wp.com/";
        if($height == null) {
            return $cdn . $url . "?w=" . $width . "&quality=70";
        }else{
            return $cdn . $url . "?resize=" . $width . "," . $height . "&quality=70";
        }
    }
}
