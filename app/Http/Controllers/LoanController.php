<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SalaryLoan;
use App\Models\LoanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller {

	public function show()
	{
		$logged_user = auth()->user();

		if ($logged_user->can('view-details-loan'))
		{
			if (request()->ajax())
			{
				return datatables()->of(SalaryLoan::orderByRaw('DATE_FORMAT(first_date, "%y-%m")')->get())
					->setRowId(function ($loan)
					{
						return $loan->id;
					})
					->addColumn('loan_type', function ($row){
						return isset($row->getloan->type_name) ? $row->getloan->type_name : '-';
					})
					->addColumn('loan_remaining', function ($row)
					{
						return __('Amount Remaining: '). $row->amount_remaining. '<br>' .
							__('Installment Remaining: '). $row->time_remaining ;
					})
					->addColumn('action', function ($data)
					{
						if (auth()->user()->can('modify-details-employee'))
						{
							$button = '<button type="button" name="edit" id="' . $data->id . '" class="loan_edit btn btn-primary btn-sm"><i class="dripicons-pencil"></i></button>';
							$button .= '&nbsp;&nbsp;';

							return $button;
						} else
						{
							return '';
						}
					})
					->rawColumns(['action','loan_remaining'])
					->make(true);
			}
			return view('employee.loan.index');
		}

		return response()->json(['success' => __('You are not authorized')]);

	}

	public function store(Request $request, Employee $employee)
	{

		if (auth()->user()->can('store-details-employee'))
		{
			$validator = Validator::make($request->only('month_year','loan_title', 'loan_amount',
				'reason', 'loan_type_id'),
				[
					'month_year' => 'required',
					'loan_type_id' => 'required',
					'loan_amount' => 'required|numeric',
				]
			);

			if ($validator->fails()) {
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$first_date = date('Y-m-d', strtotime('first day of ' . $request->month_year));

			$data = [];

			$data['month_year'] = isset($request->month_year) ? $request->month_year : '-';
			$data['first_date'] = $first_date;
			$data['loan_title'] = isset($request->loan_title) ? $request->loan_title : '-';
			$data['employee_id'] = $employee->id;
			$data['loan_amount'] = $request->loan_amount;
			$data['loan_type_id'] = $request->loan_type_id;
			$data['loan_time'] = $request->loan_time;
			$data['time_remaining'] = $request->loan_time;
			$data['interest_rate'] = $request->interest_rate;
			$data['emi_amount'] = $request->emi_amount;
			$data['amount_remaining'] = $request->total_amount;
			$data['total_amount'] = $request->total_amount;

			$loan_year = ($data['loan_time'])/12;
			$si = ($data['loan_amount'] * $data['interest_rate'] * $loan_year) / 100;
			
			$data['monthly_payable'] = $si / $data['loan_time'];

			//$data ['monthly_payable'] = number_format (($data['loan_amount'] / $data['loan_time']) ,3);
			// $data ['monthly_payable'] = bcdiv(($data['loan_amount'] / $data['loan_time']), 1, 2);
			$data ['reason'] = $request->reason;

			SalaryLoan::create($data);


			return response()->json(['success' => __('Data Added successfully.')]);
		}

		return response()->json(['success' => __('You are not authorized')]);

	}

	public function edit($id)
	{
		if (request()->ajax())
		{
			$data = SalaryLoan::findOrFail($id);

			return response()->json(['data' => $data]);
		}
	}

	public function update(Request $request)
	{
		if (auth()->user()->can('modify-details-employee'))
		{
			$id = $request->hidden_id;

			$loan = SalaryLoan::findOrFail($id);

			$validator = Validator::make($request->only('month_year','loan_title', 'loan_amount',
				'reason', 'loan_type_id'),
				[
					'month_year' => 'required',
					'loan_title' => 'required',
					'loan_type_id' => 'required',
				]
			);


			if ($validator->fails())
			{
				return response()->json(['errors' => $validator->errors()->all()]);
			}

			$first_date = date('Y-m-d', strtotime('first day of ' . $request->month_year));

			$data = [];
			$data['month_year'] = $request->month_year;
			$data['first_date'] = $first_date;
			$data['loan_title'] = $request->loan_title;
			$data['loan_type_id'] = $request->loan_type_id;
			$data['loan_time'] = $request->loan_time;
			$data['loan_amount'] = $loan->loan_amount;

			$paid_month = $loan->loan_time - $loan->time_remaining;

			$data['time_remaining'] = $data['loan_time'] - $paid_month ;
			$data ['monthly_payable'] = number_format(($data['loan_amount'] / $data['time_remaining']), 3);
            // $data ['monthly_payable'] = bcdiv(($data['loan_amount'] / $data['loan_time']), 1, 2);

			$data ['reason'] = $request->reason;

			SalaryLoan::whereId($id)->update($data);

			return response()->json(['success' => __('Data is successfully updated')]);
		}

		return response()->json(['success' => __('You are not authorized')]);
	}


}
