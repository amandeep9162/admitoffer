<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationStatusTimeline extends Model
{
    use SoftDeletes;
    protected $table = 'application_status_timelines';
    protected $fillable = [
        'application_id','status_date','status_id'
    ];

    public function application()
    {
        return $this->belongsTo('App\Models\Agent\AppliedStudentFile','application_id','id');
    } 
    public function status()
    {
        return $this->belongsTo('App\Models\ApplicationStatus','status_id','id');
    } 
}
