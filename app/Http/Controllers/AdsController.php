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
use App\Ads as ads;

class AdsController extends Controller
{
    public function adindex()
    {
        if(Auth::user()->role == 3)
        {
        $ed = ads::where('adsid',5)->first();
        return view('adminx.ads.index')->with(compact('ed'));
        }
        else
        {
            return redirect('dashboard');
        }
    }
    
    public function adset(Request $request)
    {
        $ds = ads::where('adsid',5)->first();
        $ds->universalsidebar = $request->universalsidebar;
        $ds->universalfooter = $request->universalfooter;
        $ds->usersidebar = $request->usersidebar;
        $ds->afterarticle = $request->afterarticle;
        
        if(Auth::user()->role == 3)
        {
       
        try
        {
        $ds->update();    
        }
        catch (\Illuminate\Database\QueryException $e) 
        {
            
     $msg = notify()->flash('Oh No! ads tersebut gagal diubah', 'alert');
     return $e;
        }
          $msg = notify()->flash('Berhasil! ads berhasil diubah', 'success');
        return redirect()->back()->with(compact('msg'));
        }
        else
        {
            return redirect('dashboard');
        }
        
    }
    
    
}
