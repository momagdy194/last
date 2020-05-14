<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'id';


    // There is no fillable becuse i will not add to db

    public function cities()
    {
        return $this->hasMany(City::class , 'country_id' , 'id');
    }

    public function states()
    {
        return $this->hasMany(state::class, 'country_id', 'id');
    }

}
