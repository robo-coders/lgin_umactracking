<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer_list extends Model
{
    protected $table = 'manufacturer_lists';
    protected $fillable = [
        'name',
    ];
}
