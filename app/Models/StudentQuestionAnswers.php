<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentQuestionAnswers extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'question','answer','detail','student_id'
    ];

    public function questions()
    {
        return $this->belongsTo('App\Models\CountryQuestion','question','id');
    }
}
