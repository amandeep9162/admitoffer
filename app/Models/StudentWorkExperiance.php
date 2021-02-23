<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentWorkExperiance extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'organization','designation','fromDate','toDate','student_id',
    ];
    public function documents()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','work');
    }
    public function workExperianceDocuments()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','qualification');
    } 
}
