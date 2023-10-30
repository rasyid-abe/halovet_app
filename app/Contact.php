<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
              protected $table = 'contact';
    protected $primaryKey = 'contid';
    protected $fillable = ['contjudul', 'contisi','contname','contemail','contdate','updated_at','created_at'];
}
