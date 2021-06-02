<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    protected $table = 'prefixs';

    protected $fillable = [
        'user_id','prefix',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
