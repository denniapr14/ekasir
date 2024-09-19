<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class C_Login extends Controller
{


    public $user;

    function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        // $userData = $this->user->firstUser(
        //     [
        //         'usernameUser' => "admin"
        //     ]
        // );
        // dd($userData);
        return view('welcome');
    }
    //
    function loginAction(Request $request)
    {
        $userData = $this->user->firstUser(
            [
                'usernameUser' => $request->username,
                'passworduser' => md5($request->password)
            ]
        );
        // dd($request->password);
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::guard('web')
        ->attempt(['usernameUser' => $request->username, 'password' => md5($request->password)],
        $request->get('remember'))){
            Session::put('user', $userData->id_user);


            return redirect()->route('dashboard')
            ->with('success','Berhasil Login');


        }else{
            return redirect()->route('login')
            ->with('danger','sandi salah atau tidak ada');
        }


    }
    public function Logout()
    {
        Session::flush('web');

        return redirect('/')->with('success', "You're sign out!");
    }
}
