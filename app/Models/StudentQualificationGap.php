<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentQualificationGap extends Model
{
    use SoftDeletes;
    public $table ='student_academic_gaps';
    protected $fillable = [
        'organization','fromDate','toDate','student_id',
    ];

    public function documents()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','gap');
    }
    public function gapDocument()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','gap');
    }
}
