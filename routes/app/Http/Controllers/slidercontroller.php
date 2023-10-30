<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider as s;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;

class slidercontroller extends Controller
{
    public function slideradmin()
    {
       if(Auth::user()->role == 3)
{
    	$slider = s::paginate(25);

    	return view('adminx.slider.index')->with(compact('slider'));
      }
else
{
  return redirect('dashboard');
}
    }

    public function slidernew()
    {
       if(Auth::user()->role == 3)
{
    	return view('adminx.slider.new');
      }
else
{
  return redirect('dashboard');
}
    }

    public function saveslider(Request $request)
    {
    	$ns = new s;
    	$ns->slidjudul = $request->slidjudul;
    	$ns->sliddesc = $request->sliddesc;

    	if($request->file('slidimg') == "")
        {
            $ns->slidimg = '';
        } 
        else
        {
            $file       = $request->file('slidimg');
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
            Image::make($file)->resize(356, 500)->save(public_path('image/' . $fileName ) );
            $ns->slidimg = "image/".$fileName;
   			 	}           
    		}


    	if($request->file('slidbg') == "")
        {
            $ns->slidbg = '';
        } 
        else
        {
            $file       = $request->file('slidbg');
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
            Image::make($file)->resize(920, 680)->save(public_path('image/' . $fileName ) );
            $ns->slidbg = "image/".$fileName;
   			 	}           
    		}

    	 try {
        $ns->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! slider tersebut gagal diterbitkan', 'alert');
     return redirect('adminix/slider')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! slider sudah diterbitkan!', 'success');
     return redirect('adminix/slider')->with('msg', $msg);
    }

    public function editslider($id)
    {
       if(Auth::user()->role == 3)
{
    	$es = s::where('slidid',$id)->first();

    	return view('adminx.slider.edit')->with(compact('es'));
}
else
{
  return redirect('dashboard');
}
    }

    public function editedslider(Request $request)
    {
    	$us = s::where('slidid',$request->slidid)->first();
    	$us->slidjudul = $request->slidjudul;
    	$us->sliddesc = $request->sliddesc;

    	if($request->file('slidimg') == "")
        {
            $us->slidimg = $us->slidimg;
        } 
        else
        {
            $file       = $request->file('slidimg');
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
            Image::make($file)->resize(356, 500)->save(public_path('image/' . $fileName ) );
            $us->slidimg = "image/".$fileName;
   			 	}           
    		}


    	if($request->file('slidbg') == "")
        {
            $us->slidbg = $us->slidbg;
        } 
        else
        {
            $file       = $request->file('slidbg');
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
            Image::make($file)->resize(920, 680)->save(public_path('image/' . $fileName ) );
            $us->slidbg = "image/".$fileName;
   			 	}           
    		}

    	 try {
        $us->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! slider tersebut gagal diubah', 'alert');
     return redirect('adminix/slider')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! slider sudah diedit!', 'success');
     return redirect('adminix/slider')->with('msg', $msg);

    }

    public function deleteslider($id)
    {
       if(Auth::user()->role == 3)
{
    	$ds = s::where('slidid',$id)->first();
    	 try {
        $ds->delete();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! slider tersebut gagal dihapus', 'alert');
     return redirect('adminix/slider')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! slider sudah dihapus!', 'success');
     return redirect('adminix/slider')->with('msg', $msg);
     }
else
{
  return redirect('dashboard');
}

    }


}
