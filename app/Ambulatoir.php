<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambulatoir extends Model
{
  
  
    protected $table = 'ambulatoir';
    protected $primaryKey = 'perid';
    protected $fillable = ['perpetid', 'perberatbadan','perkedumum','perfreknafas','perfrekpulsus','perturgor','perkedmata','perkedmata','perkedmata','permata',
    'perkedmukosa',
    'permukosa',
    'percrt',
    'perfotoperiksa',
    'perpencernaan',
    'perpernafasan',
    'persirkulasi',
    'pergenitalia',
    'perurinaria',
    'persaraf',
    'peranggotagerak',
    'perkulitrambut',
    'perusg',
    'perfotousg',
    'perrontgent',
    'perfotorontgent',
    'perbloodcount',
    'perfotobloodcount',
    'perbloodsmear',
    'perfotobloodsemar',
    'perurinanalysis',
    'perfotourinanalysis',
    'perfeses',
    'perfotofeses',
    'perfungsiorgan',
    'perfotofungsiorgan',
    'perpatologi',
    'perfotopatologi',
    'perdiagnosa',
    'perterapi',
    'perdokid',
    'pertanggal',
    'perstatus',
    'created_at','updated_at'];
}  