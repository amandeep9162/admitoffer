<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'course_unique_id','perority','college_id','college_name','institute_type','inserted_by','verify_by','name','subject','program_weblink','durationText','programTitle_id','description','workexp','academicRequirement','highlyCompetitive','internship','program_length','intake','merge_intake_id','qualification','programTitle_name','course_level','program_delivery','tution_fee','application_fee','isIlets','ilets_score','english_score','program_status','scholarship','isMath','mathScore','total_commission','agent_commission','country','state','city','admission_overseasCut','processing_time','note'
    ];

    public function college()
    {
        return $this->belongsTo('App\Models\College','college_id','id')->select(array('id', 'ucode', 'status', 'name', 'description', 'website_link', 'university_id', 'instituteType', 'preProcessBy', 'inserted_by', 'schoolType', 'city_id', 'country_id'));
    } 
    public function subjects()
    {
        return $this->belongsTo('App\Models\Subject','subject','id');
    } 
    public function program_lengths()
    {
        return $this->belongsTo('App\Models\ProgramLength','program_length','id');
    } 
    public function programTitle()
    {
        return $this->belongsTo('App\Models\ProgramTitle','programTitle_id','id');
    }
    public function countrys()
    {
        return $this->belongsTo('App\Models\Loc\Country','country','id');
    } 
   
    public function states()
    {
        return $this->belongsTo('App\Models\Loc\State','state','id');
    } 
    public function citys()
    {
        return $this->belongsTo('App\Models\Loc\City','city','id');
    } 
    
    public function qualifications()
    {
        return $this->belongsTo('App\Models\Qualification','qualification','id');
    } 
    public function course_levels()
    {
        return $this->belongsTo('App\Models\CourseLevel','course_level','id');
    } 
    public function iletsScores()
    {
        return $this->belongsTo('App\Models\IletsScore','ilets_score','id');
    } 
    public function intakes()
    {
        return $this->belongsTo('App\Models\Intake','intake','id');
    } 
    public function Courseintakes()
    {
        return $this->hasMany('App\Models\CourseIntake','course_id','id');
    } 
    public function getenglishScore()
    {
        return $this->belongsTo('App\Models\EnglishScore','english_score','id');
    } 
    public function getmathScore()
    {
        return $this->belongsTo('App\Models\MathScore','mathScore','id');
    } 
    
    
     
}
