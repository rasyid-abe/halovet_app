<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LowonganKerja extends Model
{
     protected $table = 'loker';
    protected $primaryKey = 'lokid';
    protected $fillable = ['lokjudul', 'lokisi','lokperus','lokontak','lokimg','lokslug','lokerdate','updated_at','created_at'];
}
