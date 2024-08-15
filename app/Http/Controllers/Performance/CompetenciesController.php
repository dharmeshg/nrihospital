<?php


namespace App\Http\Controllers\Performance;

use App\Http\Controllers\Controller;
use App\Models\CompentencyType;

class CompetenciesController extends Controller {

	public function index()
	{
		if(auth()->user()->can('manage-competencies'))
		{
			$compentency = CompentencyType::select('id', 'title')->get();
			return view('performance.competencies.index', compact('compentency'));
		}
		return abort('403', __('You are not authorized'));
	}

}
