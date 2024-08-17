<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeContact extends Model
{
	use SoftDeletes;

	protected $guarded=[];
	protected $dates = ['deleted_at'];
	
	public function employee(){
		return $this->hasOne('App\Models\Employee','id','employee_id');
	}

    public function relationType(){
		return $this->belongsTo(RelationType::class,'relation_type_id');
	}
}
