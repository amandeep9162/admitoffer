<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentQualificationTotal extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','type',
    ];
}
