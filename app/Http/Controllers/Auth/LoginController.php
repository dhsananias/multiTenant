<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // public function login(Request $request)
    // {

    //     $usuario = User::where('usunome', $request->username)->first();
    //     // dd($usuario);
    //     if (sizeof($usuario) > 0) {

    //         $senhaHasheada = $this->codif(strtoupper($request->password));
    //         $senhaDoUsuario = $usuario->ususenha;
    //         // dd($senhaDoUsuario, $senhaHasheada);
    //         if ($senhaDoUsuario == $senhaHasheada) {
                
    //             $credentials = ['usunome' => $usuario->usunome, 'ususenha' => $usuario->ususenha];
    //             dd(Auth::loginUsingId($usuario->status, true));
    //             if (Auth::loginUsingId($usuario->usucod, true)) {
    //                 dd('lOGADO');
    //                 return redirect($this->redirectTo);
    //             } 
    //             return redirect($this->redirectTo);
    //         } else {
    //             return '/login';
    //         }

    //     } else {
    //         return '/login';
    //     }

    // }

    public function codif($string) {
        $var = "";
        for ($n = 0; $n < strlen($string); $n++) {
            $var .= chr(ord(substr($string, $n, 1)) - 20);
        }
        return strrev($var);
    }
    
    public function decodif($string) {
        $var = "";
        for ($n = 0; $n < strlen($string); $n++) {
            $var .= chr(ord(substr($string, $n, 1)) + 20);
        }
        return strrev($var);
    }
    

}
