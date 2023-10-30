<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $primaryKey = 'jawid';
    protected $fillable = ['jawisi', 'jawthread','jawwriter','jawdate','created_at','updated_at'];
}
