<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KonsulCat as kc;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use App\Article as a;
use App\Kategori as c;
use Illuminate\Support\Str;

class KonsulCatController extends Controller
{
    public function indexadmin()
    {
         if(Auth::user()->role == 3)
{
    	$ikoncat = kc::paginate(20);

    	return view('adminx.koncat.index')->with(compact('ikoncat'));
}
else
{
  return redirect('dashboard');
}
    }

    public function newcat()
    {
        if(Auth::user()->role == 3)
{
    	return view('adminx.koncat.new');
}
else
{
  return redirect('dashboard');
}
    }

    public function savecat(Request $request)
    {
    	$sc = new kc;
    	$sc->koncatjudul = $request->koncatjudul;
    	$sc->koncatslug = Str::slug($request->koncatjudul);
    	 try {
        $sc->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diterbitkan', 'alert');
     return $e;
    		}

 $msg = notify()->flash('Berhasil ! kategori berhasil dibuat', 'success');
    		return redirect('adminix/konsultasi/category')->with(compact('msg'));

    }

    public function editcat($id)
    {
        if(Auth::user()->role == 3)
{
    	$ec = kc::where('koncatid',$id)->first();

    	return view('adminx.koncat.edit')->with(compact('ec'));
}
else
{
  return redirect('dashboard');
}
    }

    public function updatecat(Request $request)
    {
    	$uc = kc::where('koncatid',$request->koncatid)->first();
    	$uc->koncatjudul = $request->koncatjudul;
    	$uc->koncatslug = Str::slug($request->koncatjudul);

    	try {
        $uc->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diterbitkan', 'alert');
     return redirect('adminix/konsultasi/category')->with(compact('msg'));
    		}

 $msg = notify()->flash('Berhasil ! kategori berhasil diubah', 'success');
    		return redirect('adminix/konsultasi/category')->with(compact('msg'));

    }

    public function deletekoncat($id)
    {
        if(Auth::user()->role == 3)
{
    	$dc = kc::where('koncatid',$id)->first();

try {
        $dc->delete();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diterbitkan', 'alert');
     return redirect('adminix/konsultasi/category')->with(compact('msg'));
    		}

    		$msg = notify()->flash('Berhasil ! kategori berhasil diubah', 'success');
    		return redirect('adminix/konsultasi/category')->with(compact('msg'));
 }
else
{
  return redirect('dashboard');
}
    }

    public function indexpub()
    {
    	$ip = kc::paginate(20);
    	return view('indexkoncat')->with(compact('ip'));
    }
}
