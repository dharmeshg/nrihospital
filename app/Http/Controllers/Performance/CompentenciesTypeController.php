<?php


namespace App\Http\Controllers\Performance;

use App\Models\Employee;
use App\Models\EmployeeLeaveTypeDetail;
use App\Models\CompentencyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompentenciesTypeController {

    public function index()
	{
		if (request()->ajax())
		{
			return datatables()->of(CompentencyType::select('id', 'title')->get())
				->setRowId(function ($row)
				{
					return $row->id;
				})
				->addColumn('action', function ($data)
				{
					if (auth()->user()->can('access-compenteny_type')) {
						$button = '<button type="button" name="edit" id="' . $data->id . '" class="compenteny_type_edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
						$button .= '&nbsp;&nbsp;';
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="compenteny_type_delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

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
        // return response()->json($request->all());



		$logged_user = auth()->user();

		if ($logged_user->can('access-compenteny_type')) {
			$validator = Validator::make($request->only('title'),[
					'title' => 'required|unique:competency_types',
				]
			);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['title'] = $request->get('title');

			CompentencyType::create($data);

			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return abort('403', __('You are not authorized'));

	}


	public function edit($id)
	{
		if(request()->ajax())
		{
			$data = CompentencyType::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	public function update(Request $request)
	{
		$logged_user = auth()->user();

		if ($logged_user->can('access-compenteny_type'))
		{
			$id = $request->get('hidden_compentency_id');

			$validator = Validator::make($request->only('title_edit'),[
					'title_edit' => 'required|unique:competency_types,title,'.$id,
				]

			);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['title'] = $request->get('title_edit');

			CompentencyType::whereId($id)->update($data);

			return response()->json(['success' => __('Data is successfully updated')]);
		}
        else {
			return abort('403', __('You are not authorized'));
		}
	}


	public function destroy($id)
	{
		
		$logged_user = auth()->user();

		if ($logged_user->can('access-compenteny_type')) {
			CompentencyType::whereId($id)->delete();
			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		return abort('403',__('You are not authorized'));
	}

}



























