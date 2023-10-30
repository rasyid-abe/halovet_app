<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
       protected $table = 'article';
    protected $primaryKey = 'artid';
    protected $fillable = ['artjudul', 'artslug','artisi','artwriter','artcat','artdate','artthumb','created_at','updated_at'];
}
