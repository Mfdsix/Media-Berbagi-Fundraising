<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doc;

class DocController extends Controller
{
	public function about_us()
	{
		$about_us = Doc::where('field', 'about_us')
		->pluck('content')
		->first();

		return view('front.doc.about_us')->with([
			'data' => $about_us
		]);
	}

	public function term_condition()
	{
		$term_condition = Doc::where('field', 'term_condition')
		->pluck('content')
		->first();

		return view('front.doc.term_condition')->with([
			'data' => $term_condition
		]);
	}

	public function help()
	{
		$help = Doc::where('field', 'help')
		->pluck('content')
		->first();

		return view('front.doc.help')->with([
			'data' => $help
		]);
	}

	public function setting()
	{
		$setting = Doc::where('field', 'setting')
		->pluck('content')
		->first();

		return view('front.doc.setting')->with([
			'data' => $setting
		]);
	}
}