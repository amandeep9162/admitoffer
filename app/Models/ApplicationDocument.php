<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationDocument extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'application_id','student_id','application_status_id','college_id','college_student_id','status','name','path','type','comment',
    ];

    public function applicationFee()
    {
        return $this->belongsTo('App\Models\ApplicationFee','id','attachment_id');
    }
}
