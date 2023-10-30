<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peliharaan extends Model
{
    protected $table = 'peliharaan';
    protected $primaryKey = 'petid';
    protected $fillable = ['petname', 'pettype','petcolor','petciri','petsex','petvaksin','petphoto','petcode','petowner','updated_at','created_at'];
}
