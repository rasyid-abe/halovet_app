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
use App\Ads as ads;
class PenyakitController extends Controller
{
    //// ADMIN SIDE
    public function admindex()
    {
      if(Auth::user()->role == 3)
{
  
    	$penyakit = p::paginate(15);

    	return view('adminx.penyakit.index')->with(compact('penyakit'));
      }
else
{
  return redirect('dashboard');
}
    }

    public function viewpenyakit($id)
    {
      if(Auth::user()->role == 3)
{
  
    	$vp = p::where('penid',$id)->first();
    	return view('adminx.penyakit.show')->with(compact('vp'));
      }
else
{
  return redirect('dashboard');
}

    }

    public function newpenyakit()
    {
      if(Auth::user()->role == 3)
{
  
    	return view('adminx.penyakit.new');
      }
else
{
  return redirect('dashboard');
}
    }

    public function storepenyakit(Request $request)
    {
    	$sp = new p;
    	$sp->pennama = $request->pennama;
    	$rand = substr(md5(microtime()),rand(0,26),5);
    	$limititle = substr($request['pennama'],0,50).'-'.$rand;
    	$sp->penslug = Str::slug($limititle);
    	$sp->penisi = $request->penisi;
    	$sp->penwriter = Auth::user()->id;
    	$sp->pendate = date('Y-m-d H:i');

    	if($request->file('thumb') == "")
        {
            $sp->penthumb = 'img/default-thumb.jpg';
        } 
        else
        {
            $file       = $request->file('thumb');
            $fileArray = array('image' => $file);
            $rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:1000000');
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
            Image::make($file)->resize(750, 350)->save(base_path().'/../public_html/image/'.$fileName  );
            $sp->penthumb = "image/".$fileName;
   		 	}
   		}            
	
 
       try {
        $sp->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! penyakit tersebut gagal diterbitkan', 'alert');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! penyakit sudah diterbitkan!', 'success');
     return redirect('adminix/penyakit')->with('msg', $msg);
    }

    public function editpen($id)
    {
      if(Auth::user()->role == 3)
{
  
    	$pen = p::where('penid',$id)->first();

    	return view('adminx.penyakit.edit')->with(compact('pen'));
      }
else
{
  return redirect('dashboard');
}
    }

    public function savepen(Request $request)
    {
    	$up = p::where('penid',$request->penid)->first();
    	$up->pennama = $request->pennama;
    	$up->penisi = $request->penisi;
    	$rand = substr(md5(microtime()),rand(0,26),5);
    	$limititle = substr($request['pennama'],0,50).'-'.$rand;
    	$up->penslug = Str::slug($limititle);
    	
    	if($request->file('thumb') == "")
        {
            $up->penthumb = $up->penthumb;
        } 
        else
        {
            $file       = $request->file('thumb');
            $fileArray = array('image' => $file);
            $rules = array('image' => 'mimes:jpeg,jpg,png,gif|required|max:1000000');
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
         $fileName   = time() . '-' .$file->getClientOriginalName();
            Image::make($file)->resize(750, 350)->save(base_path().'/../public_html/image/'.$fileName );
            $up->penthumb = "image/".$fileName;
   		 	}
   		}            
	
 
       try {
        $up->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! penyakit tersebut gagal diubah', 'alert');
     return redirect('adminix/penyakit')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! penyakit sudah diubah!', 'success');
     return redirect('adminix/penyakit')->with('msg', $msg);
    }

    public function deletepen($id)
    {
      if(Auth::user()->role == 3)
{
  
    	$dp =  p::where('penid',$id)->first();

    	try
    	{
    		$dp->delete();

    	}

    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat menghapus', 'alert');

    return $e;

 }

 $msg = notify()->flash('Penyakit berhasil dihapus', 'success');

 	return redirect('adminix/penyakit')->with(compact('msg'));
}
else
{
  return redirect('dashboard');
}
    }

    public function penyakitlist()
    {
    	$allpen = p::orderBy('pennama', 'ASC')->get()->sortBy('pennama', SORT_REGULAR, true);
    	$allposts = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','article.*')->orderby('artid','DESC')->paginate(15);
       $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::where('role',2)->inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
        $ad = ads::where('adsid',5)->first();
    	return view('penyakitblog')->with(compact('allpen','allposts','randart','randoc','randpen','ad'));
    }

    public function penyakitshow($slug) 
    {
    	$ps = p::where('penslug',$slug)->first();
    	$allposts = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','article.*')->orderby('artid','DESC')->paginate(15);
       $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::where('role',2)->inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
        $ad = ads::where('adsid',5)->first();

    	return view('penyakitshow')->with(compact('ps','allposts','randart','randoc','randpen','ad'));
    }
}
