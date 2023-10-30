<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads as ads;
use App\Kecamatan;
use App\Province;
use App\Lokasi;
use App\City;
use App\User;
use Auth;

class MapsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $ad = ads::where('adsid',5)->first();
        return view('lokasi')->with(compact('ad'));        
    }

    public function ajaxResponses(Request $request){
        // $lokasi = $request->input('lokasi');           
        $lokasi = $request->input('lokasi');     
        $lokasi = urldecode($lokasi);        
        $datas = explode(' ', $lokasi);
        $regency = intval($request->regency);
        
        // var_dump($datas);        
        if($regency){
            $blacklist = ['Regency', 'regency', 'City', 'city'];

            if(in_array($datas[count($datas)-1], $blacklist)){
                if($datas[count($datas)-1] == 'Regency' || $datas[count($datas)-1] == 'regency'){
                    $lokasi = substr($lokasi, 0, strlen($lokasi)-8);
                } else {
                    $lokasi = substr($lokasi, 0, strlen($lokasi)-5);
                }                                
            }

            // if(count($datas) > 1){
            //     if($datas[count($datas)-1] == "Regency"){
            //         $lokasi = substr($lokasi, 0, strlen($lokasi)-8);
            //     }                                            
            // }

            $markers = Lokasi::join('users', 'lokasi.id_dokter', '=', 'users.id')
                ->join('city', 'lokasi.id_city', '=', 'city.kotid')
                ->select(
                    'lokasi.latitude', 'lokasi.longtitude', 
                    'users.name', 'users.id', 'users.profilepic'
                    )
                ->where('city.kotname', 'like', '%'.$lokasi.'%')
                ->get();
        } else {
            $markers = Lokasi::join('users', 'lokasi.id_dokter', '=', 'users.id')
                ->join('province', 'lokasi.id_province', '=', 'province.id')
                ->select(
                    'lokasi.latitude', 'lokasi.longtitude', 
                    'users.name', 'users.id', 'users.profilepic'
                    )
                ->where('province.provname', 'like', '%'.$lokasi.'%')
                ->get();
        }        

        // json_encode($result);
        
        return response()->json($markers);
    }

    public function tagLokasi(){
        $ad = ads::where('adsid',5)->first();
        if(Auth::user()->role == 2){
            if(Auth::user()->klinik == null){                
                $cekklinik = false;
                $alamat = null;
                $pinned = null;
            } else {
                $id = Auth::user()->id;
                $lokasi = Lokasi::where('id_dokter', $id)->first();
                if($lokasi){
                    $pinned = [
                        'lat' => $lokasi->latitude,
                        'long' => $lokasi->longtitude,
                    ];
                } else {
                    $pinned = null;
                }
                $alamat = Auth::user()->klinik;
                $cekklinik = true;
            }

            return view('taglokasi')->with(compact('cekklinik', 'alamat', 'pinned', 'ad'));
        } else {
            return redirect()->back();
        }        
    }

    public function saveLokasi(Request $request){        
        
        $id = Auth::user()->id;
        $lat = floatval($request->lat);
        $long = floatval($request->long);
        $id_provinsi = $request->provinsi;
        $id_kabupaten = $request->kabupaten;
        $id_kecamatan = $request->kecamatan;
        $alamat = $request->alamat;        
        $namaprov = $request->namaprov;
        $namakabu = $request->namakabu;
        $namakeca = $request->namakeca;

        if($id_provinsi == "none" || $id_kabupaten == "none" || $id_kecamatan == "none"){
            return redirect()->route('inputlokasi', array("message" => "Keterangan alamat belum diisi dengan lengkap"));
        }

        if($lat == 0 && $long == 0){
            return redirect()->route('inputlokasi', array("message" => "Keterangan alamat belum diisi dengan lengkap"));
            // return redirect()->back()->with("message", "Anda belum menandai lokasi praktik anda di peta");
        }

        $cekmarker = Lokasi::where('id_dokter', $id)->first();
        if($cekmarker){
            if($cekmarker->latitude == $lat && $cekmarker->longtitude == $long  && $alamat != $cekmarker->alamat){
                return redirect()->route('inputlokasi', array("message" => "Keterangan alamat belum diisi dengan lengkap"));
                // return redirect()->back()->with("message", "Anda belum merubah lokasi praktik anda di peta");
            }
        }

        if(!(Province::where('id', $id_provinsi)->first())){
            $input = new Province;
            $input->id = $id_provinsi;
            $input->provname = $namaprov;
            $input->save();            
        }

        $input = null;

        if(!(City::where('kotid', $id_kabupaten)->first())){
            $input = new City;
            $input->kotid = $id_kabupaten;
            $input->kotname = $namakabu;
            $input->id_province = $id_provinsi;
            $input->save();    
        }

        $input = null;

        if(!(Kecamatan::where('id', $id_kecamatan)->first())){
            $input = new Kecamatan;
            $input->id = $id_kecamatan;
            $input->kecname = $namakeca;
            $input->id_city = $id_kabupaten;
            $input->save();            
        }        

        $input = null;
        $idlokasi = Lokasi::where('id_dokter', $id)->first();

        if($idlokasi){            
            $input = Lokasi::find($idlokasi->id);

            $cekklinik = Auth::user()->klinik;
            
            if($cekklinik != $alamat){
                
                $input->alamat = $alamat;
                
                //Renew alamat klinik on User db
                $inputplus = User::find($id);
                $inputplus->klinik = $alamat;
                $inputplus->save();
            }
        } else {
            $cekklinik = Auth::user()->klinik;
            $input = new Lokasi;
            
            //Renew alamat klinik on User db
            $inputplus = User::find($id);
            $inputplus->klinik = $alamat;
            $inputplus->save();

            $input->alamat = $alamat;                        
        }
        
        $input->id_dokter = $id;
        $input->latitude = $lat;
        $input->longtitude = $long;
        $input->id_province = $id_provinsi;
        $input->id_city = $id_kabupaten;
        $input->id_kecamatan = $id_kecamatan;                

        $input->save();

        return redirect()->route('dashboard');
    }
    
}
