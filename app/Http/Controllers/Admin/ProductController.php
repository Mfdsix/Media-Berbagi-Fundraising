<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Product::paginate();
        return view('admin.product.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.form');
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
            'name' => 'required',
            'price' => 'required|numeric',
            'detail' => 'required',
            'photo' => 'required|mimes:jpg,png,webp,jpeg',
            'url' => 'required|numeric',
        ]);

        $filename = null;
        if ($request->hasFile('photo')) {
            $filename = $request->file('photo')->store('uploads/product');
        }

        Product::create([
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'detail' => $request->detail,
            'thumbnail' => $filename,
            'url' => 'https://wa.me/' . $request->url,
            'custom' => $request->custom,
        ]);

        return redirect('admin/product')->with([
            'success' => 'Berhasil Menambahkan Produk Baru'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Product::where('id', $id)
            ->firstOrFail();
        return view('admin.product.form')->with([
            'data' => $data
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
        $data = Product::where('id', $id)
            ->firstOrFail();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'detail' => 'required',
            'photo' => 'mimes:jpg,png,webp,jpeg',
            'url' => 'required|numeric',
        ]);

        $filename = $data->thumbnail;
        if ($request->hasFile('photo')) {
            $filename = $request->file('photo')->store('uploads/product');
        }

        $data->update([
            'name' => $request->name,
            'price' => str_replace('.', '', $request->price),
            'detail' => $request->detail,
            'thumbnail' => $filename,
            'url' => 'https://wa.me/' . $request->url,
            'custom' => $request->custom,
        ]);

        return redirect('admin/product')->with([
            'success' => 'Berhasil Mengedit Produk Baru'
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
        $data = Product::where('id', $id)
            ->firstOrFail();
        if ($data->thumbnail != null) {
            Storage::delete($data->thumbnail);
        }

        $data->delete();
        return redirect('admin/product')->with([
            'success' => 'Berhasil Menghapus Product'
        ]);
    }
}
