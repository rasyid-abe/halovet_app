<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Kecamatan;
use Illuminate\Support\Facades\DB;

class DaerahController extends Controller
{
    public function province(){
        $province = DB::table('province')->get();

        return response()->json($province);
        
    }
    
    public function city(Request $request){
        $id = $request->input('id');
        
        $city = DB::table('city')->where('id_province', $id)->get();

        return response()->json($city);
        
    }
    
    public function kecamatan(Request $request){
        $id = $request->input('id');
        $kecamatan = DB::table('kecamatan')->where('id_city', $id)->get();

        return response()->json($kecamatan);
        
    }
}
