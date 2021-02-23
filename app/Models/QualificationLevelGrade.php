<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualificationLevelGrade extends Model
{
    protected $table = 'qualificatio_level_grades';
    protected $fillable = [
        'qualification_level','qualification_grade',
    ];

    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification','qualification_level','id');
    }
    public function qualificationGrade()
    {
        return $this->belongsTo('App\Models\QualificationGrade','qualification_grade','id');
    }
     
}
