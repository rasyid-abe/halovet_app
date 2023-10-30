<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as u;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use App\City as city;
use App\Konsultasi as k;
use App\Article as a;
use Illuminate\Support\Facades\Hash;
use App\Ads as ads;
use App\Lokasi;
use App\Province;
    	

class UserController extends Controller
{
      public function show($id)
    {
        
    	$show = u::where('id',$id)->first();
    	$uk = k::where('konswriter',$id)->orderBy('konsdate','DESC')->paginate(10);
        $ad = ads::where('adsid',5)->first();  
        
        $lokasi = Lokasi::where('id_dokter', $id)->first();
          
        $number = '62' . substr($show->nohp, 1, strlen($show->nohp)-1);

        if($lokasi){
            return view('user.profile')->with(compact('show','uk','ad', 'lokasi', 'number'));
        } else {
            return view('user.profile')->with(compact('show','uk','ad', 'number'));
        }                            
    }

    public function reset()
    {
        $ad = ads::where('adsid',5)->first();
        $chang = u::where('id',Auth::id())->first();
        return view('user.setting.resetpass')->with(compact('chang','ad'));
    }

    public function reseted(Request $request)
    {
        $changepw = u::where('id',$request->userid)->first();
        $passlama = $request->passwordlama;
        $passbaru = $request->passwordbaru1;

        if(Hash::check($passlama,$changepw->password))
        {
            $lanjut = 1;
        }

        else
            {
                $lanjut = 0;
                $msg = notify()->flash('Password lama anda berbeda dengan yang ada di database !', 'alert');
                return redirect()->back()->with(compact('msg'));
            }

            if($lanjut == 1)
            {
                $changepw->password = bcrypt($passbaru);

                try
                {
                    $changepw->update();
                }

                catch(\Illuminate\Database\QueryException $e)
                {
                 $msg = notify()->flash('Terdapat kesalahan, tidak dapat mengganti password !', 'alert');
                return redirect()->back()->with(compact('msg'));   
                }

                $msg = notify()->flash('Berhasil ! Password berhasil diubah!', 'alert');
                return redirect()->back()->with(compact('msg'));
            }
    }

    public function setting()
    {
        $ad = ads::where('adsid',5)->first();
    	$edit = u::where('id',Auth::id())->first();
    	return view('user.setting.setting')->with(compact('edit','ad'));
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
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:1000000' // max 10000kb
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
            Image::make($file)->resize(200, 200)->save('/home/hallove1/public_html/image/' . $fileName );
            $update->profilepic = "image/".$fileName;
    }
           
        }
        
        $update->update();
        $msg = notify()->flash('Yeaay!, perubahan berhasil dilakukan', 'success');

        return redirect('setting')->with('msg',$msg);
    }

    public function settingdokter()
    {
        $ad = ads::where('adsid',5)->first();
    	if (Auth::user()->role == 2)
    	{

$editdok = u::where('id',Auth::id())->first();
// if (!is_null($editdok->cityid)) {
// $kotdok = city::where('kotid',$editdok->cityid)->first();
// $adakota = 1;
// }
// else
// {
// $kotdok = '';
// $adakota = 0;
// }
    	return view('user.setting.dokterupload')->with(compact('editdok','adakota','kotdok','ad'));
    	}

    	else
    	{
    		$msg = notify()->flash('Kamu tidak punya akses', 'alert');

        return redirect('setting')->with('msg',$msg);
    	}
    }

    public function settingdoktersave(Request $request)
    {

        if(!(Province::where('id', $request->province)->first())){
            $input = new Province;
            $input->id = $request->province;
            $input->provname = $request->namaprov;
            $input->save();            
        }

        $input = null;

        if(!(City::where('kotid', $request->city)->first())){
            $input = new city;
            $input->kotid = $request->city;
            $input->kotname = $request->namakabu;
            $input->id_province = $request->province;
            $input->save();    
        }

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
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:50000000' // max 10000kb
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
            Image::make($file)->save('/home/hallove1/public_html/image/' . $fileName );
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
      'image' => 'mimes:jpeg,jpg,png,gif|required|max:5000000' // max 10000kb
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
            Image::make($file2)->save('/home/hallove1/public_html/image/' . $fileName2 );
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
        $upost = k::where('konswriter',$id)->paginate(10);
    	$detail = u::where('id',$id)->first();
    	return view('adminx.user.userdetail')->with(compact('detail','upost'));
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
  if($request->file('profile') == "")
        {
            $edited->profilepic = $edited->profilepic;
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

        $msg = notify()->flash('Oh No ! File yang di upload bukanlah gambar, atau ukuran gambar kamu melebihi batas upload', 'alert');

          return redirect()->back()->with('msg',$msg);
    } 
    else
    {
        // Store the File Now
        // read image from temporary file
         $fileName   = time() . '.' .$file->getClientOriginalName();
            Image::make($file)->resize(200, 200)->save('/home/hallove1/public_html/image/' . $fileName );
            $edited->profilepic = "image/".$fileName;
    }
           
        }
        
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
    	$ald = u::where('role',2)->where('verifadmin',1)->paginate(4);
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
        $ad = ads::where('adsid',5)->first();
        $ra = a::paginate(5);
        $cityid = $request->get('kota');
        if(!empty($cityid))
        {
        $alldok = u::join('city','users.cityid','=','city.kotid')->select('users.*','city.*')->where('role',2)->where('cityid',$cityid)->paginate(15);
        $cityname = city::where('kotid',$cityid)->first();
          return view('dokter')->with(compact('alldok','ra','$cityname','ad'));
        }
        else
        {
            
        $alldok = u::where('role',2)->paginate(10);
          return view('dokter')->with(compact('alldok','ra','ad'));
        }
      

    }
    
    public function deletedokters($id)
    {
         if(Auth::user()->role == 3)
{
    	$del = u::where('id', $id)->first();

    	if($del->id == Auth::user()->id)
    	{
    	$msg = notify()->flash('Gagal Dihapus, ada kesalahan', 'alert');
 return redirect()->back()->with(compact('msg'));
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
 return redirect()->back()->with(compact('msg'));
    	}
    }

 $msg = notify()->flash('Berhasil Dihapus', 'success');
 return redirect()->back()->with(compact('msg'));
  }
else
{
  return redirect('dashboard');
}
        
    }
}
