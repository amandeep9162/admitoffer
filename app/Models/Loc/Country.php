<?php

namespace App\Models\Loc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    public $table = "loc_countries";
    protected $fillable = [
        'name', 'shotcode','currency','nationality','image_name','path','currency_icon_name','currency_icon_path',
    ];
}
