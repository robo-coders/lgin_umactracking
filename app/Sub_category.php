<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
        'category_detail_id','sub_category',
    ];

}
