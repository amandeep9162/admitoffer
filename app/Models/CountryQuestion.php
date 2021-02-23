<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountryQuestion extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'country_id','question_id'
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country','country_id','id');
    }
    public function question()
    {
        return $this->belongsTo('App\Models\Question','question_id','id');
    }
}
