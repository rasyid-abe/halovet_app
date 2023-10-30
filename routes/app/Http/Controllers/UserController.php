<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as u;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\City as city;
use App\Article as a;
use App\Konsultasi as k;
class UserController extends Controller
{
      public function show($id)
    {
    	$show = u::where('id',$id)->first();
    	$uk = k::where('konswriter',$id)->orderBy('konsdate','DESC')->paginate(10);
    	return view('user.profile')->with(compact('show','uk'));
    }

    public function setting()
    {
    	$edit = u::where('id',Auth::id())->first();
    	return view('user.setting.setting')->with(compact('edit'));
    }

    public function savesetting(Request $request)
    {
    	$update = u::where('id',Auth::user()->id)->first();
    	$update->name = $request->name;
    	$update->nohp = $request->nohp;
    	$update->alamat = $request->alamat;
    	$update->bio = $request->bio;

        if($request->file('profile') == "")
        {
            $update->profilepic = $update->profilepic;
        } 
        else
        {
            $file       = $request->file('profile');
            $fileArray = array('image' => $file);
            $rules = array(
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:100000' // max 10000kb
    );
             $validator = Validator::make($fileArray, $rules);
              if ($validator->fails())
    {
          // Redirect or return json to frontend with a helpful message to inform the user 
          // that the provided file was not an adequate type
        $err = "<strong>File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload</strong>";

        $msg = notify()->flash('Oh No ! File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload', 'alert');

          return redirect()->back()->with('msg',$msg);
    } 
    else
    {
        // Store the File Now
        // read image from temporary file
         $fileName   = time() . '.' .$file->getClientOriginalName();
            Image::make($file)->resize(200, 200)->save(public_path('image/' . $fileName ) );
            $update->profilepic = "image/".$fileName;
    }
           
        }
        
        $update->update();
        $msg = notify()->flash('Yeaay!, perubahan berhasil dilakukan', 'success');

        return redirect('setting')->with('msg',$msg);
    }

    public function settingdokter()
    {
    	if (Auth::user()->role == 2)
    	{

    		$editdok = u::where('id',Auth::id())->first();
            if (!is_null($editdok->cityid)) {
                $kotdok = city::where('kotid',$editdok->cityid)->first();
                $adakota = 1;
            }
            else
            {
                $kotdok = '';
                $adakota = 0;
            }
    	return view('user.setting.dokterupload')->with(compact('editdok','adakota','kotdok'));
    	}

    	else
    	{
    		$msg = notify()->flash('Kamu tidak punya akses', 'alert');

        return redirect('setting')->with('msg',$msg);
    	}
    }

    public function settingdoktersave(Request $request)
    {

    	$update2 = u::where('id',Auth::user()->id)->first();
    	$update2->tahunlulus = $request->tahunlulus;
    	$update2->lulusan = $request->lulusan;
    	$update2->klinik = $request->klinik;
        $update2->cityid = $request->city;
    	$update2->pengalaman = $request->pengalaman;


        if($request->file('scanktp') == "")
        {
            $update2->scanktp = $update2->scanktp;
        } 
        else
        {
            $file       = $request->file('scanktp');
            $fileArray = array('image' => $file);
            $rules = array(
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:500000' // max 10000kb
    );
             $validator = Validator::make($fileArray, $rules);
              if ($validator->fails())
    {
          // Redirect or return json to frontend with a helpful message to inform the user 
          // that the provided file was not an adequate type
        $err = "<strong>File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload</strong>";

        $msg = notify()->flash('Oh No ! File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload', 'alert');

          return redirect()->back()->with('msg',$msg);
    } 
    else
    {
        // Store the File Now
        // read image from temporary file
         $fileName   = time() . '.' .$file->getClientOriginalName();
            Image::make($file)->resize(200, 200)->save(public_path('image/' . $fileName ) );
            $update2->scanktp = "image/".$fileName;
    }
           
        }


        if($request->file('scansurat') == "")
        {
            $update2->scansurat = $update2->scansurat;
        } 
        else
        {

         $file2       = $request->file('scansurat');
            $fileArray2 = array('image' => $file2);
            $rules2 = array(
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:500000' // max 10000kb
    );
             $validator2 = Validator::make($fileArray2, $rules2);
              if ($validator2->fails())
    {
          // Redirect or return json to frontend with a helpful message to inform the user 
          // that the provided file was not an adequate type
        $err2 = "<strong>File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload</strong>";

        $msg2 = notify()->flash('Oh No ! File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload', 'alert');

          return redirect()->back()->with('msg',$msg2);
    } 
    else
    {
        // Store the File Now
        // read image from temporary file
         $fileName2   = time() . '.' .$file2->getClientOriginalName();
            Image::make($file2)->resize(200, 200)->save(public_path('image/' . $fileName2 ) );
            $update2->scansurat = "image/".$fileName2;
    }
}
        
        $update2->update();
        $msgx = notify()->flash('Yeaay!, perubahan berhasil dilakukan', 'success');

        return redirect('setting/dokter')->with('msg',$msgx);
    

    }

    // ADMINIX
        // ADMINIX USER
    public function adminalluser()
    {
        if(Auth::user()->role == 3)
{
    	$allu = u::where('role',1)->paginate(16);
    	return view('adminx.user.alluser')->with(compact('allu'));
             }
else
{
  return redirect('dashboard');
}
    }

    public function adminnewuser()
    {
        if(Auth::user()->role == 3)
{
    	return view('adminx.user.newuser');
}
else
{
  return redirect('dashboard');
}
    }
    
public function admindetailuser($id)
    {
        if(Auth::user()->role == 3)
{
        $upost = 
    	$detail = u::where('id',$id)->first();
    	return view('adminx.user.userdetail')->with(compact('detail'));
    }
    else
{
  return redirect('dashboard');
}
}

    public function adminedituser($id)
    {
        if(Auth::user()->role == 3)
{
    	$edits = u::where('id',$id)->first();

    	return view('adminx.user.edituser')->with(compact('edits'));
         }
else
{
  return redirect('dashboard');
}

    }

    public function admineditsave(Request $request)
    {
    	$edited = u::where('id',$request->userid)->first();
    	$edited->name = $request->nama;
    	$edited->nohp = $request->nohp;
    	$edited->alamat = $request->alamat;
    	$edited->bio = $request->bio;

    	try {
    		$edited->update();
    	}
    	catch (\Illuminate\Database\QueryException $e)
 {
	$msg = notify()->flash('Oh No ! Error pada saat mengubah', 'alert');

    return $e;

 }

 $msg = notify()->flash('Berhasil Di Ubah', 'success');
 return redirect('adminix/user')->with(compact('msg'));
    }

    public function admindeleteuser($id)
    {
        if(Auth::user()->role == 3)
{
    	$del = u::where('id', $id)->first();

    	if($del->id == Auth::user()->id)
    	{
    	$msg = notify()->flash('Gagal Dihapus, ada kesalahan', 'alert');
 return redirect('adminix/user')->with(compact('msg'));
    	}
    	else
    	{
    	try
    	{
    		$del->delete();

    	}
    	catch (\Illuminate\Database\QueryException $e)
    	{
    		 $msg = notify()->flash('Gagal Dihapus, ada kesalahan', 'alert');
 return redirect('adminix/user')->with(compact('msg'));
    	}
    }

 $msg = notify()->flash('Berhasil Dihapus', 'success');
 return redirect('adminix/user')->with(compact('msg'));
  }
else
{
  return redirect('dashboard');
}
    }

    //
     public function adminalldokter()
    {
        if(Auth::user()->role == 3)
{
    	$ald = u::where('role',2)->where('verifadmin',1)->paginate(16);
    	return view('adminx.user.alldoctor')->with(compact('ald'));
         }
else
{
  return redirect('dashboard');
}
    }
public function adminalldokterunverified()
    {
        if(Auth::user()->role == 3)
{
    	$aldun = u::where('role',2)->where('verifadmin',0)->paginate(16);
    	return view('adminx.user.alldoctorunverified')->with(compact('aldun'));
    }
    else
{
  return redirect('dashboard');
}
}

    public function adminnewdokter()
    {
        if(Auth::user()->role == 3)
{
    	return view('adminx.user.newdok');
         }
else
{
  return redirect('dashboard');
}
    }
public function admindetaildokter($id)
    {
        if(Auth::user()->role == 3)
{
    	$doktail = u::where('id',$id)->first();
    	return view('adminx.user.dokdetail')->with(compact('detail'));
         }
else
{
  return redirect('dashboard');
}
    }


    public function adminverifydokter($id)
    {
    	$dokterverify = u::where('id',$id)->where('role',2)->first();

    	if($dokterverify->verifadmin == 1)
    	{
    		$msg = notify()->flash('Dokter ini sudah terverifikasi', 'success');
 return redirect('adminix/user')->with(compact('msg'));
    	}
    	else
    	{
    		$dokterverify->verifadmin = 1;
try
    	{
    		$dokterverify->update();

    	}
    	catch (\Illuminate\Database\QueryException $e)
    	{
    		 $msg = notify()->flash('Gagal Diverifikasi, ada kesalahan', 'alert');
 return redirect('adminix/user')->with(compact('msg'));
    	}

    	$msg = notify()->flash('Berhasil Diverifikasi', 'success');
 return redirect('adminix/user')->with(compact('msg'));
 

    	}
    }

     public function adminunverifydokter($id)
    {
    	$dokterunverify = u::where('id',$id)->where('role',2)->first();

    	if($dokterunverify->verifadmin == 0)
    	{
    		$msg = notify()->flash('Dokter ini memang belum terverifikasi', 'success');
 return redirect('adminix/user')->with(compact('msg'));
    	}
    	else
    	{
    		$dokterunverify->verifadmin = 0;
try
    	{
    		$dokterunverify->update();

    	}
    	catch (\Illuminate\Database\QueryException $e)
    	{
    		 $msg = notify()->flash('Gagal Diverifikasi, ada kesalahan', 'alert');
 return redirect('adminix/user')->with(compact('msg'));
    	}

    	$msg = notify()->flash('Status verifikasi berhasil dicabut', 'success');
 return redirect('adminix/user')->with(compact('msg'));

    	}
    }

    public function dokterall(Request $request)
    {
        $ra = a::paginate(5);
        $cityid = $request->get('kota');
        if(!empty($cityid))
        {
        $alldok = u::join('city','users.cityid','=','city.kotid')->select('users.*','city.*')->where('role',2)->where('cityid',$cityid)->paginate(15);
        $cityname = city::where('kotid',$cityid)->first();
          return view('dokter')->with(compact('alldok','ra','$cityname'));
        }
        else
        {
        $alldok = u::join('city','users.cityid','=','city.kotid')->select('users.*','city.*')->where('role',2)->paginate(15);
          return view('dokter')->with(compact('alldok','ra'));
        }
      

    }
}
