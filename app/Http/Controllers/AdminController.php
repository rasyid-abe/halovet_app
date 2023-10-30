<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as u;
use Auth;
use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Hash;

class AdminController extends Controller
{
    public function access()
    {
    	if (Auth::check()) {
    		if(Auth::user()->role == 3)
    		{
                return view('adminx.index');

    		}
    		else
    		{
    			return redirect('/');
    		}
    	}
    	else {
    		return redirect('adminix/login');
    	}
    }

    
}
