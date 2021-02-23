<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAttachment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','path','type','status','student_id','comment','attachment_id','attachment_name'
    ];
}
