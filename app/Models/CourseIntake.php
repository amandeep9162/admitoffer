<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseIntake extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'intake_id','course_id'
    ];
}
