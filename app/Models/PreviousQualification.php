<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreviousQualification extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];
}
