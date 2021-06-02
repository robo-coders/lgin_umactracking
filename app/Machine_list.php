<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine_list extends Model
{
    protected $table = 'machine_lists';
    protected $fillable = [
        'name',
    ];
}
