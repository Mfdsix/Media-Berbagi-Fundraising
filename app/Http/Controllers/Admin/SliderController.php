<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Redis;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Slider::all();

        return view('admin.slider.index')->with([
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link_target' => 'required|url|min:6',
            'slider' => 'required|max:5000|mimes:png,jpg,jpeg',
        ]);

        $filename = null;

        if ($request->hasFile('slider')) {
            $filename = $request->file('slider')->store('uploads/slider');
        }

        Slider::create([
            'link_target' => $request->link_target,
            'path_slider' => $filename,
        ]);

        $prefix = str_replace('base64:','',env('APP_KEY'));
        Redis::del($prefix.'sliders');
        Redis::del($prefix.'_sliders');

        return redirect('admin/slider')->with([
            'success' => 'Berhasil Menambahkan Slider',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Slider::findOrFail($id);
        return view('admin.slider.form')->with([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Slider::findOrFail($id);

        $request->validate([
            'link_target' => 'required|url|min:6',
            'slider' => 'nullable|max:5000|mimes:png,jpg,jpeg',
        ]);

        $filename = $data->path_slider;

        if ($request->hasFile('slider')) {
            if ($data->path_slider != null) {
                Storage::delete($data->path_slider);
            }
            $filename = $request->file('slider')->store('uploads/slider');
        }

        $data->update([
            'link_target' => $request->link_target,
            'path_slider' => $filename,
        ]);

        $prefix = str_replace('base64:','',env('APP_KEY'));
        Redis::del($prefix.'sliders');
        Redis::del($prefix.'_sliders');

        return redirect('admin/slider')->with([
            'success' => 'Berhasil Mengedit Gambar Slider',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Slider::findOrFail($id);
        if ($data->path_slider != null) {
            Storage::delete($data->path_slider);
        }

        $data->delete();
        return redirect('admin/slider')->with([
            'success' => 'Berhasil Menghapus Gambar Slider',
        ]);
    }
}
