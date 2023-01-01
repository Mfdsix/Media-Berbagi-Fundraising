<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Auth;
use Illuminate\Http\Request;
use Storage;

class CampaignController extends Controller
{
    public function index()
    {
        $datas = Project::where('type', 'donation')
            ->paginate(15);

        foreach ($datas as $key => $value) {
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->date_target = '∞';
                $value->nominal_target = '∞';
            } else {
                $value->date_target = $this->date_to_idn($value->date_target);
                $value->nominal_target = 'Rp ' . str_replace(',', '.', number_format($value->nominal_target));
            }
        }

        return view('program.campaign.index')->with([
            'datas' => $datas,
        ]);
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        return view('program.campaign.form')->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'category_id' => 'required',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
        ];

        $is_unlimited = true;

        if (!$request->has('unlimited')) {
            $rules['nominal_target'] = 'required';
            $rules['date_target'] = 'required';
            $is_unlimited = false;
        }

        if (!$request->operational_percentage) {
            $request->merge([
                'operational_percentage' => 0,
            ]);
        }

        if ($request->slug == null) {
            $request->merge([
                'slug' => preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $request->title)),
            ]);
        }
        $rules['slug'] = 'required|unique:projects';

        $request->validate($rules);
        $filename = null;

        if ($request->hasFile('featured')) {
            $filename = $request->file('featured')->store('uploads/project');
        }

        Project::create([
            'user_id' => Auth::user()->id,
            'account_type' => 'program',
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'slug' => $request->slug,
            'path_featured' => $filename,
            'nominal_target' => ($is_unlimited) ? null : str_replace('.', '', $request->nominal_target),
            'date_target' => ($is_unlimited) ? null : Date('Y-m-d', strtotime($request->date_target)),
            'button_label' => $request->button_label,
            'operational_percentage' => $request->operational_percentage,
        ]);

        return redirect('dashboard-program/campaign')->with([
            'success' => 'Berhasil Menambahkan Penggalangan Dana',
        ]);
    }

    public function edit($id)
    {
        $data = Project::where('id', $id)
            ->firstOrFail();
        $data->is_unlimited = false;

        if ($data->date_target == null && $data->nominal_target == null) {
            $data->is_unlimited = true;
            $data->date_target = null;
            $data->nominal_target = null;
        } else {
            $data->nominal_target = str_replace(',', '.', number_format($data->nominal_target));
            $data->date_target = Date('m/d/Y', strtotime($data->date_target));
        }
        $categories = ProjectCategory::all();
        return view('program.campaign.form')->with([
            'categories' => $categories,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = Project::where('id', $id)
            ->firstOrFail();

        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'category_id' => 'required',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
        ];

        $is_unlimited = true;

        if (!$request->has('unlimited')) {
            $rules['nominal_target'] = 'required';
            $rules['date_target'] = 'required';
            $is_unlimited = false;
        }
        if ($request->slug == null) {
            $request->merge([
                'slug' => preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $request->title)),
            ]);
        }
        // $rules['slug'] = 'required|unique:projects';
        if (!$request->operational_percentage) {
            $request->merge([
                'operational_percentage' => 0,
            ]);
        }

        $request->validate($rules);

        if ($data->slug != $request->slug) {
            $request->validate([
                'slug' => 'unique:projects',
            ]);
        }

        $filename = $data->path_featured;

        if ($request->hasFile('featured')) {
            if ($data->path_featured != null) {
                Storage::delete($data->path_featured);
            }
            $filename = $request->file('featured')->store('uploads/project');
        }

        $data->update([
            'title' => $request->title,
            'content' => $request->content,
            'slug' => $request->slug,
            'category_id' => $request->category_id,
            'path_featured' => $filename,
            'nominal_target' => ($is_unlimited) ? null : str_replace('.', '', $request->nominal_target),
            'date_target' => ($is_unlimited) ? null : Date('Y-m-d', strtotime($request->date_target)),
            'button_label' => $request->button_label,
            'operational_percentage' => $request->operational_percentage,
        ]);

        return redirect('dashboard-program/campaign')->with([
            'success' => 'Berhasil Mengedit Penggalangan Dana',
        ]);
    }

    public function destroy($id)
    {
        $data = Project::where('id', $id)
            ->firstOrFail();
        if ($data->path_featured != null) {
            Storage::delete($data->path_featured);
        }

        $data->delete();
        return redirect('dashboard-program/campaign')->with([
            'success' => 'Berhasil Menghapus Penggalangan Dana',
        ]);
    }
}
