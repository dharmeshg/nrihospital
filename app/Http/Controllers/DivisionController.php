<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\CompanyType;
use App\Models\Division;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller {


	public function index()
	{

		if (request()->ajax())
		{
			return datatables()->of(Division::latest()->get())
				->setRowId(function ($division)
				{
					return $division->id;
				})
				->addColumn('action', function ($data)
				{
					    // $button = '<button type="button" name="show" id="' . $data->id . '" class="show_new btn btn-success btn-sm"><i class="dripicons-preview"></i></button>';
					    // $button .= '&nbsp;&nbsp;';
				
						$button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
						$button .= '&nbsp;&nbsp;';
				
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';
					
					return $button;
				})
				->rawColumns(['action'])
				->make(true);
		}

		return view('organization.division.index');
	}


	public function store(Request $request)
	{
		
			$validator = Validator::make($request->only('division_name'),
				[
					'division_name' => 'required'
				]
			);


			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}


			$data = [];
			$data['division_name'] = $request->division_name;

			Division::create($data);


			return response()->json(['success' => __('Data Added successfully.')]);
		
		
	}

	public function show($id)
	{
		if (request()->ajax()) {
			$data = company::with(['location.country','companyType:id,type_name'])->findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{

		if (request()->ajax())
		{
            $data = Division::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	public function update(Request $request)
	{

		$logged_user = auth()->user();

			$id = $request->hidden_id;

			$validator = Validator::make($request->only('division_name'),
				[
					'division_name' => 'required'
				]
			);


			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}


			$data = [];
			$data['division_name'] = $request->division_name;

			Division::whereId($id)->update($data);

			return response()->json(['success' => __('Data is successfully updated')]);




	}


	public function destroy($id)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}



         Division::whereId($id)->delete();
	     return response()->json(['success' => __('Data is successfully deleted')]);


	}


	public function delete_by_selection(Request $request)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}

		$division_id = $request['divisionIdArray'];
		$division = Division::whereIntegerInRaw('id', $division_id);

		if ($division->delete())
		{
			return response()->json(['success' => __('Multi Delete',['key'=>trans('file.Division')])]);
		} else
		{
			return response()->json(['error' => 'Error,selected records can not be deleted']);
		}
	}

}


