<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectFavourite;
use Auth;

class ProgramController extends Controller
{
    public function index($id = null)
    {
        $projects = Project::where(function ($q) {
                $q->where('date_target', null)
                ->orWhere('date_target', '>=', now());
            })
            ->where('is_hidden', 0)
            ->where('status', 1)
            ->orderBy('donations', 'DESC')
            ->when($id, function ($q) use ($id) {
                return $q->where('category_id', $id);
            })
            ->get();
        $new = Project::where(function ($q) {
                $q->where('date_target', null)
                ->orWhere('date_target', '>=', now());
            })
            ->where('is_hidden', 0)
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->when($id, function ($q) use ($id) {
                return $q->where('category_id', $id);
            })
            ->get();

        $categories = ProjectCategory::orderBy('order_number')
            ->get();
        
        if($id != null) {
            $category_title = ProjectCategory::find($id);
            if($category_title != null){
                $category_title = $category_title->title;
            }
        }else{
            $category_title = "Program";
        }

        if($this->theme) {
            $theme = $this->theme->theme;
            if(property_exists($this->theme->script, 'program')) {
                $script = $this->theme->script->program;
                $theme = "themes/".$theme.'/'.$script;
                $theme = str_replace(".blade.php", "", $theme);
            }else{
                $theme = 'front.program.index';
            }
        }else{
            $theme = 'front.program.index';
        }

        return view($theme)->with([
            'projects' => $projects,
            'new' => $new,
            'categories' => $categories,
            'cid' => $id,
            'title' => $category_title,
        ]);
    }

    public function favourite()
    {
        $today = Date('Y-m-d');
        $project = ProjectFavourite::where('user_id', Auth::user()->id)
            ->get(); // Get All program favorite by user id (Auth::user()->id)

        foreach ($project as $key => $v) {
            $program = Project::find($v->project_id); // Get detail program by id program on Models ProjectFavorite ($v->project_id)
            $v->detail = $program; // Add detail on $project
            if ($program->date_target == null && $program->nominal_target == null) {
                $program->date_count = '∞';
                $program->date_target = '∞';
                $program->percentage = 100;
                $program->is_unlimited = true;
            } else {
                $program->date_count = date_diff(date_create($program->date_target), date_create($today))->days;
                $program->date_target = $this->date_to_idn($program->date_target);
                $program->percentage = $program->nominal_target * 100;
            }
            $funding = Funding::where('project_id', $v->project_id)->get(); // Get detail program by id program on Models ProjectFavorite ($v->project_id)
            $amount = 0;
            $total = 0;
            foreach ($funding as $key => $vs) {
                $total = 1 + $total;
                $amount = $amount + $vs->nominal;
            }

            $v->funding = ['amount' => $amount, 'total' => $total];
        }

        return view('front.program.favourite')->with([
            'project' => $project,
        ]);

    }
}
