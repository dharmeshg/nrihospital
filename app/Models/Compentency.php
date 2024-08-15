<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compentency extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'competencies';

    protected $fillable = [
        'title',
        'is_active',
        'competency_type_id'
   ];
}
