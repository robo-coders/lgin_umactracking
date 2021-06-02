<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
    protected $table = 'histories';

    public function ticket(){
        return $this->belongsTo(ticket::class);
    }
}
