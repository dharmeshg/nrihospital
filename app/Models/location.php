<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class location extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'location_name', 'location_head', 'address1','address2','city','state','country','zip',
	];

	public function country(){
		return $this->hasOne('App\Models\Country','id','country');
	}

	public function LocationHead(){
		return $this->hasOne('App\Models\Employee','id','location_head');
	}


}
