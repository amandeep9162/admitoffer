<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEnglishTest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'testName','dateOfTest','reading','writing','speaking','listening','overAll','totalScore','student_id',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Agent\Student','student_id','id');
    } 
    public function totalScores()
    {
        return $this->belongsTo('App\Models\EnglishScore','totalScore','id');
    } 
    public function englishTests()
    {
        return $this->belongsTo('App\Models\EnglishTest','testName','id');
    } 
    public function documents()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','test');
    }
    public function englishTestDocuments()
    {
        return $this->belongsTo('App\Models\StudentAttachment','id','attachment_id')->where('type','test');
    } 
    
    
}
