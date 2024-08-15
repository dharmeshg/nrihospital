<?php

namespace App\Http\Controllers\Performance;

use App\Http\Controllers\Controller;
use App\Models\Compentency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompentencydataController extends Controller{

    public function index()
	{
		if (request()->ajax())
		{
			return datatables()->of(Compentency::select('id', 'title')->get())
				->setRowId(function ($row)
				{
					return $row->id;
				})
				->addColumn('action', function ($data)
				{
					if (auth()->user()->can('access-compenteny_type')) {
						$button = '<button type="button" name="edit" id="' . $data->id . '" class="compenteny_type_edit1 btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
						$button .= '&nbsp;&nbsp;';
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="compenteny_type_delete1 btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';

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
			$data['competency_type_id'] = $request->get('type_id');

			Compentency::create($data);

			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return abort('403', __('You are not authorized'));

	}


	public function edit($id)
	{
		if(request()->ajax())
		{
			$data = Compentency::findOrFail($id);

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
					'title_edit' => 'required|unique:competencies,title,'.$id,
				]
			);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$data = [];
			$data['title'] = $request->get('title_edit');

			Compentency::whereId($id)->update($data);

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
			Compentency::whereId($id)->delete();
			return response()->json(['success' => __('Data is successfully deleted')]);
		}
		return abort('403',__('You are not authorized'));
	}

}



























