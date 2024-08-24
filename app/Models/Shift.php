<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
	protected $fillable = [
		'division_id','code','shift_name','start_time','end_time','br_out_time',
		'br_in_time','grace_in','grace_out','half_day','full_day','shift_based','day_off_allowed'
	];

	public function division()
    {
        return $this->belongsTo(Division::class);
    }
}