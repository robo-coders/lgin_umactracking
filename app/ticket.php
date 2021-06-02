<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ticket extends Model
{
    protected $table = 'tickets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'machine_description','cost_center_line','supervisor_name','description_of_problem',
        'priority_level','status','technician_id','request_id',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function requestor()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function technician()
    {
        return $this->belongsTo(User::class, "technician_id");
    }
    public function ticketHistory(){
        return $this->hasMany('App\history','ticket_id');

    }
    public function ticketreview(){
        return $this->hasMany('App\review','ticket_id');

    }
}
