<?php

namespace App\Http\Controllers\Fundraiser;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $fundraiser = Auth::user()->fundraiser;
        return view('fundraiser.profile.index')->with([
            'fundraiser' => $fundraiser,
            'provinces' => $this->getProvinces(),
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'type' => 'required|in:personal,instance',
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'person_in_charge' => 'required',
            'province' => 'required',
        ];

        $fundraiser = Auth::user()->fundraiser;
        if ($fundraiser) {

            if ($request->email != $fundraiser->email) {
                $rules['email'] .= '|unique:fundraisers';
            }
            if ($request->phone != $fundraiser->phone) {
                $rules['phone'] .= '|unique:fundraisers';
            }

            $request->validate($rules);

            $fundraiser->update([
                'type' => $request->type,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'person_in_charge' => $request->person_in_charge,
                'province' => $request->province,
            ]);

            return redirect("/fundraiser/profile");
        }

        abort(404);
    }
}
