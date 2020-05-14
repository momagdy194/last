<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id','order_id',
        'tickit_type_id','title',
        'message','status',
    ];


    public function customer()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function tickitType()
    {
        return $this->belongsTo(TicketType::class);
    }
}
