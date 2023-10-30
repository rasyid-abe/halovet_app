<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    protected $fillable = [
        'id', 'kecname', 'id_city',
    ];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}
