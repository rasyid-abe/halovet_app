<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';
    protected $primaryKey = 'adsid';
    protected $fillable = ['universalsidebar', 'universalfooter','usersidebar','afterarticle','created_at','updated_at'];
}
