<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentQualification extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'student_id','qualificationName','subject','board','instituteName','country_id','state_id','city_id','from','to','total',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Agent\Student','student_id','id');
    } 
    public function qualification()
    {
        return $this->belongsTo('App\Models\QualificationGrade','qualificationName','id');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country');
    } 
    public function state()
    {
        return $this->belongsTo('App\Models\Loc\State');
    } 
    public function city()
    {
        return $this->belongsTo('App\Models\Loc\City');
    }  
    public function totals()
    {
        return $this->belongsTo('App\Models\StudentQualificationTotal','total','id');
    }  
    public function documents()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id');
    }  
    public function qualificationDocuments()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','qualification');
    }  
    public function boards()
    {
        return $this->belongsTo('App\Models\QualificationBoard','board','id');
    }  
    
}
