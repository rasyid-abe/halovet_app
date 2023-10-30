<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
      protected $table = 'city';
    protected $primaryKey = 'kotid';
    protected $fillable = ['kotname','updated_at','created_at'];
}
