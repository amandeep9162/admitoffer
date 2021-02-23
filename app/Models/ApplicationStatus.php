<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationStatus extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','country'
    ];

    public function countries()
    {
        return $this->belongsTo('App\Models\Loc\Country','country','id');
    } 
}
