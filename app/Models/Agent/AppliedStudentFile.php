<?php

namespace App\Models\Agent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AppliedStudentFile extends Model
{
    use SoftDeletes;
    public $table ="applied_students_files";
    protected $fillable = [
        'student_id','country_id','reason','applied_at','course_id','interviewSchedule','interviewScheduleDate','interviewScheduleTime','college_id','university_id','preProcessBy_id','file_status','agent_id',
    ];

    public function offerLettr()
    {
        return $this->belongsTo('App\Models\ApplicationDocument','id','application_id')->where('type','offerletter');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Agent\Student','student_id','id');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id','id');
    }
    public function college()
    {
        return $this->belongsTo('App\Models\College','college_id','id');
    }
    public function university()
    {
        return $this->belongsTo('App\Models\University','university_id','id');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country','country_id','id');
    }
    public function applicationStatus()
    {
        return $this->belongsTo('App\Models\ApplicationStatus','file_status','id');
    }
    public function agent()
    {
        return $this->belongsTo('App\Agent','agent_id','id');
    } 
    public function assignedAppAgent()
    {
        return $this->belongsTo('App\Models\TeamProcessor','id','application_id');
    }
    public function sopPendency()
    {
        return $this->belongsTo('App\Models\Sop_pendency','id','application_id');
    }
    public function pendencies()
    {
        return $this->hasMany('App\Models\PendancyAttachment','application_id','id')->where('status',0);
    }
    public function timelines()
    {
        return $this->hasMany('App\Models\ApplicationStatusTimeline','application_id','id');
    }
}
