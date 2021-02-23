<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamProcessor extends Model
{
    protected $fillable = [
        'application_id','preprocess_id','process_id','student_id',
    ];

    public function admins()
    {
        return $this->belongsTo('Bitfumes\Multiauth\Model\Admin','process_id','id');
    }
}
