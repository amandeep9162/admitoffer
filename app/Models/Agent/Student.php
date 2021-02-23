<?php

namespace App\Models\Agent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Attachment;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use SoftDeletes;
    protected $fillable = [
        'student_unique_id','agent_id','student_status','reason','shortlisting','IsShortlisting','password','comment','remember_token','title','firstName','middleName','lastName','mobileNo','previousQualification','englishScore','mathScore','dateOfBirth','maritalStatus','passportNo','passportIssueDate','passportExpiryDate','phoneNo','email','status','skypeId','firstLanguage','applingForCountry','applingForLevel','gender','city_id','country_id','state_id','address','zipCode','nationality','countryOfBirth','detail','category','applied_at','applicationFee_status','application_total_fee','application_fee_paid_amount',
    ];

    // lock_status = 0 by default
    // lock_status = 1 locked
     protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function studentImage()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','student_id')->where('type','StudentImage');
    }
    public function passport()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','student_id')->where('type','passport');
    }
    public function dobDoc()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','student_id')->where('type','dobDoc');
    }
    public function lor()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','student_id')->where('type','lor');
    }
    public function moi()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','student_id')->where('type','moi');
    }
    public function sop()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','student_id')->where('type','sop');
    }
    public function countryAddress()
    {
        return $this->belongsTo('App\Models\Loc\Country','country_id','id');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country','applingForCountry','id');
    }
    // public function nationality()
    // {
    //     return $this->belongsTo('App\Models\Loc\Country','nationality','id');
    // }
    public function agent()
    {
        return $this->belongsTo('App\Agent','agent_id','id');
    }
    public function grade10()
    {
        return $this->belongsTo('App\Models\StudentQualification','id','student_id')->where('qualificationName','1');
    }
    public function grade12()
    {
        return $this->belongsTo('App\Models\StudentQualification','id','student_id')->where('qualificationName','2');
    }
    public function degree()
    {
        return $this->belongsTo('App\Models\StudentQualification','id','student_id')->where('qualificationName','3');
    }
    public function qualificationLevel()
    {
        return $this->belongsTo('App\Models\Qualification','applingForLevel','id');
    }
    public function studentDocument()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','studentSenSecDocument');
    }
    public function GraduationDocument()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','studentBechularDocument');
    }
    // public function FinanceDocument()
    // {
    //     return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','studentBechularDocument');
    // }
    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification','qualification','id');
    }
    public function previousQualifications()
    {
        return $this->belongsTo('App\Models\PreviousQualification','previousQualification','id');
    }
    public function englishScores()
    {
        return $this->belongsTo('App\Models\EnglishScore','englishScore','id');
    }
    public function mathScores()
    {
        return $this->belongsTo('App\Models\MathScore','mathScore','id');
    }
    public function appliedStudentFiles()
    {
        return $this->hasMany('App\Models\Agent\AppliedStudentFile','student_id','id');
    }
    public function appliedStudentFilesByAdmin()
    {
        return $this->hasMany('App\Models\Agent\AppliedStudentFile','student_id','id')->where('file_status','>','1');
    }
    public function studentNotifications()
    {
        return $this->hasMany('App\Models\Notification','student_id','id')->where('type','admin')->where('application_status','chat');
    }
    public function pendeciesStudentFiles()
    {
        return $this->hasMany('App\Models\PendancyAttachment','student_id','id')->where('status',0);
    }

    public static function uploadDocuments($file,$type,$id=NULL)
    {
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        if($id != NULL){
            $destinationPath = 'uploads/'.$type.'/'.$id;
        }else{
            $destinationPath = 'uploads/'.$type.'/';
        }
         $file->move($destinationPath, $fileName);
            
       $attachment = Attachment::create([
            'name' => $fileName,
            'path' => $destinationPath,
            'type' => $type,
            'attachment_id' => $id
            ]);
        $attachment->save();    
    
    }
}
