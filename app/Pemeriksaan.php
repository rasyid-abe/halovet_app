<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $table = 'pemeriksaan';
    protected $primaryKey = 'perid';
    protected $fillable = ['percode', 'pertanggal','peranamnesa','perumum','perkhusus','pengobatan','perdokid','perpetid','updated_at','created_at'];
}
