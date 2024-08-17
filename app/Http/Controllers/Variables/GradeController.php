<?php

namespace App\Http\Controllers\Variables;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index()
	{
		if (request()->ajax())
		{
			return datatables()->of(Grade::select('id', 'name')->get())
				->setRowId(function ($row)
				{
					return $row->id;
				})
				->addColumn('action', function ($data)
				{
					if (auth()->user()->can('access-variable_type')) {
						$button = '<button type="button" name="edit" id="' . $data->id . '" class="grade_edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
						$button .= '&nbsp;&nbsp;';
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="grade_delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

						return $button;
					}
                    else {
						return '';
					}
				})
				->rawColumns(['action'])
				->make(true);
		}

	}

	public function store(Request $request)
	{
		
		$logged_user = auth()->user();

		if ($logged_user->can('access-variable_type')) {
			$validator = Validator::make($request->only('name'),[
					'name' => 'required',
				]
			);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['name'] = $request->get('name');

			Grade::create($data);

			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return abort('403', __('You are not authorized'));

	}


	public function edit($id)
	{
		if(request()->ajax())
		{
			$data = Grade::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	public function update(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('access-variable_type'))
		{
			$id = $request->get('hidden_grade_id');

			$validator = Validator::make($request->only('name'),[
					'name' => 'required',
				]

			);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['name'] = $request->get('name');

			Grade::whereId($id)->update($data);

			return response()->json(['success' => __('Data is successfully updated')]);
		}
        else {
			return abort('403', __('You are not authorized'));
		}
	}
	public function destroy($id)
	{
		if(!env('USER_VERIFIED')) {
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}

		$logged_user = auth()->user();
		if ($logged_user->can('access-variable_type')) {
			Grade::whereId($id)->delete();
			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		return abort('403',__('You are not authorized'));
	}
}
