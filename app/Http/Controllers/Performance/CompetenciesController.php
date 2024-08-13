<?php


namespace App\Http\Controllers\Performance;


use App\Http\Controllers\Controller;

class CompetenciesController extends Controller {

	public function index()
	{
		if(auth()->user()->can('manage-competencies'))
		{
			return view('performance.competencies.index');
		}
		return abort('403', __('You are not authorized'));
	}

}
