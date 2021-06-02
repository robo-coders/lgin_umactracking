<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_detail extends Model
{
    protected $table = 'category_details';
    
    protected $fillable = [
        'category'
    ];
}
