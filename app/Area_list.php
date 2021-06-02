<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area_list extends Model
{
    protected $table = 'area_lists';
    protected $fillable = [
        'brs','area','room',
    ];
}
