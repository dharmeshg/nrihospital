<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
	protected $fillable = [
		'leave_type','allocated_day','max_carry_forward','carry_forward','description'
	];


}
