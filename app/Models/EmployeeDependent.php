<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDependent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employee_id','name','gender','relation_type_id','date_of_birth','aadhar_no','mediclaim_no','pf_nominee','pf'];

    protected $dates = ['deleted_at'];

    public function employee(){
        return $this->hasOne('App\Models\Employee','id','employee_id');
    }

    public function relationType(){
        return $this->belongsTo(RelationType::class,'relation_type_id');
    }
}
