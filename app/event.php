<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\Custom_event;
class event extends Model
{
    protected $table = 'events';

    public function ticket()
    {
        return $this->belongsTo(ticket::class, "ticket_id");
    }
    public function requestor()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function technician()
    {
        return $this->belongsTo(User::class, "technician_id");
    }
    public function customEvent()
    {
        return $this->hasMany('App\Custom_event','ticket_id');
    }

}
