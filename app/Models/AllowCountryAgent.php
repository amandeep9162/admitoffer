<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllowCountryAgent extends Model
{
     use SoftDeletes;
    protected $table = 'allow_country_agents';
    protected $fillable = [
        'agent_id','country_id'
    ];
}
