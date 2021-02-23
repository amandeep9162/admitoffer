<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    protected $table = 'notifications';
    protected $fillable = [
        'type','user','link','agent_id','from','to','admin_role','student_id','application_id','message','application_status','status'
    ];
}
