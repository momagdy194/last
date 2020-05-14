<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class state extends Model
{
    protected $table = 'states';

    protected $primaryKey = 'id';


    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
