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

class IndexController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return redirect('dashboard');
        }
        else
        {
    	$latesta = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','users.id','articlecategory.catname','articlecategory.catslug','article.*')->orderby('artid','DESC')->paginate(4);
    	$latestp = p::paginate(4);
    	$kc = kc::get();
    	$kindex = k::join('users','konsultasi.konswriter','=','users.id')->join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('users.name','users.id','users.profilepic','users.role','konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->orderby('konsid','DESC')->paginate(5);
    	$slider = s::paginate(4);


    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);
    	return view('index')->with(compact('latesta','latestp','kc','kindex','slider','randart','randoc','randpen'));
    }
    }

    public function dashboard()
    {
    	$timeline = k::join('users','konsultasi.konswriter','=','users.id')->join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('users.name','users.id','users.profilepic','users.role','konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->orderby('konsid','DESC')->paginate(10);

    	$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
    	$randoc = u::inRandomOrder()->paginate(2);
    	$randpen = p::inRandomOrder()->paginate(5);

    	return view('user.index')->with(compact('timeline','randoc','randpen','randart'));
    }

    public function doknewpost()
    {
        if(Auth::user()->role == 2)
        {
            if(Auth::user()->verifadmin == 1)
            {
        $allcat = c::get();
        $randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
        return view('user.post.new')->with(compact('allcat','randpen','randoc','randart'));
            }
            else
            {
                 $msg = notify()->flash('Untuk membuat artikel, akun anda harus terverifikasi', 'warning');

                return redirect('dashboard')->with(compact('msg'));
            }
        }
        else
        {
            return redirect('dashboard');
        }
    }

    public function doksavepost(Request $request)
    {

        $newpost = new a;
        $newpost->artjudul = $request->judul;
        $newpost->artcat = $request->catid;
        $rand = substr(md5(microtime()),rand(0,26),5);
        $limititle = substr($request['judul'],0,50).'-'.$rand;
   
        $newpost->artisi = $request->isi;
        $newpost->artslug = Str::slug($limititle);
        $newpost->artwriter = Auth::user()->id;
        $newpost->artdate = date('Y-m-d H:i');

        if($request->file('profile') == "")
        {
            $newpost->artthumbnail = 'img/default-thumb.jpg';
        } 
        else
        {
            $file       = $request->file('profile');
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
            Image::make($file)->resize(750, 350)->save(public_path('image/' . $fileName ) );
            $newpost->artthumbnail = "image/".$fileName;
            }            
    
    }

       try {
        $newpost->save();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diterbitkan', 'alert');
     return redirect()->back()->with('msg', $msg);
            }

        
       $msg = notify()->flash('Berhasil! post sudah diterbitkan!', 'success');
     return redirect('dashboard/post')->with('msg', $msg);

    }

    public function dokeditpost($id)
    {
         $ea = a::join('articlecategory','article.artcat','=','articlecategory.catid')->select('articlecategory.catname','article.*')->where('artid',$id)->first();

        if($ea->artwriter == Auth::id() )
        {
            
       
        $allcat = c::get();

        return view('user.post.edit')->with(compact('ea','allcat'));
    
   
        $msg = notify()->flash('Untuk membuat artikel, akun anda harus terverifikasi', 'warning');

                return redirect('dashboard')->with(compact('msg'));
    
    }
else
    {
        return redirect('dashboard');
    }

    }

    public function dokupdatepost(Request $request)
    {
        $sa = a::where('artid',$request->artid)->first();

        $rand = substr(md5(microtime()),rand(0,26),5);
        $limititle = substr($request['judul'],0,50).'-'.$rand;
        $sa->artjudul = $request->judul;
        $sa->artslug = Str::slug($limititle);
        $sa->artisi = $request->isi;
        $sa->artcat = $request->catid;
        $sa->artwriter = $sa->artwriter;
if($request->file('profile') == "")
        {
            $sa->artthumbnail = $sa->artthumb;
        } 
        else
        {
            $file       = $request->file('profile');
            $fileArray = array('image' => $file);
            $rules = array(
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:1000000' // max 10000kb
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
            Image::make($file)->resize(750, 370)->save(public_path('image/' . $fileName ) );
           $sa->artthumbnail = "image/".$fileName;
    }
            try
        {
            $sa->update();

        }

        catch (\Illuminate\Database\QueryException $e)
 {
    $msg = notify()->flash('Oh No ! Error pada saat mengubah', 'alert');

    return $e;

 }

 $msg = notify()->flash('Artikel berhasil diubah', 'success');

    return redirect('dashboard/post')->with(compact('msg'));

    }
    	
    }

    public function dokdeletepost($slug)
    {
        $dp = a::where('artslug',$slug)->first();
        if($dp->artwriter == Auth::id())
        {
            try
        
        {
            $dp->delete();

        }

        catch (\Illuminate\Database\QueryException $e)
 {
    $msg = notify()->flash('Oh No ! Error pada saat mengubah', 'alert');

    return $e;

 }

 $msg = notify()->flash('Artikel berhasil diubah', 'success');

    return redirect('dashboard/post')->with(compact('msg'));
}

else
{
    return redirect('dashboard');
}

    }

    public function dokpost()
    {
        if(Auth::user()->role == 2)
        {
        $allpost = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','article.*')->where('artwriter',Auth::id())->orderby('artid','DESC')->paginate(15);
            $randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);

        return view('user.post.post')->with(compact('allpost','randoc','randart','randpen'));
    }
    }

}
