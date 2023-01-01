<?php
use Illuminate\Support\Facades\Redis;

if ( !function_exists('CacheRedis') )
{
    function CacheRedis($table_name, $query, $always = false, $array = false) {
        $prefix = str_replace('base64:','',env('APP_KEY'));
        $last_modified = null;
        $modified = null;
        if(!$always) {
            $modified = DB::table($table_name)->select('updated_at')->orderBy('updated_at', 'DESC')->first();
            if($modified != null) {
                $modified = DB::table($table_name)->select('updated_at')->orderBy('updated_at', 'DESC')->first()->updated_at; // get last modified   
            }else{
                return json_decode(json_encode([]));
            }
            $last_modified = Redis::get($prefix.'_'.$table_name);
        }

        if($always){
            if(Redis::get($prefix.$table_name) == null) {
                $data = $query();
                Redis::set($prefix.$table_name, json_encode($data));
                Redis::set($prefix.'_'.$table_name, $modified);
            }
        }

        if($last_modified == $modified || $always){
            $redis_data = Redis::get($prefix.$table_name); // get from redis
            $data = json_decode($redis_data, $array); //convert to data
        }else{
            $data = $query();
            Redis::set($prefix.$table_name, json_encode($data));
            Redis::set($prefix.'_'.$table_name, $modified);
        }
        return $data;
    }
}
