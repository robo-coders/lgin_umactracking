<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $table = 'reviews';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','ticket_id','technician_id','part_id','solution','prevention','explanation','comments',
        'date','material',
    ];

    public function reviewTicket()
    {
        return $this->belongsTo(ticket::class,'ticket_id');
    }
}
