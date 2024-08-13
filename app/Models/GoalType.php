<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoalType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'goal_type'
    ];
}
