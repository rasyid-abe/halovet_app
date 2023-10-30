<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'province';

    protected $fillable = [
        'id', 'provname',
    ];

    public function city()
    {
        return $this->hasMany('App\City');
    }
}
