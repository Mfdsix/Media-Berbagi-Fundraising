<?php

namespace App\Http\Controllers\Gerai;

use App\Kwitansi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Funding;
// use carbon
use Carbon\Carbon;
use Auth;

class KwitansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return $this->generateKwitansi(9);
    }
    public function generateKwitansi($id)
    {
        // create image from png
        $image = imagecreatefrompng('images/kwitansi.png');

        // create stdclass
        $data = Funding::findOrFail($id);
        $data->donature_id = "FD-".sprintf('%05d', $data->id).now()->format('dmY');
        $data->address = 'Jl. Kebon Jeruk No. 1';
        $data->number = '1234567890';
        $data->email = 'user@example.com';
        $data->date = Carbon::now()->format('d M Y');
        $data->nominal_formated = 'Rp.'.number_format($data->nominal, 0, null, '.');

        $data->fund_type = ucfirst(str_replace('donation', 'sedekah', $data->fund_type));

        $user = Auth::user();

        // add header
        $this->addText($image, envdb('APP_NAME'), 1130, 150, 60, "Medium");
        $this->addText($image, "Email ".envdb('MAIL_FROM_ADDRESS'), 1130, 260, 40, "Medium");
        $this->addText($image, "Telp ".$user->phone ?? "", 1130, 370, 40);

        //add data
        $x = 700;
        $this->addText($image, $data->donature_id, $x, 700, 60, "Bold");
        $this->addText($image, ucfirst($data->donature_name), $x, 860, 60, "Bold");
        // $this->addText($image, $data->address, $x, 1030, 40, "Bold");
        $this->addText($image, $data->donature_phone, $x, 1360, 60, "Bold");
        $this->addText($image, $data->donature_email, $x, 1520, 60, "Bold");

        $x = 2800;
        // zakat
        $this->addText($image, $data->nominal_formated, $x, 700, 60, "Bold");
        $this->addText($image, $data->fund_type, $x - 400, 700, 46, "Regular");

        if($data->project_id == 0) {
            // create stdclass new
            $project = new \stdClass();
            $project->title = "Program instant ".$data->fund_type;

            $data->project = $project;
        }
        
        $title = "Dalam program : ".$data->project->title;
        $title = wordwrap($title, 32, "\n");

        $this->addText($image, $title, $x - 400, 900, 60, "Bold");
        
        // total
        // $this->addText($image, $data->nominal_formated, $x, 1430, 60, "Bold");

        $digit = new \NumberFormatter("id", \NumberFormatter::SPELLOUT);
        $digit = $digit->format($data->nominal)." rupiah";
        if(strlen($digit) > 48)  {
            $digit = wordwrap($digit, 48, "\n");
            $this->addText($image, $digit, $x, 1830, 50, "Bold");
        }else{
            $this->addText($image, $digit, $x, 1890, 60, "Bold");
        }

        // add watermark
        $this->addLogo($image);

        //generate image
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }

    public function addText($image, $text, $x, $y, $size, $weight = "Regular") {
        // set font
        $font = base_path('fonts/Roboto-'.$weight.'.ttf');

        // set font color
        // RGB(90, 183, 47)
        $color = imagecolorallocate($image, 90, 183, 47);

        // set text angle
        $angle = 0;

        // set text
        imagettftext($image, $size, $angle, $x, $y, $color, $font, $text);
    }

    public function addLogo($image) {
         // add watermark
         $web_set = Setting::find(1);
         if($web_set->path_logo == null) {
             $logo = @imagecreatefrompng(public_path('assets/media-berbagi/assets/images/website/logo-media-berbagi.png'));
         } else {
            $logo = @imagecreatefrompng(public_path('storage/'.$web_set->path_logo));
         }
 
         // set watermark position
         $logo_x = 0;
         $logo_y = 0;
 
         // resize logo
         $logo_width = imagesx($logo);
         $logo_height = imagesy($logo);
 
         $new_logo_width = 600;
         $new_logo_height = $logo_height/$logo_width*$new_logo_width;
 
         // set watermark
         imagecopyresampled($image, $logo, 200, 100, 0, 0, $new_logo_width, $new_logo_height, $logo_width, $logo_height);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->generateKwitansi($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kwitansi $kwitansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kwitansi  $kwitansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kwitansi $kwitansi)
    {
        //
    }
}
