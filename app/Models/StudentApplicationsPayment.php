<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentApplicationsPayment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'student_id','college_name','college_id','amount'
    ];
}
