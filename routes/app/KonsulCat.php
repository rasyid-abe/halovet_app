<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KonsulCat extends Model
{
      protected $table = 'konsulcat';
    protected $primaryKey = 'koncatid';
    protected $fillable = ['koncatjudul', 'koncatlug','koncatisi','created_at','updated_at'];
}

