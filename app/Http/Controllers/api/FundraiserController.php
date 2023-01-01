<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fundraiser;

class FundraiserController extends Controller
{
    public function index() {
        $fundraisers = Fundraiser::all();
        return $this->success($fundraisers);
    }
}
