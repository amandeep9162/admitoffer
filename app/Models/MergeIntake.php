<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MergeIntake extends Model
{
    use SoftDeletes;
    protected $table = 'merge_intakes';
    protected $fillable = [
        'name',
    ];
}
