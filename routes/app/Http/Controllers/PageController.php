<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page as p;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function adminpage()
    {
      if(Auth::user()->role == 3)
{
    	$ap = p::paginate(25);

    	return view('adminx.page.index')->with(compact('ap'));
      }
else
{
  return redirect('dashboard');
}
    }

    public function newpage()
    {
      if(Auth::user()->role == 3)
{
    	return view('adminx.page.new');
      }
else
{
  return redirect('dashboard');
}

    }

    public function savepage(Request $request)
    {
    	$np = new p;
    	$np->pagejudul = $request->pagejudul;
    	$np->pagedesc = $request->pagedesc;
    	$rand = substr(md5(microtime()),rand(0,26),5);
    	$limititle = substr($request['pagejudul'],0,50);
    	$np->pageslug = Str::slug($limititle);


    	if($request->file('thumb') == "")
        {
            $np->pageimg = 'img/default-thumb-page.jpg';
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
            Image::make($file)->resize(1920, 1050)->save(public_path('image/' . $fileName ) );
            $np->pageimg = "image/".$fileName;
   		 	}
   		}            
	
 
       try {
        $np->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! halaman tersebut gagal diterbitkan', 'warning');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! halaman sudah diterbitkan!', 'success');
     return redirect('adminix/page')->with('msg', $msg);

    }

    public function editpage($id)
    {
       if(Auth::user()->role == 3)
{
    	$ep = p::where('pageid',$id)->first();

    	return view('adminx.page.edit')->with(compact('ep'));
}
else
{
  return redirect('dashboard');
}
    }

    public function updatepage(Request $request)
    {
    	$up = p::where('pageid',$request->pageid)->first();
    	$up->pagejudul = $request->pagejudul;
    	$up->pagedesc = $request->pagedesc;
    	$rand = substr(md5(microtime()),rand(0,26),5);
    	$limititle = substr($request['pagejudul'],0,50);
    	$up->pageslug = Str::slug($limititle);

    	if($request->file('thumb') == "")
        {
            $up->pageimg = $up->pageimg;
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
            Image::make($file)->resize(1920, 1050)->save(public_path('image/' . $fileName ) );
            $up->pageimg = "image/".$fileName;
   		 	}
   		}            
	
 
       try {
        $up->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! halaman tersebut gagal diubah', 'warning');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! halaman sudah diubah!', 'success');
     return redirect('adminix/page')->with('msg', $msg);
    }

    public function deletepage($id)
    {
       if(Auth::user()->role == 3)
{
    	$dp = p::where('pageid',$id)->first();
    	try {
        $dp->delete();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! halaman tersebut gagal dihapus', 'warning');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil! halaman sudah dihapus!', 'success');
     return redirect('adminix/page')->with('msg', $msg);
}
else
{
  return redirect('dashboard');
}
    }

    public function showpage($slug)
    {
    	$sp = p::where('pageslug',$slug)->first();
    	return view('page')->with(compact('sp'));
      }

      public function detailpage($id)
      {
if(Auth::user()->role == 3)
{
      	$dp = p::where('pageid',$id)->first();
      	return view('adminx.page.detail')->with(compact('dp'));
}
else
{
  return redirect('dashboard');
}
      }
}
