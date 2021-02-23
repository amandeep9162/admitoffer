<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendancyAttachment extends Model
{
    // status = '1 = uploaded by agent','2 = accept By admin','3 = reject By admin',
    use SoftDeletes;
    protected $fillable = [
        'application_id','name','path','type','status','reason','created_by','student_id','title','comment',
    ];
    
    public function qualification()
    {
        return $this->belongsTo('App\Models\QualificationGrade','type','id');
    } 
    public function applicationCourse()
    {
        return $this->belongsTo('App\Models\Course','application_id','id');
    } 
    public function student()
    {
        return $this->belongsTo('App\Models\Agent\Student','student_id','id');
    } 
}
