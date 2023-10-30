<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
     protected $table = 'articlecategory';
    protected $primaryKey = 'catid';
    protected $fillable = ['catname', 'catslug','created_at','updated_at'];

}
