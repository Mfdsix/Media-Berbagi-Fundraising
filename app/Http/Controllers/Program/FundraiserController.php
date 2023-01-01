<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\Fundraiser;

class FundraiserController extends Controller
{

    public function index()
    {
        $fundraisers = Fundraiser::orderBy('id', 'DESC')
            ->paginate(25);

        return view('program.fundraiser.index')->with([
            'fundraiser' => $fundraisers,
        ]);
    }

    public function leaderboard()
    {
        $fundraisers = Fundraiser::orderBy('collected', 'DESC')
            ->paginate(25);

        return view('program.fundraiser.leaderboard')->with([
            'fundraiser' => $fundraisers,
        ]);
    }
}
