<?php

namespace App\Models\Loc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use SoftDeletes;
    public $table ="loc_cities";
    protected $fillable = [
        'name', 'state_id','country_id',
    ];

    public function state()
    {
        return $this->belongsTo('App\Models\Loc\State','state_id','id');
    }
    //
}
