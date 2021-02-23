<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplicationFee extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'student_id', 'attachment_id', 'application_id', 'tution_fee', 'total_comission', 'agent_comission'
    ];
}
