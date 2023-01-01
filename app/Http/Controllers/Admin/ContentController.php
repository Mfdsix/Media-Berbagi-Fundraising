<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doc;
use Storage;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$about_us = Doc::where('field', 'about_us')
        ->pluck('content')
        ->first();
        $term_condition = Doc::where('field', 'term_condition')
        ->pluck('content')
        ->first();
        $help = Doc::where('field', 'help')
        ->pluck('content')
        ->first();

    	return view('admin.content.index')->with([
    		'about_us' => $about_us,
            'term_condition' => $term_condition,
            'help' => $help,
    	]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'about_us' => 'required',
            'term_condition' => 'required',
            'help' => 'required',
        ]);

        $about = Doc::where('field', 'about_us')
        ->first();
        $term = Doc::where('field', 'term_condition')
        ->first();
        $help = Doc::where('field', 'help')
        ->first();

        if($about){
            $about->update([
                'content' => $request->about_us
            ]);
        }else{
            Doc::create([
                'field' => 'about_us',
                'content' => $request->about_us
            ]);
        }
        if($term){
            $term->update([
                'content' => $request->term_condition
            ]);
        }else{
            Doc::create([
                'field' => 'term_condition',
                'content' => $request->term_condition
            ]);
        }
        if($help){
            $help->update([
                'content' => $request->help
            ]);
        }else{
            Doc::create([
                'field' => 'help',
                'content' => $request->help
            ]);
        }

        return redirect('admin/content')->with([
            'success' => 'Berhasil Mengupdate Konten'
        ]);
    }

}
?>