<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban as j;
use App\Konsultasi as k;
use App\KonsulCat as kc;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use App\Article as a;
use App\Kategori as c;
use Illuminate\Support\Str;

class JawabanController extends Controller
{
    public function balased(Request $request)
    {
		$bj = new j;
		$bj->jawisi = $request->jawisi;
		$bj->jawthread = $request->jawthread;
		$bj->jawdate = date('Y-m-d H:i');
        $bj->jawwriter = Auth::id();    	

		 try {
        $bj->save();

        if(Auth::user()->role == 2)
        {
            $cs = k::where('konsid',$request->jawthread)->first();
            $cs->konstatus = 2;
            $cs->update();
        }
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! balasan tersebut gagal diterbitkan', 'alert');
     return $e;
    		}

    		$msg = notify()->flash('Berhasil ! balasan anda telah diterbitkan', 'success');
    		return redirect('konsultasi/'.$request->slugthread)->with(compact('msg'));

    }

    public function indexadmin()
    {
        if(Auth::user()->role == 3)
{
    	$ia = j::paginate(20);
    	return view('adminx.jawaban.index');
         }
else
{
  return redirect('dashboard');
}
    }

    public function editjaw($id)
    {
        $ej = j::where('jawid',$id)->first();
        if($ej->jawwriter == Auth::id())
        {
             $randart = a::inRandomOrder()->paginate(5);
        $randoc = u::inRandomOrder()->paginate(2);
        $randpen = p::inRandomOrder()->paginate(5);
        return view('editjaw')->with(compact('ej','randoc','randpen','randart'));
    }
    else
    {
    return redirect()->back();
    }

}

    public function editedjaw(Request $request)
    {
        $uj = j::where('jawid',$request->jawid)->first();
        $uj->jawisi = $request->jawisi;     

         try {
        $uj->update();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! balasan tersebut gagal diterbitkan', 'alert');
     return $e;
            }
            $msg = notify()->flash('Berhasil ! Jawabah telah di ubah', 'success');
            return redirect()->back()->with(compact('msg'));
    }

    public function jawabanadmin()
    {
        if(Auth::user()->role == 3)
{
        $aj = j::join('users','jawaban.jawwriter','=','users.id')->join('konsultasi','jawaban.jawthread','=','konsultasi.konsid')->select('users.name','users.role','users.profilepic','users.id','konsultasi.konsjudul','konsultasi.konsslug','jawaban.*')->paginate(25);

        return view('adminx.jawaban.index')->with(compact('aj'));
         }
else
{
  return redirect('dashboard');
}
    }

    public function editjawabanbyadmin($id)
    {
if(Auth::user()->role == 3)
{
        $ej = j::join('konsultasi','jawaban.jawthread','=','konsultasi.konsid')->select('konsultasi.konsslug','konsultasi.konsid','konsultasi.konsjudul','jawaban.*')->where('jawid',$id)->first();

        return view('adminx.jawaban.edit')->with(compact('ej'));
         }
else
{
  return redirect('dashboard');
}

    }

    public function savejawabaneditbyadmin(Request $request)
    {
        $sj = j::where('jawid',$request->jawid)->first();
        $sj->jawisi = $request->jawisi;

         try {
        $sj->update();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! balasan tersebut gagal diterbitkan', 'alert');
     return $e;
            }
            $msg = notify()->flash('Berhasil ! Jawaban telah di ubah', 'alert');
            return redirect('adminix/jawabandiskusi')->with(compact('msg'));
    }

    public function deletejawabanbyadmin($id)
    {
        if(Auth::user()->role == 3)
{
        $dj = j::where('jawid',$id)->first();

         try {
        $dj->delete();
            }
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No! balasan tersebut gagal dihapus', 'alert');
     return $e;
            }
            $msg = notify()->flash('Berhasil ! Jawaban telah dihapus', 'alert');
            return redirect()->back()->with(compact('msg'));
            }
else
{
  return redirect('dashboard');
}
    }


}
