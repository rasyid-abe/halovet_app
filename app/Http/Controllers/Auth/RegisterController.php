<?php

namespace App\Repositories;
namespace App\Http\Controllers\Auth;

use DB;
use Mail;
use App\City;
use App\User;
use Validator;
use App\Province;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Notify;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if ($data['role'] == 1) {
            return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(10),
            'nohp' => $data['nohp'],
            'alamat' => $data['alamat'],
            'role' => $data['role'],


        ]);
        }
        else {
            return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(10),
            'nohp' => $data['nohp'],
            'alamat' => $data['alamat'],
            'role' => $data['role'],
            'tahunlulus' => $data['tahunlulus'],
            'lulusan' => $data['lulusan'],
            'pengalaman' => $data['pengalaman'],
            'cityid' => $data['city'],            
        ]);

        

        }
        
    }

    public function register(Request $request)
{
    // Laravel validation
    $validator = $this->validator($request->all())->validate();
    
    // Using database transactions is useful here because stuff happening is actually a transaction
    // I don't know what I said in the last line! Weird!
    DB::beginTransaction();
    try
    {
        $user = $this->create($request->all());
        // After creating the user send an email with the random token generated in the create method above
        $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->name]));
        Mail::to($user->email)->send($email);
        DB::commit();
        $msg = notify()->flash('Sukses', 'success', ['timer' => 5000,'text' => 'Silahkan cek email anda untuk konfirmasi agar dapat login']);
         return redirect('login')->with('msg',$msg);
    }
    catch(Exception $e)
    {
        DB::rollback(); 
        $msg = notify()->flash('Gagal', 'error', ['timer' => 5000,'text' => 'Maaf ! gagal untuk daftar. silahkan hubungi admin']);
        return redirect('login')->with('msg',$msg);
    }
}

public function verify($token)
{
    // The verified method has been added to the user model and chained here
    // for better readability
    User::where('email_token',$token)->firstOrFail()->verified();
    return redirect('login');
}

}
