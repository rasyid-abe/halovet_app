<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sidebar as si;

class SidebarController extends Controller
{
	public function sidebaradmin()
	{
		$as = si::paginate(25);
		return view('adminx.sidebar.index')->with(compact('as'));
	}

    public function newside()
    {
    	return view('adminx.sidebar.new');
    }

    public function saveside(Request $request)
    {
    	$ns = new si;
    	$ns->sidebarname = $request->sidebarname;
    	$ns->sideisi = $request->sideisi;
    	$ns->sidelocation = $request->sidelocation;

    	try {
        $ns->save();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No ! halaman tersebut gagal diterbitkan', 'warning');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil ! sidebar sudah dibuat', 'success');
     return redirect('adminix/sidebar')->with('msg', $msg);
    }

    public function sidebaredit($id)
    {
    	$es = si::where('sideid',$id)->first();
    	return view('adminx.sidebar.edit')->with(compact('es'));
    }

    public function updatesidebar(Request $request)
    {
    	$us = si::where('sideid',$request->sideid)->first();
    	$ns->sidebarname = $request->sidebarname;
    	$ns->sideisi = $request->sideisi;
    	$ns->sidelocation = $request->sidelocation;

    	try {
        $ns->update();
      		}
            catch (\Illuminate\Database\QueryException $e) 
            {
        $msg = notify()->flash('Oh No ! halaman tersebut gagal diterbitkan', 'warning');
     return $e;
    		}

        
       $msg = notify()->flash('Berhasil ! sidebar sudah diubah', 'success');
     return redirect('adminix/sidebar')->with('msg', $msg);
    }

    public function detailside($id)
    {
    	$ds = si::where('sideid',$id)->first();

    	return view('adminx.sidebar.detail')->with(compact('ds'));
    }
}
