<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sop_pendency extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'application_id','reason','is_your_content_original','student_id','status','sop_name','sop_path','is_uni_sop','is_course_sop','sop_background','does_sop_clear_student_course_uni','does_sop_clear_student_career_goal','define_why_student_to_study_uk'
    ];
}
