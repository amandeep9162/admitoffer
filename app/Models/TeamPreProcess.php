<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamPreProcess extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'preProcess_id','process_id',
    ];

    public function admins()
    {
        return $this->belongsTo('Bitfumes\Multiauth\Model\Admin','process_id','id');
    }
}
