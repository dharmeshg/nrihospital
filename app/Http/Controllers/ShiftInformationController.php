<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Shift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class ShiftInformationController extends Controller {


	public function index()
	{
		$divisions = Division::select('id', 'division_name')->get();


		if (request()->ajax())
		{
			return datatables()->of(Shift::with('division')->latest()->get())
			    ->setRowId(function ($shift){
					return $shift->id;
				})
				->addColumn('division_name', function ($data) {
					return $data->division ? $data->division->division_name : '-';
				})
				->addColumn('action', function ($data)
				{
						$button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
						$button .= '&nbsp;&nbsp;';
				
						$button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></button>';
					
					return $button;
				})
				->rawColumns(['action','division_name'])
				->make(true);
		}

		return view('organization.shift.index', compact('divisions'));
	}


	public function store(Request $request)
	{
        $validator = Validator::make($request->only('division_id','code','shift_name','start_time','end_time'),
            [
                'division_id' => 'required',
                'code' => 'required',
                'shift_name' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $data = [];
        $data['division_id'] = $request->division_id;
        $data['code'] = $request->code;
        $data['shift_name'] = $request->shift_name;
        $data['start_time'] = $request->start_time;
        $data['end_time'] = $request->end_time;
        $data['br_out_time'] = $request->br_out_time;
        $data['br_in_time'] = $request->br_in_time;
        $data['grace_in'] = $request->grace_in;
        $data['grace_out'] = $request->grace_out;
        $data['half_day'] = $request->half_day;
        $data['full_day'] = $request->full_day;
        $data['shift_based'] = isset($request->shift_based) ? 'Yes' : 'No';
        $data['day_off_allowed'] = isset($request->day_off_allowed) ? 'Yes' : 'No';


        $shift =Shift::create($data);

        return response()->json(['success' => __('Data Added successfully.')]);
		
		
	}

	public function edit($id)
	{

		if (request()->ajax())
		{
            $data = Shift::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}
	public function update(Request $request)
	{

		$logged_user = auth()->user();

			$id = $request->hidden_id;

			$validator = Validator::make($request->only('division_id','code','shift_name','start_time','end_time'),
				[
					'division_id' => 'required',
					'code' => 'required',
					'shift_name' => 'required',
					'start_time' => 'required',
					'end_time' => 'required',
				]
			);


			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}


			$data = [];
			$data['division_id'] = $request->division_id;
			$data['code'] = $request->code;
			$data['shift_name'] = $request->shift_name;
			$data['start_time'] = $request->start_time;
			$data['end_time'] = $request->end_time;
			$data['br_out_time'] = $request->br_out_time;
			$data['br_in_time'] = $request->br_in_time;
			$data['grace_in'] = $request->grace_in;
			$data['grace_out'] = $request->grace_out;
			$data['half_day'] = $request->half_day;
			$data['full_day'] = $request->full_day;
			$data['shift_based'] = isset($request->shift_based) ? 'Yes' : 'No';
			$data['day_off_allowed'] = isset($request->day_off_allowed) ? 'Yes' : 'No';

			Shift::whereId($id)->update($data);

			return response()->json(['success' => __('Data is successfully updated')]);

	}
	public function destroy($id)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}
        Shift::whereId($id)->delete();
	     return response()->json(['success' => __('Data is successfully deleted')]);

	}
	public function delete_by_selection(Request $request)
	{
		if(!env('USER_VERIFIED'))
		{
			return response()->json(['error' => 'This feature is disabled for demo!']);
		}

		$shift_id = $request['shiftIdArray'];
		$shift = Shift::whereIntegerInRaw('id', $shift_id);

		if ($shift->delete())
		{
			return response()->json(['success' => __('Multi Delete',['key'=>trans('file.Shift')])]);
		} else
		{
			return response()->json(['error' => 'Error,selected records can not be deleted']);
		}
	}

	// public function show($id)
	// {
	// 	if (request()->ajax()) {
	// 		$data = company::with(['location.country','companyType:id,type_name'])->findOrFail($id);

	// 		return response()->json(['data' => $data]);
	// 	}
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	// public function edit($id)
	// {

	// 	if (request()->ajax())
	// 	{
    //         $data = Division::findOrFail($id);

	// 		return response()->json(['data' => $data]);
	// 	}
	// }

	// public function update(Request $request)
	// {

	// 	$logged_user = auth()->user();

	// 		$id = $request->hidden_id;

	// 		$validator = Validator::make($request->only('division_name'),
	// 			[
	// 				'division_name' => 'required'
	// 			]
	// 		);


	// 		if ($validator->fails()) {
	// 			return response()->json(['errors' => $validator->errors()->all()]);
	// 		}


	// 		$data = [];
	// 		$data['division_name'] = $request->division_name;

	// 		Division::whereId($id)->update($data);

	// 		return response()->json(['success' => __('Data is successfully updated')]);




	// }


	// public function destroy($id)
	// {
	// 	if(!env('USER_VERIFIED'))
	// 	{
	// 		return response()->json(['error' => 'This feature is disabled for demo!']);
	// 	}



    //      Division::whereId($id)->delete();
	//      return response()->json(['success' => __('Data is successfully deleted')]);


	// }


	// public function delete_by_selection(Request $request)
	// {
	// 	if(!env('USER_VERIFIED'))
	// 	{
	// 		return response()->json(['error' => 'This feature is disabled for demo!']);
	// 	}

	// 	$division_id = $request['divisionIdArray'];
	// 	$division = Division::whereIntegerInRaw('id', $division_id);

	// 	if ($division->delete())
	// 	{
	// 		return response()->json(['success' => __('Multi Delete',['key'=>trans('file.Division')])]);
	// 	} else
	// 	{
	// 		return response()->json(['error' => 'Error,selected records can not be deleted']);
	// 	}
	// }

}


