<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
      protected $table = 'slider';
    protected $primaryKey = 'slidid';
    protected $fillable = ['slidjudul', 'sliddesc','slidimg','slidgbg','updated_at','created_at'];
}
