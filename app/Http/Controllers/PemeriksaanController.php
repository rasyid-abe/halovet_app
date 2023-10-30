<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as u;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use App\Article as a;
use App\Kategori as c;
use Illuminate\Support\Str;
use App\Penyakit as p;
use App\KonsulCat as kc;
use App\Konsultasi as k;
use App\Slider as s;
use App\peliharaan as pel;
use App\Pemeriksaan as per;
use App\Ads as ads;

use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class PemeriksaanController extends Controller
{
    public function daspemeriksaan(Request $request)
    {
        $ad = ads::where('adsid',5)->first();
    		if(Auth::user()->role == 2)
    		{
    			$keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $per = per::where('percode', 'LIKE', "%$keyword%")
                ->orWhere('peranamnesa', 'LIKE', "%$keyword%")
                ->orWhere('perumum', 'LIKE', "%$keyword%")
                ->orWhere('perkhusus', 'LIKE', "%$keyword%")
                ->orWhere('pengobatan', 'LIKE', "%$keyword%")
                ->orWhere('perpetid', 'LIKE', "%$keyword%")->where('perdokid',Auth::id())
                ->paginate($perPage);
        } else {
            $per = per::where('perdokid',Auth::id())->orderby('pertanggal','DESC')->paginate($perPage);
        }
$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);

        return view('user.pemeriksaan.index')->with(compact('per','randart','randoc','randpen','ad'));
    		}

    		else
    		{
    			return redirect('dashboard');
    		}
    }

    public function newpemeriksaan()
    {
        $ad = ads::where('adsid',5)->first();
$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);
    		if(Auth::user()->role == 2)
    		{
        return view('user.pemeriksaan.new')->with(compact('randart','randoc','randpen','ad'));
    		}

    		else
    		{
    			return redirect('dashboard');
    		}

    }

    public function savepemeriksaan(Request $request)
    {
    	$sper = new per;
    	$sper->perdokid = Auth::id();
    	$sper->pertanggal = date('Y-m-d');
    	$sper->perpetid = $request->petid;
    	$rand = substr(md5(microtime()),rand(0,26),2);
    	$tgl = date('Ymd');
    	$sper->percode = "P-".$rand.$sper->perdokid.$sper->perpetid;
    	$sper->peranamnesa = $request->peranamnesa;
    	$sper->perumum = $request->perumum;
    	$sper->perkhusus = $request->perkhusus;
    	$sper->pengobatan = $request->pengobatan;

    	if(Auth::user()->role == 2)
    	{
    		 try {
        $sper->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! pemeriksaan tersebut gagal ditambahkan', 'alert');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! pemeriksaan ditambahkan!', 'success');
     return redirect('dashboard/pemeriksaan')->with('msg', $msg);


    	}

    	else
    	{
    		return redirect('dashboard');
    	}
    	
    }
    public function editpemeriksaan($percode)
    {
    	$eper = per::where('percode',$percode)->first();
$ad = ads::where('adsid',5)->first();
    	if(Auth::user()->role == 2)
    	{
    		if (Auth::id() == $eper->perdokid) {

    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);

    	return view('user.pemeriksaan.edit')->with(compact('eper','randart','randoc','randpen','ad'));
    			
    		}

    		else
    		{
    			return redirect('dashboard/pemeriksaan');
    		}
    	}

    	else
    	{
    		return redirect('dashboard');
    	}

    }

    public function editedpemeriksaan(Request $request)
    {
    	$dper = per::where('percode',$request->percode)->first();

    	if(Auth::user()->role == 2)
    	{
    		if (Auth::id() == $dper->perdokid) {

    	$dper->perpetid = $request->petid;
    	$dper->peranamnesa = $request->peranamnesa;
    	$dper->perumum = $request->perumum;
    	$dper->perkhusus = $request->perkhusus;
    	$dper->pengobatan = $request->pengobatan;

    		 try {
        $dper->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! pemeriksaan tersebut gagal diubah', 'alert');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! pemeriksaan berhasil diubah!', 'success');
     return redirect('dashboard/pemeriksaan')->with('msg', $msg);

    			
    		}

    		else
    		{
    			return redirect('dashboard/pemeriksaan');
    		}
    	}

    	else
    	{
    		return redirect('dashboard');
    	}
    }

    public function detailpemeriksaan($percode)
    {
$ad = ads::where('adsid',5)->first();
    	$dp = per::where('percode',$percode)->first();

    	if(Auth::user()->role == 2)
    	{
    		if (Auth::id() == $dp->perdokid) 
    		{
    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);
    			return view('user.pemeriksaan.detail')->with(compact('dp','randart','randpen','randoc','ad'));
    			
    		}

    		else
    		{
    			return redirect('dashboard/pemeriksaan');
    		}
    	}

    	else
    	{
    		return redirect('dashboard');
    	}


    }

    public function deletepemeriksaan($percode)
    {

    	$delp = per::where('percode',$percode)->first();

    	if(Auth::user()->role == 2)
    	{
    		if (Auth::id() == $delp->perdokid) 
    		{
    		
    		 try {
        $delp->delete();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! pemeriksaan tersebut gagal dihapus', 'alert');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! pemeriksaan berhasil dihapus!', 'success');
     return redirect('dashboard/pemeriksaan')->with('msg', $msg);

    		}

    		else
    		{
    			return redirect('dashboard/pemeriksaan');
    		}
    	}

    	else
    	{
    		return redirect('dashboard');
    	}


    }



// ADMIN



    public function adminindexs()
    {
	    	 if(Auth::user()->role == 3)
			{

    	$pemeriksaan = per::join('users','pemeriksaan.perdokid','=','users.id')->select('users.name','users.id','pemeriksaan.*')->orderby('pertanggal','DESC')->paginate(15);


    	return view('adminx.pemeriksaan.index')->with(compact('pemeriksaan'));
			}
			else
			{
			  return redirect('dashboard');
    		}

    }

    public function detailper($percode)
    {
    		 if(Auth::user()->role == 3)
			{

    	$detper = per::join('peliharaan','pemeriksaan.perpetid','=','peliharaan.petcode')->join('users','pemeriksaan.perdokid','=','users.id')->select('peliharaan.petid','users.name','users.id','pemeriksaan.*')->where('percode',$percode)->first();


    	return view('adminx.pemeriksaan.show')->with(compact('detper'));
			}
			else
			{
			  return redirect('dashboard');
    		}


    }

    public function adminedit($percode)
    {
 if(Auth::user()->role == 3)
			{


    	$edper = per::where('pemeriksaan.percode',$percode)->first();


    	return view('adminx.pemeriksaan.edit')->with(compact('edper'));
			}
			else
			{
			  return redirect('dashboard');
    		}
    }

    public function adminedited(Request $request)
    {

    	$ediper = per::where('percode',$request->percode)->first();

		$ediper->perpetid = $request->petid;
    	$ediper->peranamnesa = $request->peranamnesa;
    	$ediper->perumum = $request->perumum;
    	$ediper->perkhusus = $request->perkhusus;
    	$ediper->pengobatan = $request->pengobatan;

    		 try {
        $ediper->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! pemeriksaan tersebut gagal diubah', 'alert');
     return $e;
    		}

 $msg = notify()->flash('Berhasil! pemeriksaan berhasil diubah!', 'success');
    		return redirect('adminix/pemeriksaan')->with(compact('msg'));
    }


   public function deleteper($percode)
   {

   		$delp = per::where('percode',$percode)->first();

    	 if(Auth::user()->role == 3)
			{
    		 try {
        $delp->delete();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! pemeriksaan tersebut gagal dihapus', 'alert');
     return $e;
    		}

    		$msg = notify()->flash('Berhasil! pemeriksaan berhasil dihapus!', 'success');
    		return redirect('adminix/pemeriksaan')->with(compact('msg'));
    	}
    	else
    	{
    		return redirect('dashboard');
    	}


   }


   public function apipet(){
	   $allpet = pel::get();
	   $fractal = new Manager;
	   $pets = $allpet->toArray();

	   $resource = new Collection($pets, function(array $pet) {
		return [
			'query' => 'Unit',
			'suggestions' => [
				'value' => $pet['petcode'].' '.$pet['petname'],
				'data' => $pet['petcode'],
			]
		];
	});

	return $fractal->createData($resource)->toJson();
   }
}
