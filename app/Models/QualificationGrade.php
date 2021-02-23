<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualificationGrade extends Model
{
    protected $fillable = [
        'qualification_level','qualification_grade',
    ];

    public function qualification()
    {
        return $this->belongsTo('App\Models\Qualification','qualification_level','id');
    }
     
}
