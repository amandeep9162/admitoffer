<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','country_id','preProcessBy',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country','country_id','id');
    }

    public function college()
    {
        return $this->belongsTo('App\Models\College','id','university_id');
    }
    public function preProcess()
    {
        return $this->belongsTo('Bitfumes\Multiauth\Model\Admin','preProcessBy','id');
    }
}
