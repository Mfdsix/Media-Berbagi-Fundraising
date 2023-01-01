<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inbox;
use Auth;

class InboxController extends Controller
{
	public function __construct(){
		$this->middleware(function ($request, $next) {      
			if(Auth::user()->level == 'admin'){
				return redirect('/admin');
			}elseif(Auth::user()->level == 'fundraiser'){
				return redirect('/fundraiser');
			}

			return $next($request);
		});
	}

	public function index(){
		$inbox = Inbox::where('user_id', Auth::user()->id)->paginate(15);

		foreach ($inbox as $key => $value) {
			$date = explode(' ', $value->created_at);
			$value->date = $this->date_to_idn($date[0]).' '.$date[1];
		}

		return view('front.inbox.index')->with([
			'datas' => $inbox
		]);
	}
}
