<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class College extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','ucode','description','website_link', 'city_id','country_id','university_id','instituteType','isCardRequired','isDocumentRequired','inserted_by','application_fee','preProcessBy','schoolType','entry_requirement','commission',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country');
    } 
    public function numberOfCourse()
    {
        return $this->hasMany('App\Models\Course','college_id','id');
    } 
    public function state()
    {
        return $this->belongsTo('App\Models\Loc\State');
    } 
    public function city()
    {
        return $this->belongsTo('App\Models\Loc\City');
    } 
    public function InstituteType()
    {
        return $this->belongsTo('App\Models\InstituteType','instituteType','id');
    } 
    public function attachment()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','logo');
    } 
     public function collegeSignedDocuments()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','collegeSignedDocument');
    } 
    public function structure()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','structure');
    } 
    public function schoolType()
    {
        return $this->belongsTo('App\Models\SchoolType','schoolType','id');
    }

    public function university()
    {
        return $this->belongsTo('App\Models\University','university_id','id');
    } 
    public function applications()
    {
        return $this->hasMany('App\Models\Agent\AppliedStudentFile','college_id','id');
    } 
   
}
