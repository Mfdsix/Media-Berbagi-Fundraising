<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Funding;
use App\Models\InstantProgram;
use App\Models\ProjectCategory;
use Auth;
use Illuminate\Http\Request;
use Storage;

class ZakatController extends Controller
{
    public function index()
    {
        $datas = Project::where('type', 'zakat')
            ->where('status', 1)
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

        $istant = [
            'key' => 'zakat',
            'title' => 'zakat',
            'donations' => Funding::where('project_id', 0)
                ->where('fund_type', 'zakat')
                ->where('status', 'paid')
                ->sum('nominal'),
            'is_active' => InstantProgram::where('program', 'zakat')
                ->pluck('is_active')
                ->first(),
            'instant' => InstantProgram::where('program', 'zakat')
                ->first(),
        ];

        return view('admin.zakat.index')->with([
            'datas' => $datas,
            'instant' => $istant,
        ]);
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.zakat.form')->with([
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $cm = [];
        foreach($request->custom_nominal as $key => $value) {
            array_push($cm, $value == "" ? ($key + 1) * 50000 : $value);
        }
        $request->merge([
            'custom_nominal' => $cm,
        ]);

        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'category_id' => 'required',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
            'fundraiser_reward' =>'nullable|numeric|max:100|min:0',
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

        $is_hidden = $request->is_hidden ? 1 : 0;

        Project::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'slug' => $request->slug,
            'path_featured' => $filename,
            'nominal_target' => ($is_unlimited) ? null : str_replace('.', '', $request->nominal_target),
            'date_target' => ($is_unlimited) ? null : Date('Y-m-d', strtotime($request->date_target)),
            'type' => 'zakat',
            'button_label' => $request->button_label,
            'operational_percentage' => $request->operational_percentage,
            'fundraiser_reward' => $request->fundraiser_reward,
            'custom_nominal' => json_encode($request->custom_nominal),
            'is_hidden' => !$is_hidden,
        ]);

        return redirect('admin/zakat')->with([
            'success' => 'Berhasil Menambahkan Program Zakat',
        ]);
    }

    public function edit($id)
    {
        $data = Project::where('id', $id)
            ->first();

        if($data == null && $id == 0) {
            $instant = InstantProgram::where('program', 'zakat')->first();
            $project = new Project();
            $project->id = 0;
            $project->title = $instant->title ?? "Program instant zakat";
            $project->type = "zakat";
            $project->is_hidden = $instant->is_active;
            $project->content = $instant->content;
            $project->button_label = $instant->label_button;
            $project->operational_percentage = $instant->operational;
            $project->fundraiser_reward = $instant->commision;
            $project->custom_nominal = $instant->custom_nominal;

            $data = $project;
        }else if($data == null && $id != 0) {
            abort(404);
        }

        $data->is_unlimited = false;

        if($data->custom_nominal == null) {
            $data->custom_nominal = [100000, 200000, 300000, 400000];
        }else{
            $data->custom_nominal = json_decode($data->custom_nominal);
        }

        if ($data->date_target == null && $data->nominal_target == null) {
            $data->is_unlimited = true;
            $data->date_target = null;
            $data->nominal_target = null;
        } else {
            $data->nominal_target = str_replace(',', '.', number_format($data->nominal_target));
            $data->date_target = Date('m/d/Y', strtotime($data->date_target));
        }
        $categories = ProjectCategory::all();
        return view('admin.zakat.form')->with([
            'categories' => $categories,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        if($id == 0){
            return $this->instantUpdate($request);
        }

        $cm = [];
        foreach($request->custom_nominal as $key => $value) {
            array_push($cm, $value == "" ? ($key + 1) * 50000 : $value);
        }
        $request->merge([
            'custom_nominal' => $cm,
        ]);

        $data = Project::where('id', $id)
            ->firstOrFail();

        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'category_id' => 'required',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
            'fundraiser_reward' =>'nullable|numeric|max:100|min:0',
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
        if ($data->slug != $request->slug) {
            $rules['slug'] = 'required|unique:projects';
        }
        if (!$request->operational_percentage) {
            $request->merge([
                'operational_percentage' => 0,
            ]);
        }

        $request->validate($rules);

        $filename = $data->path_featured;

        if ($request->hasFile('featured')) {
            if ($data->path_featured != null) {
                Storage::delete($data->path_featured);
            }
            $filename = $request->file('featured')->store('uploads/project');
        }

        $is_hidden = $request->is_hidden ? 1 : 0;

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
            'fundraiser_reward' => $request->fundraiser_reward,
            'custom_nominal' => json_encode($request->custom_nominal),
            'is_hidden' => !$is_hidden,
        ]);

        return redirect('admin/zakat')->with([
            'success' => 'Berhasil Mengedit Program Zakat',
        ]);
    }

    public function instantUpdate(Request $request) {
        $cm = [];
        foreach($request->custom_nominal as $key => $value) {
            array_push($cm, $value == "" ? ($key + 1) * 50000 : $value);
        }
        $request->merge([
            'custom_nominal' => $cm,
        ]);

        $data = InstantProgram::where('program', 'zakat')->firstOrFail();
        
        $rules = [
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:20',
            'featured' => 'nullable|max:5000|mimes:png,jpg,jpeg',
            'operational_percentage' => 'nullable|integer|max:100|min:0',
            'fundraiser_reward' =>'nullable|numeric|max:100|min:0',
        ];

        if (!$request->operational_percentage) {
            $request->merge([
                'operational_percentage' => 0,
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
            'path_featured' => $filename,
            'label_button' => $request->button_label,
            'operational' => $request->operational_percentage,
            'commision' => $request->fundraiser_reward,
            'custom_nominal' => json_encode($request->custom_nominal),
        ]);

        return redirect('admin/zakat')->with([
            'success' => 'Berhasil Mengedit Penggalangan Dana',
        ]);
    }

    public function destroy($id)
    {
        $data = Project::where('id', $id)
            ->firstOrFail();

        $data->update([
            'status' => 0
        ]);

        // if ($data->path_featured != null) {
        //     Storage::delete($data->path_featured);
        // }

        // $data->delete();
        return redirect('admin/zakat')->with([
            'success' => 'Berhasil Menghapus Program Zakat',
        ]);
    }
}
