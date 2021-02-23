<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;
    protected $table = 'chat';
    protected $fillable = [
        'application_id','message','type','admin_id','from','to','admin_role','agent_id','student_id'
    ];
}
