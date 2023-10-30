<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konsultasi as k;
use App\KonsulCat as kc;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use App\Article as a;
use App\Kategori as c;
use Illuminate\Support\Str;
use App\Jawaban as j;
use App\Penyakit as p;
use App\User as u;
use App\Slider as s;
use App\Ads as ads;


class KonsultasiController extends Controller
{
    public function konsultasip()
    {
        $ad = ads::where('adsid',5)->first();
    	$kindex = k::join('users','konsultasi.konswriter','=','users.id')->join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('users.name','users.id','users.profilepic','users.role','konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->orderby('konsid','DESC')->paginate(15);
         $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::where('role',2)->inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
    	return view('threadlist')->with(compact('kindex','randart','randoc','randpen','ad'));
    }

    public function newkonsul()
    {
        $ad = ads::where('adsid',5)->first();
    	$kc = kc::get();
         $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::where('role',2)->inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
    	return view('newkonsul')->with(compact('kc','randart','randoc','randpen','ad'));
    }

    public function savekonsul(Request $request)
    {
    	$sk = new k ;
    	$sk->konsjudul = $request->konsjudul;
        $rand = substr(md5(microtime()),rand(0,26),5);
        $limit = substr($request['konsjudul'],0,50).'-'.$rand;
    	$sk->konsslug = Str::slug($limit);
    	$sk->konsisi = $request->konsisi;
    	$sk->konscat = $request->koncatid;
    	$sk->konswriter = Auth::id();
    	$sk->konsdate = date('Y-m-d H:i');

    	 try {
        $sk->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diterbitkan', 'alert');
     return $e;
    		}

  $msg = notify()->flash('Berhasil ! Pertanyaan anda berhasil diterbitkan', 'alert');
     return redirect('konsultasi/'.$sk->konsslug)->with('msg', $msg);
    }
    public function viewkonsul($slug)
    {
        $ad = ads::where('adsid',5)->first();
        $vk = k::join('users','konsultasi.konswriter','=','users.id')->join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('users.name','users.id','users.profilepic','users.role','konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->where('konsslug',$slug)->first();
        $vj = j::join('konsultasi','jawaban.jawthread','=','konsultasi.konsid')->join('users','jawaban.jawwriter','=','users.id')->select('jawaban.*','users.profilepic','users.role','konsultasi.konsslug','users.name','users.id')->where('konsultasi.konsslug',$slug)->orderby('jawdate','ASC')->paginate(5);
        $rk = k::join('users','konsultasi.konswriter','=','users.id')->join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('users.name','users.id','users.profilepic','users.role','konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->inRandomOrder()->get(5);

         $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
    	return view('thread')->with(compact('vk','vj','rk','randoc','randpen','randart','ad'));
    }

    public function editkonsul($slug)
    {
        $ad = ads::where('adsid',5)->first();
        $ek = k::join('konsulcat', 'konsultasi.konscat','=','konsulcat.koncatid' )->select('konsultasi.*','konsulcat.koncatjudul','konsulcat.koncatid')->where('konsslug',$slug)->first();
        $kc = kc::get();
        if($ek->konswriter == Auth::id())
        {
             $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
            return view('editkonsul')->with(compact('ek','kc','randart','randoc','randpen','ad')); 
        }
        else {
            $msg = notify()->flash('Oh No! anda tidak memiliki akses terhadap postingan tersebut', 'alert');
            redirect()->back()->with(compact('msg'));
        }
    }

    public function editsave(Request $request, $slug)
    {
        $sek = k::where('konsslug',$slug)->first();
        $sek->konsjudul = $request->konsjudul;
        $rand = substr(md5(microtime()),rand(0,26),5);
         $limit = substr($request['konsjudul'],0,50).'-'.$rand;
        $sek->konsslug = Str::slug($limit);
        $sek->konsisi = $request->konsisi;
        $sek->konscat = $request->koncatid;

         try {
        $sek->update();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diubah', 'alert');
     return $e;
            }

  $msg = notify()->flash('Berhasil ! Pertanyaan anda berhasil diubah', 'alert');
     return redirect('konsultasi/'.$sek->konsslug)->with('msg', $msg);
    }

    public function konsuladmin()
    {
        if(Auth::user()->role == 3)
{
        $allthread = k::join('users','konsultasi.konswriter','=','users.id')->join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('users.name','users.id','users.profilepic','users.role','konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->paginate(25);

        return view('adminx.konsultasi.index')->with(compact('allthread'));
}
else
{
  return redirect('dashboard');
}
    }

    public function editkonsulbyadmin($id)
    {
        if(Auth::user()->role == 3)
{
        $ek = k::join('konsulcat','konsultasi.konscat','=','konsulcat.koncatid')->select('konsulcat.koncatid','konsulcat.koncatjudul','konsulcat.koncatslug','konsultasi.*')->where('konsid',$id)->first();
        $kc = kc::get();

        return view('adminx.konsultasi.edit')->with(compact('ek','kc'));
}
else
{
  return redirect('dashboard');
}
    }

    public function savekonsuleditbyadmin(Request $request)
    {
        $se = k::where('konsid',$request->konsid)->first();
        $se->konsjudul = $request->konsjudul;
        $se->konsisi = $request->konsisi;
        $se->konscat = $request->konscat;
        $rand = substr(md5(microtime()),rand(0,26),5);
        $limit = substr($request['konsjudul'],0,50).'-'.$rand;
        $se->konsslug = $limit;

         try {
        $se->update();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! Thread tersebut gagal diubah', 'alert');
     return $e;
            }

  $msg = notify()->flash('Berhasil ! Thread anda berhasil diubah', 'alert');
     return redirect('adminix/konsultasi/')->with('msg', $msg);
    }

    public function deletekonsulbyadmin($id)
    {
        if(Auth::user()->role == 3)
{
        $delthis = k::where('konsid',$id)->first();
         try {
        $delthis->delete();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! post tersebut gagal diubah', 'alert');
     return $e;
            }
  $msg = notify()->flash('Berhasil ! Thread berhasil dihapus', 'alert');
     return redirect('adminix/konsultasi/')->with('msg', $msg);
}
else
{
  return redirect('dashboard');
}
    }

    public function closekonsul($id)
    {
        if(Auth::user()->role == 3)
{
        $ck = k::where('konsid',$id)->first();
         try {
        $ck->konstatus = 3;
        $ck->update();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! thread tersebut gagal dikunci', 'alert');
     return $e;
            }
  $msg = notify()->flash('Berhasil ! Thread berhasil dikunci', 'alert');
     return redirect('adminix/konsultasi/')->with('msg', $msg);
}
else
{
  return redirect('dashboard');
}

    }

     public function unclosekonsul($id)
    {
        if(Auth::user()->role == 3)
{
        $ck = k::where('konsid',$id)->first();
         try {
        $ck->konstatus = 1;
        $ck->update();
    }
        catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! thread tersebut gagal dibuka', 'alert');
     return $e;
            }
  $msg = notify()->flash('Berhasil ! Thread berhasil dibuka', 'alert');
     return redirect('adminix/konsultasi/')->with('msg', $msg);
}
else
{
  return redirect('dashboard');
}
    }
}
