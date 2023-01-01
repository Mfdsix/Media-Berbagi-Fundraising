<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\Qurban;

class CategoryController extends Controller
{
    public function index(){
        $categories = ProjectCategory::all();

        return view('front.category')->with([
            'categories' => $categories
        ]);
    }

    public function show($id = 0){
    	$category = ProjectCategory::findOrFail($id);
        if($category->category != 'qurban') {
            $projects = Project::where('category_id', $id)
            ->paginate(15);
        }else{
            $projects = Qurban::paginate(15);
        }
        $today = now();

        foreach ($projects as $key => $value) {
            $value->slug = ($value->slug == "") ? "/" : $value->slug;
            $value->is_unlimited = false;
            $donations = $value->countDonation();
            
            if($value->date_target == null && $value->nominal_target == null){
                $value->date_count = '∞';
                $value->date_target = '∞';
                $value->percentage = 100;
                $value->is_unlimited = true;
            }else{
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                $value->date_target = $this->date_to_idn($value->date_target);
                $value->percentage = $donations / $value->nominal_target * 100;
            }

            $value->donations = $donations;
            $value->donaturs = $value->countPeopleDonation();
        }

        return view('front.project.category')->with([
        	'category' => $category,
            'datas' => $projects,
        ]);
    }

    public function getProject($id, Request $request){
        $today = Date('Y-m-d');
        $projects = Project::leftJoin('project_categories', 'project_categories.id', '=', 'projects.category_id')
        ->where('category_id', $id)
        ->select('projects.*', 'project_categories.category as category_name')
        ->get();

        foreach ($projects as $key => $value) {
            $donations = $value->countDonation();
            $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
            $value->percentage = $donations / $value->nominal_target * 100;
            $value->donations = "Rp ".str_replace(',', '.', number_format($donations));
            if($value->path_featured == null){
                $value->path_featured = asset('images/project.jpg');
            }else{
                $value->path_featured = asset('storage/'.$value->path_featured);
            }

            $slug_url = $value->id.'-'.preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $value->title));
            $value->url = $slug_url;
        }

        return response()->json($projects);
    }
}
