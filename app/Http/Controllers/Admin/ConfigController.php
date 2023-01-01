<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Config;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class ConfigController extends Controller
{
    public function mail() {
        $config = Config::first();
        return view("admin.mail_setting.index", compact('config'));
    }
    public function mail_save(Request $request) {
        $request->validate([
            'mailer' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|string',
            'user' => 'required|string',
            'pass' => 'required|string',
            'enc' => 'required|string',
            'address' => 'required|string',
            'from' => 'required|string',
        ]);
        
        $config = Config::first();
        $config->update([
            'MAIL_MAILER' => $request->mailer,
            "MAIL_HOST" => $request->host,
            "MAIL_PORT" => $request->port,
            "MAIL_USERNAME" => $request->user,
            "MAIL_PASSWORD" => $request->pass,
            "MAIL_ENCRYPTION" => $request->enc,
            "MAIL_FROM_ADDRESS" => $request->address,
            "MAIL_FROM_NAME" => $request->from,
        ]);
        return redirect()->back();
    }

    public function whatsapp(Request $request) {
        $config = Config::first();
        $qrcode = null;
        if($config->RUANGWA_TOKEN != null){
            if($request->reload == 'true') {
                return $this->reloadQR($config->RUANGWA_TOKEN);
            }
            $status = $this->statusWA($config->RUANGWA_TOKEN);
        }else{
            $status = false;
        }
        return view("admin.whatsapp.index", compact('config', 'status'));
    }

    public function whatsapp_save(Request $request) {
        $request->validate([
            'token' => 'required|string',
        ]);

        $config = Config::first();
        $config->update([
            "RUANGWA_TOKEN" => $request->token,
        ]);
        return redirect()->back();
    }

    public function statusWA($token) {
        $client = new Client();
        $response = $client->post('https://goowa.id/api/qrcode', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'token' => $token,
            ],
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            $output = json_decode($stringBody);
            if(isset($output->status)) {
                return $output->status;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function reloadQR($token) {
        $client = new Client();
        $response = $client->post('https://goowa.id/api/reload', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'token' => $token,
            ],
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            $output = json_decode($stringBody);
            return redirect()->back();
            // dd($output);
            // if($output->status == true){
            //     return $output;
            // }else{
            //     return null;
            // }
        }
    }
    public function mediaberbagi() {
        $config = Config::first();
        return view("admin.mediaberbagi.index", compact('config'));
    }
    public function mediaberbagi_save(Request $request) {
        $request->validate([
            'host' => 'required|string',
            'key' => 'required|string',
        ]);
        
        $config = Config::first();
        $config->update([
            "MB_HOST" => $request->host,
            "MB_ACCESS_KEY" => $request->key,
        ]);
        return redirect()->back();
    }
}
