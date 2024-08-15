<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompentencyType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'competency_types';

    protected $fillable = [
        'title',
        'is_active'
   ];

   public function compentencies(){
        return $this->hasMany(Compentency::class,'competency_type_id');
    }
}
