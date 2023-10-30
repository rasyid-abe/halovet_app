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
use App\LowonganKerja as lk;
use App\Ads as ads;

class LowonganController extends Controller
{
    public function indexlowongan()
    {
        $ad = ads::where('adsid',5)->first();
    	$lki = lk::orderby('lokid','DESC')->paginate(6);
    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);

    	return view('lokerlist')->with(compact('lki','randart','randoc','randpen','ad'));


    }

    public function detailowongan($lokslug)
    {
        
$ad = ads::where('adsid',5)->first();
    	$lkshow = lk::where('lokslug',$lokslug)->first();
    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);

    	return view('lokershow')->with(compact('lkshow','randart','randoc','randpen','ad'));
    }

    //admin

    public function adminindexlowongan()
    {
    	if(Auth::user()->role == 3)
    	{
    	$lkmin = lk::orderby('lokid','DESC')->paginate(15);

    	return view('adminx.loker.index')->with(compact('lkmin'));
    }
    else
    {
    	return redirect('dashboard');
    }

    }

    public function adminnewlowongan()
    {
    	if(Auth::user()->role == 3)
    	{
    	
return view('adminx.loker.new');
    }
    else
    {
    	return redirect('dashboard');
    }


    }

    public function adminsavelowongan(Request $request)
    {
    	if(Auth::user()->role == 3)
    	{
$lknew = new lk;
    	$lknew->lokjudul = $request->lokjudul;
    	$lknew->lokperus = $request->lokperus;
    	$lknew->lokisi = $request->lokisi;
    	$lknew->lokkontak = $request->lokkontak;
    	$rand = substr(md5(microtime()),rand(0,26),5);
    	$lknew->lokslug = Str::slug(substr($lknew->lokjudul,0,20)).'-'.$rand;
    	$lknew->lokerdate = date('Y-m-d');


	if($request->file('lokphoto') == "")
        {
            $lknew->lokimg = 'img/default-thumb-loker.jpg';
        } 
        else
        {
            $file       = $request->file('lokphoto');
            $fileArray = array('image' => $file);
            $rules = array(
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000000' // max 10000kb
    );
             $validator = Validator::make($fileArray, $rules);
              if ($validator->fails())
    		{
          // Redirect or return json to frontend with a helpful message to inform the user 
          // that the provided file was not an adequate type
        $err = "<strong>File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload</strong>";

        $msg = notify()->flash('Oh No ! File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload', 'warning');

          return redirect()->back()->with('msg',$msg);
    		} 
  		  else
   			{
        // Store the File Now
        // read image from temporary file
         $fileName   = time() . '.' .$file->getClientOriginalName();
            Image::make($file)->save(public_path('image/' . $fileName ) );
            $lknew->lokimg = "image/".$fileName;
   		 	}            
	
   			 }

   			 try {
        $lknew->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! lowongan tersebut gagal diterbitkan', 'alert');
     return $e;    		}

        
       $msg = notify()->flash('Berhasil! lowongan sudah diterbitkan!', 'success');
     return redirect('adminix/loker')->with('msg', $msg);
    	}
  		else
  		{
  			return redirect('dashboard');
  		}  	

    	
    }

    public function admineditlowongan($lokid)
    {
    	if(Auth::user()->role == 3)
    	{
$lkedit = lk::where('lokid',$lokid)->first();

    	return view('adminx.loker.edit')->with(compact('lkedit'));

    	}
  		else
  		{
  			return redirect('dashboard');
  		}  	
    }

    public function admineditedlowongan(Request $request)
    {

    	if(Auth::user()->role == 3)
    	{


    	$lkup = lk::where('lokid',$request->lokid)->first();
    	$lkup->lokjudul = $request->lokjudul;
    	$lkup->lokperus = $request->lokperus;
    	$lkup->lokisi = $request->lokisi;
    	$lkup->lokkontak = $request->lokkontak;
    	$rand = substr(md5(microtime()),rand(0,26),5);
    	$lkup->lokslug = Str::slug(substr($lkup->lokjudul,0,20)).'-'.$rand;

    	if($request->file('lokphoto') == "")
        {
            $lkup->lokimg = $lkup->lokimg;
        } 
        else
        {
            $file       = $request->file('lokphoto');
            $fileArray = array('image' => $file);
            $rules = array(
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000000' // max 10000kb
    );
             $validator = Validator::make($fileArray, $rules);
              if ($validator->fails())
    		{
          // Redirect or return json to frontend with a helpful message to inform the user 
          // that the provided file was not an adequate type
        $err = "<strong>File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload</strong>";

        $msg = notify()->flash('Oh No ! File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload', 'warning');

          return redirect()->back()->with('msg',$msg);
    		} 
  		  else
   			{
        // Store the File Now
        // read image from temporary file
         $fileName   = time() . '.' .$file->getClientOriginalName();
            Image::make($file)->save(public_path('image/' . $fileName ) );
            $lkup->lokimg = "image/".$fileName;
   		 	}            
	
   			 }

   			 try {
        $lkup->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! lowongan tersebut gagal diubah', 'alert');
     return redirect('adminix/loker')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! lowongan sudah diubah!', 'success');
     return redirect('adminix/loker')->with('msg', $msg);


}

    	else
    	{
    		return redirect('dashboard');
    	}


    }

    public function admindeletelowongan($lokid)
    {

    	if(Auth::user()->role == 3)
    	{
$lkdel = lk::where('lokid',$lokid)->first();

    	 try {
        $lkdel->delete();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! lowongan tersebut gagal dihapus', 'alert');
     return redirect('adminix/loker')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! lowongan sudah dihapus!', 'success');
     return redirect('adminix/loker')->with('msg', $msg);
    	}

    	else
    	{
    		return redirect('dashboard');
    	}
    	

    }
public function admindetaillowongan($lokid)
{
		if(Auth::user()->role == 3)
    	{
$lkdet = lk::where('lokid',$lokid)->first();

    	return view('adminx.loker.detail')->with(compact('lkdet'));
    	}

    	else
    	{
    		return redirect('dashboard');
    	}
}

}
