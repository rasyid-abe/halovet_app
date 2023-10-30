<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
     protected $table = 'penyakit';
    protected $primaryKey = 'penid';
    protected $fillable = ['pennama', 'penslug','penisi','penwriter','penthumb','pendate','updated_at','created_at'];
}
