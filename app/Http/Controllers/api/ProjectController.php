<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Funding;
use App\Models\Project;
use App\Models\ProjectFavourite;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->type;
        $category = $request->category_id;
        $page = ($request->page) ?? 1;
        $limit = $request->limit ?? 10;

        $projects = Project::when($type, function ($q) use ($type) {
            return $q->where('type', $type);
        })
            ->when($category, function ($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when(true, function ($q) use ($page, $limit) {
                if ($page == 0) {
                    $page = 1;
                }
                if ($limit == 0) {
                    $limit = 15;
                }
                if ($limit > 30) {
                    $limit = 30;
                }

                return $q->offset(($page - 1) * $limit)
                    ->limit($limit);
            })
            ->orderBy('order_number', 'ASC')
            ->get();

        $today = now();

        foreach ($projects as $key => $value) {
            $value->is_unlimited = false;
            if ($value->date_target == null && $value->nominal_target == null) {
                $value->is_unlimited = true;
                $value->date_count = null;
                $value->date_target = null;
                $value->percentage = 100;
                $value->is_unlimited = true;
            } else {
                $value->date_count = date_diff(date_create($value->date_target), date_create($today))->days;
                $value->date_target = $this->date_to_idn($value->date_target);
                $donations = $value->countDonation();
                $value->percentage = $donations / $value->nominal_target * 100;
            }

            if ($value->path_featured) {
                $value->path_featured = asset('storage/' . $value->path_featured);
            }
            $donations = $value->countDonation();
            $value->donations = $donations;
            $value->donaturs = $value->countPeopleDonation();

            $category = $value->category;

            if ($category && $category->path_icon) {
                $category->path_icon = asset('storage/' . $category->path_icon);
            }
            $value->category = $value->category;
        }

        return $this->success($projects);
    }

    public function show($id)
    {
        $project = Project::find($id);

        $today = now();
        $donations = $project->countDonation();

        if ($project) {
            $project->is_unlimited = false;
            if ($project->date_target == null && $project->nominal_target == null) {
                $project->is_unlimited = true;
                $project->date_count = null;
                $project->date_target = null;
                $project->percentage = 100;
                $project->is_unlimited = true;
            } else {
                $project->date_count = date_diff(date_create($project->date_target), date_create($today))->days;
                $project->date_target = $this->date_to_idn($project->date_target);
                $project->percentage = $donations / $project->nominal_target * 100;
            }

            if ($project->path_featured) {
                $project->path_featured = asset('storage/' . $project->path_featured);
            }
            $project->donations = $donations;
            $project->donaturs = $project->countPeopleDonation();

            $category = $project->category;

            if ($category && $category->path_icon) {
                $category->path_icon = asset('storage/' . $category->path_icon);
            }
            $project->category = $project->category;

            if (auth()->check() == true) {
                $favourite = ProjectFavourite::where('user_id', auth()->user()->id)
                    ->where('project_id', $project->id)
                    ->first();
                $project->is_favourite = $favourite;
            }

            return $this->success($project);
        }

        return $this->error("Campaign Tidak Ditemukan", 404);
    }

    public function donation($id)
    {
        $project = Project::find($id);

        if ($project) {
            $fundings = Funding::leftJoin('users', 'users.id', '=', 'fundings.user_id')
                ->where('project_id', $id)
                ->where('status', 'paid')
                ->orderBy('created_at', 'DESC')
                ->select('fundings.*', 'users.path_foto')
                ->get();

            return $this->success($fundings);
        }

        return $this->error("Campaign Tidak Ditemukan", 404);
    }

    public function news($id)
    {
        $project = Project::find($id);

        if ($project) {
            $update = $project->news()
                ->orderBy('created_at', 'DESC')
                ->get();

            foreach ($update as $key => $value) {
                if ($value->update_type == 0) {
                    $value->title = 'Kabar Terkini';
                } else {
                    $value->title = 'Pencairan Dana ' . number_format($value->nominal, 0, ',', '.');
                }
                $date = explode(' ', $value->created_at);
                $value->date = $this->date_to_idn($date[0]) . ' ' . $date[1];
            }

            return $this->success($update);
        }

        return $this->error("Campaign Tidak Ditemukan", 404);
    }

    public function search(Request $request)
    {
        $projects = Project::where('title', 'LIKE', '%' . $request->q . '%')->get();
        return $this->success($projects);
    }

    // create function to upload image file
    public function upload(Request $request)
    {
        $request->validate([
            "file" => "required|max:10000|mimes:png,jpg,jpeg"
        ]);
        $path = $request->file('file')->store('uploads/tmp');
        return url("storage/".$path);
    }
}
