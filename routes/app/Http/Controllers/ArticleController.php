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

class ArticleController extends Controller
{
    public function allarticle()
    {
        if(Auth::user()->role == 3)
{

    	$allpost = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','article.*')->orderby('artid','DESC')->paginate(15);


    	return view('adminx.artikel.index')->with(compact('allpost'));
}
else
{
  return redirect('dashboard');
}
    }

    public function newarticle()
    {
        if(Auth::user()->role == 3)
{
    	$allcat = c::get();

    	return view('adminx.artikel.newart')->with(compact('allcat'));
}
else
{
  return redirect('dashboard');
}
    }

    public function savenewarticle(Request $request)
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
     return redirect('adminix/artikel')->with('msg', $msg);
    		}

        
       $msg = notify()->flash('Berhasil! post sudah diterbitkan!', 'success');
     return redirect('adminix/artikel')->with('msg', $msg);
}

    public function deletearticle($id)
    {
if(Auth::user()->role == 3)
{
    	$da =  a::where('artid',$id)->first();

    	try
    	{
    		$da->delete();

    	}

    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat menghapus', 'alert');

    return $e;

 }

 $msg = notify()->flash('Artikel berhasil dihapus', 'success');

 	return redirect('adminix/artikel')->with(compact('msg'));
}
else
{
  return redirect('dashboard');
}

    }

    public function editarticle($id)
    {
        if(Auth::user()->role == 3)
{
    	$ea = a::join('articlecategory','article.artcat','=','articlecategory.catid')->select('articlecategory.catname','article.*')->where('artid',$id)->first();
    	$allcat = c::get();

    	return view('adminx.artikel.editart')->with(compact('ea','allcat'));
}
else
{
  return redirect('dashboard');
}
    }

    public function saveeditarticle(Request $request)
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

 	return redirect('adminix/artikel')->with(compact('msg'));

    }
}

    public function detailarticle($id)
    {
        if(Auth::user()->role == 3)
{
    	$da = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','article.*')->where('artid',$id)->first();

    	return view('adminx.artikel.detailart')->with(compact('da'));
}
else
{
  return redirect('dashboard');
}
    }

public function articleshow($slug)
{

	$show = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname', 'articlecategory.catslug','article.*')->where('artslug',$slug)->first();
	$allposts = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','article.*')->orderby('artid','DESC')->paginate(15);
    $randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);

	return view('articleshow')->with(compact('show','allposts','randart','randoc','randpen'));
}

public function articleblog()
{
	$allposts = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','articlecategory.catslug','article.*')->orderby('artid','DESC')->paginate(15);
    $randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);

	return view('articleblog')->with(compact('allposts','randart','randoc','randpen'));
}

public function categoryblog()
{
	$allcate = c::orderBy('catname', 'ASC')->paginate(30);
$randart = a::join('users','article.artwriter','=','users.id')->select('article.*','users.name')->inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
	return view('categoryblogs')->with(compact('allcate','randart','randoc','randpen'));
}

    // CATEGORY

    public function allcategory()
    {
        if(Auth::user()->role == 3)
{
    	$allcate = c::get()->sortByDesc('catname');

    	return view('adminx.artikel.indexcat')->with(compact('allcate'));
}
else
{
  return redirect('dashboard');
}
    }

    public function newcategory()
    {
          if(Auth::user()->role == 3)
{
    	return view('adminx.artikel.newcat');
}
else
{
  return redirect('dashboard');
}
    }

    public function savenewcategory(Request $request)
    {
    	$sc = new c;
    	$sc->catname = $request->catname;
    	$slug = substr($request->catname,0,30);
    	$sc->catslug = Str::slug($slug);

    	 try {
        $sc->save();
      }
            catch (\Illuminate\Database\QueryException $e) {
        $msg = notify()->flash('Oh No! kategori tersebut gagal diterbitkan', 'alert');
     return redirect('adminix/artikel/kategori')->with('msg', $msg);
    }
        
       $msg = notify()->flash('Berhasil! kategori sudah diterbitkan!', 'success');
     return redirect('adminix/artikel/kategori')->with('msg', $msg);


    }

    public function deletecategory($id)
    {
         if(Auth::user()->role == 3)
{
    	$dc =  c::where('catid',$id)->first();

    	try
    	{
    		$dc->delete();

    	}

    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat menghapus', 'alert');

    return $e;

 }

 $msg = notify()->flash('Category berhasil dihapus', 'success');

 	return redirect('adminix/artikel/kategori')->with(compact('msg'));

}
else
{
  return redirect('dashboard');
}
    }

    public function editcategory($id)
    {
        if(Auth::user()->role == 3)
{
    	$ec = c::where('catid',$id)->first();

    	return view('adminx.artikel.editcat')->with(compact('ec'));
}
else
{
  return redirect('dashboard');
}

    }

    public function editsave(Request $request)
    {
    	$sec = c::where('catid',$request->catid)->first();
    	$sec->catname = $request->catname;
    	$slug = substr($request->catname,0,30);
    	$sec->catslug = Str::slug($slug);

    	try
    	{
    		$sec->update();

    	}

    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat mengubah', 'alert');

    return $e;

 }

 $msg = notify()->flash('Category berhasil diubah', 'success');

 	return redirect('adminix/artikel/kategori')->with(compact('msg'));

    }

    public function categoryshow($slug)
    {
        $findslug = c::where('catslug',$slug)->first();
        $getid = $findslug->catid;

        $a = a::join('users','article.artwriter','=','users.id')->join('articlecategory','article.artcat','=','articlecategory.catid')->select('users.name','articlecategory.catname','articlecategory.catslug','article.*')->where('artcat',$getid)->paginate(15);

            $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
        return view('categoryshows')->with(compact('a','randart','randoc','randpen','findslug'));
    }
}
