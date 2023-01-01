<?php

// if class Theme exists
if(!class_exists("Themes")) {
    class Themes{
        public $theme;
        public $name;
        public $version;
        public $compatible;
        public $description;
        public $author;
        public $email;
        public $active;
        public $script;
        public $created_at;
        public $updated_at;

        public static function preview($name = null) {
            if($name != null) {
                $info = self::getInfo($name);
                $preview = $info->preview;
                return self::load($name, $preview);
            }
        }

        public static function asset($name = null, $asset = null) {
            if($name != null) {
                $info = self::getInfo($name);
                $assets = $info->assets;
                // check if asset is in array
                if(in_array($asset, $assets)) {
                    return self::load($name, $asset);
                }else{
                    return "File not found";
                }
            }
        }

        public static function load($name = null, $file = null) {
            if($name != null) {
                if($file != null) {
                    // return error if not exist
                    if(!file_exists(base_path("themes/".$name."/".$file))) {
                        return "File ".$file." does not exist in theme ".$name;
                    }

                    // create folder themes if not exists
                    if(!File::exists(public_path("themes/"))){
                        File::makeDirectory(public_path("themes/"));
                    }

                    // create folder to public is not linked
                    if(!File::exists(public_path("themes/".$name))){
                        File::makeDirectory(public_path("themes/".$name));
                    }

                    // copy file $name to public_path("themes/".$name) if not exist
                    if(!File::exists(public_path("themes/".$name."/".$file))){
                        // explode file
                        $explode = explode("/", $file);
                        // get file name
                        $file_name = end($explode);
                        // get first folder
                        $folder = "";
                        // create folder by explode
                        if(count($explode) > 1) {
                            foreach($explode as $key => $value) {
                                if($value != $file_name) {
                                    $folder .= "/".$value;
                                    if(!File::exists(public_path("themes/".$name.$folder))) {
                                        File::makeDirectory(public_path("themes/".$name.$folder));
                                    }
                                }
                            }
                        }else{
                            $file = $file_name;
                        }
                        File::copy(base_path("themes/".$name."/".$file), public_path("themes/".$name."/".$file));
                    }

                    // check env env("APP_URL") is not localhost
                    if(env("APP_URL") != "http://localhost:8000") {
                       return secure_asset("themes/".$name."/".$file);
                    }else{
                        return asset("themes/".$name."/".$file);
                    }
                }
            }
        }

        public static function path($name = null) {
            if($name != null) {
                if(file_exists(base_path("themes/".$name))) {
                    return base_path("themes/".$name);
                }
            }
        }

        public static function getInfo($name = null) {
            if($name != null) {
                // location json
                $path = base_path() . '/themes/' . $name . "/install.json";

                // check if exist
                if(!File::exists($path)) {
                    return "Theme not found";
                }

                // parse file json
                $json = file_get_contents($path);
                $json = json_decode($json);

                // if json not valid
                if($json == null) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if name property exist
                if(!property_exists($json, "name")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if version property exist
                if(!property_exists($json, "version")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if compatible property exist
                if(!property_exists($json, "compatible")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if description property exist
                if(!property_exists($json, "description")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if preview property exist
                if(!property_exists($json, "preview")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if email property exist
                if(!property_exists($json, "email")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if scripts property exist
                if(!property_exists($json, "scripts")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // check if assets property exist
                if(!property_exists($json, "assets")) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                // if property asset is not array
                if(!is_array($json->assets)) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                 // if property scripts is not array
                if(!is_object($json->scripts)) {
                    return "Error in theme ".$name.", file install.json is not valid JSON";
                }

                $json->path = $name;
                
                return $json;
            }
        }
    }
}