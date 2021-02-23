<?php

namespace App\Models\Loc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    public $table = "loc_states";
    protected $fillable = [
        'name', 'country_id',
    ];

    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country','country_id','id');
    }
}
