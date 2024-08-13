<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalTracking extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'goal_type_id',
        'subject',
        'target_achievement',
        'description',
        'start_date',
        'end_date',
        'progress',
        'status',
        'is_active',
    ];

    public function company(){
        return $this->hasOne('App\Models\company','id','company_id');
    }

    public function goalType(){
        return $this->hasOne('App\Models\GoalType','id','goal_type_id');
    }
}
