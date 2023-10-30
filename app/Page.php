<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
          protected $table = 'page';
    protected $primaryKey = 'pageid';
    protected $fillable = ['pagejudul', 'pagedesc','pageimg','pageslug','updated_at','created_at'];
}
