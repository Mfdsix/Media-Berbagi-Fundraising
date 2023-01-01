<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Auth;
use Storage;

class FundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Project::where('user_id', Auth::user()->id)
        ->where('category_id', 0)
        ->paginate(10);

        return view('admin.funding.index')->with([
            'datas' => $datas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.funding.form')->with([
            'categories' => $categories
        ]);
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
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
        ]);

        if(!$request->slug){
            $request->merge([
                'slug' => preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $request->title)),
            ]);
        }

        $request->validate([
            'slug' => 'required|unique:projects'
        ]);

        $filename = null;

        if($request->hasFile('featured')){
            $filename = $request->file('featured')->store('uploads/project');
        }

        Project::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'category_id' => 0,
            'path_featured' => $filename,
            'user_id' => Auth::user()->id,
            'is_fixed' => 0
        ]);

        return redirect('admin/funding')->with([
            'success' => 'Berhasil Menambahkan Program'
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
        $data = Project::where('user_id', Auth::user()->id)->findOrFail($id);
        $data->nominal_target = str_replace(',', '.', number_format($data->nominal_target));
        $data->date_target = Date('m/d/Y',strtotime($data->date_target));
        $categories = ProjectCategory::all();
        return view('admin.funding.form')->with([
            'categories' => $categories,
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
        $data = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
        ]);

        if($request->slug == null){
            $request->merge([
                'slug' => preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $request->title)),
            ]);
        }

        if($data->slug != $request->slug){
           $request->validate([
            'slug' => 'required|unique:projects'
        ]);
       }

       $filename = $data->path_featured;

       if($request->hasFile('featured')){
        if($data->path_featured != null){
            Storage::delete($data->path_featured);
        }
        $filename = $request->file('featured')->store('uploads/project');
    }

    $data->update([
        'title' => $request->title,
        'slug' => $request->slug,
        'content' => $request->content,
        'path_featured' => $filename,
    ]);

    return redirect('admin/funding')->with([
        'success' => 'Berhasil Mengedit Penggalangan Dana'
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
        $data = Project::where('user_id', Auth::user()->id)->findOrFail($id);
        if($data->path_featured != null){
            Storage::delete($data->path_featured);
        }

        $data->delete();
        return redirect('admin/funding')->with([
            'success' => 'Berhasil Menghapus Penggalangan Dana'
        ]);
    }
}
