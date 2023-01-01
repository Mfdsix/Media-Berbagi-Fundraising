<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Theme;
use Illuminate\Http\Request;
use File;

class ThemeController extends Controller
{
    public function index(Request $request)
    {

        if($request->action == "delete") {
            $request->validate([
                'theme' => 'required',
                "action" => 'required',
            ]);
            $theme = $request->theme;
            Theme::where("theme", $theme)->delete();
            if (File::exists(base_path("themes/".$theme))) File::deleteDirectory(base_path("themes/".$theme));
            if (File::exists(public_path("themes/".$theme))) File::deleteDirectory(public_path("themes/".$theme));
            return redirect("admin/themes")->with('success', 'Deleted successfully');
        }else if($request->action == "active") {
            $request->validate([
                'theme' => 'required',
                "action" => 'required',
            ]);
            $theme = $request->theme;
            $json = \Themes::getInfo($theme);

            if(property_exists($json, "assets")) {
                foreach($json->assets as $asset) {
                    if(!File::exists(public_path("themes/".$theme."/assets"))) File::makeDirectory(public_path("themes/".$theme."/assets"));
                    File::copy(base_path("themes/".$theme."/".$asset), public_path("themes/".$theme."/".$asset));
                }
            }

            $this->deleteAllTheme();

            Theme::create([
                "theme" => $theme,
                "name" => $json->name,
                "version" => $json->version,
                "compatible" => $json->compatible,
                "description" => $json->description,
                "author" => $json->author,
                "email" => $json->email,
                "active" => true,
                "script" => json_encode($json->scripts),
            ]);

            if (File::exists(base_path("themes/".$theme))) File::copyDirectory(base_path("themes/".$theme), base_path("resources/views/themes/".$theme));
            return redirect("admin/themes")->with('success', 'Theme already active');
        }else if($request->action == "nonactive"){
            $request->validate([
                'theme' => 'required',
                "action" => 'required',
            ]);
            $theme = $request->theme;
            Theme::where('theme', $theme)->delete();
            if (File::exists(base_path("themes/".$theme))) File::deleteDirectory(base_path("resources/views/themes/".$theme));
            return redirect("admin/themes")->with('success', 'Theme is now non active');
        }


        $themes = array_diff(scandir(base_path("themes/")), array('.', '..'));
        $all_themes = [];

        foreach($themes as $theme) {
            if(file_exists(base_path("themes/".$theme."/install.json"))) {
                
                // get info
                $info = \Themes::getInfo($theme);

                $tm = Theme::where("theme", $theme)->first();
                if($tm != null) {
                    $info->active = true;
                }else{
                    $info->active = false;
                }

                $info->image = \Themes::preview($theme);
                array_push($all_themes, $info);  
            }
        }
        
        return view("admin.themes.index")->with([
            "themes" => $all_themes,
        ]);
    }

    public function upload(Request $request)
    {
       // upload file
       $request->validate([
           'file' => 'required|file|mimes:zip'
       ]);
        $file = $request->file('file');
        // unzip file
        $file->move( base_path('tmp'), $file->getClientOriginalName() );
        $zip = new \ZipArchive;
        $res = $zip->open( base_path('tmp/' . $file->getClientOriginalName()) );

        if ($res === TRUE) {
            $zip->extractTo(base_path('themes/'));
            $zip->close();
            unlink(base_path('tmp/' . $file->getClientOriginalName()));
            return redirect()->back()->with('success', 'Uploaded successfully');
        } else {
            unlink(base_path('tmp/' . $file->getClientOriginalName()));
            return redirect()->back()->with('error', 'Uploaded failed');
        }
    }

    // create function delete all column in Theme
    public function deleteAllTheme()
    {
        $themes = Theme::all();
        foreach($themes as $theme) {
            $theme->delete();
        }
    }

}
