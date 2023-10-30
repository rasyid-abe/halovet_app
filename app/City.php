<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
      protected $table = 'city';
    protected $primaryKey = 'kotid';
    protected $fillable = ['kotid', 'kotname', 'id_province' ,'updated_at','created_at'];

    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function kecamatan()
    {
        return $this->hasMany('App\Kecamatan');
    }

}
