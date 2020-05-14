<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function tickits()
    {
        return $this->hasMany(Ticket::class);
    }
}
