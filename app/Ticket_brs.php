<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket_brs extends Model
{
    protected $table = 'ticket_brs';
    protected $fillable = [
        'brs','area','machine','manufacturer','room'
    ];
}
