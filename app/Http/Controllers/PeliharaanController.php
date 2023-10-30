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
 
class PeliharaanController extends Controller
{
    public function peliharaanindex()
    {

    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);
    $ad = ads::where('adsid',5)->first();

    	$mypet = pel::where('petowner',Auth::id())->orderby('petid','ASC')->paginate(10);
    	return view('user.peliharaan.index')->with(compact('mypet','randoc','randpen','randart','ad'));

    }

    public function petdetail($petcode)
    {
    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);
    	$ad = ads::where('adsid',5)->first();

      $detailpet = pel::where('petcode',$petcode)->first();
      $per = per::where('perpetid',$detailpet->petcode)->orderby('pertanggal','DESC')->paginate(10);
    	if(Auth::id() == $detailpet->petowner OR Auth::user()->role == 2)
    	{

    		return view('user.peliharaan.detail')->with(compact('detailpet','randoc','randpen','randart','ad','per'));
    	}

    	else
    	{
    		return redirect('dashboard');
    	}
    }

    public function newpel ()
    {
    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);
        $ad = ads::where('adsid',5)->first();
    	return view('user.peliharaan.newpeliharaan')->with(compact('timeline','randoc','randpen','randart','ad'));

    }

    public function insertpel(Request $request)
    {
    	$np = new pel;
    	$np->petname = $request->petname;
    	$np->pettype = $request->pettype;
    	$np->petcolor = $request->petcolor;
      $np->petciri = $request->petciri;
      $np->petdetail = $request->petdetail;
    	$np->petbreed = $request->petbreed;
      $np->petage = date("Y-m-d", strtotime($request->petage));
    	$np->petweight = $request->petweight;
    	$np->petsex = $request->petsex;
    	$np->petvaksin = $request->petvaksin;
    	$np->petowner = Auth::id();
    	$rand = substr(md5(microtime()),rand(0,26),2);
    	$np->petcode = Str::slug($request->pettype.$rand.$np->petowner);

    	if($request->file('petphoto') == "")
        {
            $np->petphoto = 'img/default-thumb-cat.jpg';
        } 
        else
        {
            $file       = $request->file('petphoto');
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
            Image::make($file)->resize(150, 150)->save(public_path('image/' . $fileName ) );
            $np->petphoto = "image/".$fileName;
   		 	}            
	
    }

       try {
        $np->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! peliharaan tersebut gagal ditambahkan', 'alert');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! hewan peliharaan ditambahkan!', 'success');
     return redirect('dashboard/peliharaan')->with('msg', $msg);


    }

    public function editpel($petcode)
    {
    	$ep = pel::where('petcode',$petcode)->first();
    $ad = ads::where('adsid',5)->first();
    	if($ep->petowner == Auth::id())
    	{
    	return view('user.peliharaan.editpeliharaan')->with(compact('ep','randoc','randpen','randart','ad'));
		}
		else
		{
			return redirect('dashboard');
		}
    }

    public function editedpel(Request $request)
    {
    	$edp = pel::where('petcode',$request->petcode)->first();
    	$edp->petname = $request->petname;
    	$edp->pettype = $request->pettype;
    	$edp->petcolor = $request->petcolor;
    	$edp->petciri = $request->petciri;
    	$edp->petsex = $request->petsex;
    	$edp->petvaksin = $request->petvaksin;
    	$edp->petowner = Auth::id();
    	$rand = substr(md5(microtime()),rand(0,26),2);

    	if($request->file('petphoto') == "")
        {
            $edp->petphoto = $edp->petphoto;
        } 
        else
        {
            $file       = $request->file('petphoto');
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
            Image::make($file)->resize(150, 150)->save(public_path('image/' . $fileName ) );
            $edp->petphoto = "image/".$fileName;
   		 	}            
	
    }

       try {
        $edp->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! hewan peliharaan gagal diubah', 'alert');
     return redirect('dashboard/peliharaan')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! hewan peliharaan sudah diubah', 'success');
     return redirect('dashboard/peliharaan')->with('msg', $msg);


    }

    public function deletepel($petcode)
    {

$dp = pel::where('petcode',$petcode)->first();
if(Auth::id() == $dp->petowner)
{
    	try
    	{
    		$dp->delete();

    	}

    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat menghapus', 'alert');

    return $e;

 }

 $msg = notify()->flash('Hewan peliharaan berhasil dihapus', 'success');

 	return redirect('dashboard/peliharaan')->with(compact('msg'));
}
else
{
  return redirect('dashboard');
}


    }

    // ADMIN AREA

    public function adminindex()
    {
    	 if(Auth::user()->role == 3)
{

    	$peliharaan = pel::join('users','peliharaan.petowner','=','users.id')->select('users.name','users.id','peliharaan.*')->orderby('petid','DESC')->paginate(15);


    	return view('adminx.peliharaan.index')->with(compact('peliharaan'));
}
else
{
  return redirect('dashboard');
    }
}

public function edithewan($petid)
{
	 if(Auth::user()->role == 3)
{
    	$aep = pel::where('petid',$petid)->first();
		return view('adminx.peliharaan.edit')->with(compact('aep'));
		
}
else
	{
  return redirect('dashboard');
    }
}

public function editedhewan(Request $request)
{
	 if(Auth::user()->role == 3)
{
    		$edp = pel::where('petid',$request->petid)->first();
    		$edp->petname = $request->petname;
    	$edp->pettype = $request->pettype;
    	$edp->petcolor = $request->petcolor;
      $edp->petciri = $request->petciri;
      $edp->petdetail = $request->petdetail;
    	$edp->petbreed = $request->petbreed;
      $edp->petage = date("Y-m-d", strtotime($request->petage));
    	$edp->petweight = $request->petweight;
    	$edp->petsex = $request->petsex;
    	$edp->petvaksin = $request->petvaksin;
    	$edp->petowner = Auth::id();
    	$rand = substr(md5(microtime()),rand(0,26),2);

    	if($request->file('petphoto') == "")
        {
            $edp->petphoto = $edp->petphoto;
        } 
        else
        {
            $file       = $request->file('petphoto');
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
            Image::make($file)->resize(150, 150)->save(public_path('image/' . $fileName ) );
            $edp->petphoto = "image/".$fileName;
   		 	}            
	
    }

       try {
        $edp->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! peliharaan tersebut gagal diubah', 'alert');
     return redirect('adminix/peliharaaan')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! peliharan berhasil diubah', 'success');
     return redirect('adminix/peliharaan')->with('msg', $msg);
}
else
	{
  return redirect('dashboard');
    }
}



public function deletehewan($petid)
{
$adp = pel::where('petid',$petid)->first();
if(Auth::user()->role == 3)
{
    	try
    	{
    		$adp->delete();

    	}

    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat menghapus', 'alert');

    return $e;

 }

 $msg = notify()->flash('Hewan peliharaan berhasil dihapus', 'success');

 	return redirect('adminix/peliharaan')->with(compact('msg'));
}
else
{
  return redirect('dashboard');
}
}


public function detailhewan($id)
{
		$depel = pel::join('users','peliharaan.petowner','=','users.id')->select('users.name','users.id','peliharaan.*')->where('petid',$id)->first();
    $riwhew = per::where('perpetid',$depel->petcode)->paginate(15);

		return view('adminx.peliharaan.show')->with(compact('depel','riwhew'));
}


}