<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    protected $table = 'sidebar';
    protected $primaryKey = 'konsid';
    protected $fillable = ['sideid', 'sidebarname','sideisi','sidelocation','created_at','updated_at'];
}
