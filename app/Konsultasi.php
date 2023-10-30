<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    protected $table = 'konsultasi';
    protected $primaryKey = 'konsid';
    protected $fillable = ['konsjudul', 'konsslug','konsisi','konswriter','konscat','konsdate','created_at','updated_at'];
}
