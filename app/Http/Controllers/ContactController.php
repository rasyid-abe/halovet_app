<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact as c;
use Illuminate\Support\Facades\Validator;
use App\Ads as ads;
use Auth;

class ContactController extends Controller
{
    public function pagecontact()
    {
        $ad = ads::where('adsid',5)->first();
    	return view('contact')->with(compact('ad'));
   	}

   	public function pagesend(Request $request)
   	{
  
    $validator = Validator::make($request->all(), [
        'contemail' => 'required|email',
        'contname' => 'required',
        'contisi' => 'required',
        'contjudul' => 'required'
     
        /*'usertype' => 'required',*/
     ]);

    if ($validator->fails()) {
    	$msg = notify()->flash('Terdapat Kesalahan, Silahkan cek kesalahan anda ', 'warning');
            return redirect()->back()->with(compact('msg'));
        }
else
{
   		if($request->captcha === "Hallovet")
   		{
   		$sc = new c;
   		$sc->contjudul = $request->contjudul;
   		$sc->contname = $request->contname;
   		$sc->contemail = $request->contemail;
   		$sc->contisi = $request->contisi;
   		$sc->contdate = date('Y-m-d H:i');

   		try {
        $sc->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No ! halaman tersebut gagal diterbitkan', 'warning');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil ! kami akan membalas pesan anda dalam waktu dekat', 'success');
     return redirect('contact')->with('msg', $msg);
   	}
   	else
   	{
   		$msg = notify()->flash('Oh No ! isikan manual captcha dengan Hallovet', 'warning');
   		return redirect()->back()->with(compact('msg'));
   	}
   	}
   }

   public function admincontact()
   {
    if(Auth::user()->role == 3)
{
    $ca = c::paginate(25);
    return view('adminx.contact.index')->with(compact('ca'));
}
else
{
  return redirect('dashboard');
}
   }

   public function detailcontact($id)
   {
    if(Auth::user()->role == 3)
{
    $cd = c::where('contid',$id)->first();
    return view('adminx.contact.show')->with(compact('cd'));
}
else
{
  return redirect('dashboard');
}
   }

   public function deletecontact($id)
   {
    $dp = c::where('contid',$id)->first();
     try
        {
            $dp->delete();

        }

        catch (\Illuminate\Database\QueryException $e)
 {
    $msg = notify()->flash('Oh No ! Error pada saat mengubah', 'alert');

    return $e;

 }

 $msg = notify()->flash('Pesan berhasil dihapus', 'success');

    return redirect('adminix/contact')->with(compact('msg'));
   }
}
