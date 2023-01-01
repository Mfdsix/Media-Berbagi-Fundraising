<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectFavourite;
use Illuminate\Support\Facades\Validator;

class ProjectFavouriteController extends Controller
{
    public function index() {
        $favourite = ProjectFavourite::where('user_id', auth()->user()->id)->get();
        return $this->success($favourite);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error(implode(',', $validator->messages()->all()), 422);
        }

        $current = ProjectFavourite::where('user_id', auth()->user()->id)
            ->where('project_id', $request->project_id)
            ->first();
        if ($current == null) {
            $favourite = ProjectFavourite::create([
                'project_id' => $request->project_id,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $favourite = $current->delete();
        }

        return $this->success($favourite);
    }
}
