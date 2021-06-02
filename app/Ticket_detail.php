`<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket_detail extends Model
{
    protected $table = 'ticket_details';
    protected $fillable = [
        'ticket_id','ticket_brs_id',
    ];
}
`