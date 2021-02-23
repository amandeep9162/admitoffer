<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskManager extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'account_manager_id','agent_id','activity','details','next_followup',
    ];


    public function agent()
    {
        return $this->belongsTo('App\Agent','agent_id','id');
    }

}
