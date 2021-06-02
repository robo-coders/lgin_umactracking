<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parts_detail extends Model
{
    protected $table = 'parts_details';

    protected $fillable = [
        'part_no', 'description', 'cost', 'currency'
    ];
}
