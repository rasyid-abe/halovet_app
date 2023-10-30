<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = [
        'id_dokter', 'latitude', 'longtitude',
        'id_province', 'id_city', 'id_kecamatan', 'alamat',
    ];
}
