<?php

namespace App\Providers;

use App\User; 
use Carbon\Carbon;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Log;
use Config;
use Request;

class CustomUserProvider implements UserProvider 
{

/**
 * Retrieve a user by their unique identifier.
 *
 * @param  mixed $identifier
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveById($identifier)
{
    //dd("vtc5");
    // TODO: Implement retrieveById() method.
    dd('SALVE', $identifier);


$qry = User::where('usunome',$identifier);

if($qry->count() >0)
{
    //dd($attributes);
    $user = $qry->select('usucod', 'usunome', 'ususenha','avatar','filial','is_medic','medic','is_admin','auth_encaixe')->first();

    $attributes = array(
        'usucod' => $user->usucode,
        'usunome' => $user->usunome,
        'ususenha' => $user->ususenha,
        'avatar'    =>$user->avatar,
        'filial'    =>$user->filial,
        'is_medic'  => $user->is_medic,
        'id_medic'  => $user->medic,  
        'is_admin'      => $user->is_admin,      
        'auth_encaixe'  => $user->auth_encaixe,
    );


    return $user;
}
return null;
}



/**
 * Retrieve a user by by their unique identifier and "remember me" token.
 *
 * @param  mixed $identifier
 * @param  string $token
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveByToken($identifier, $token)
{
    // dd('salve1',$identifier);
    // TODO: Implement retrieveByToken() method.
    $qry = User::where('usucod','=',$identifier);

    if($qry->count() >0)
        DD("FOI");
    {
        $user = $qry->select('usucod', 'usunome', 'ususenha','avatar','filial','is_medic','medic','is_admin','auth_encaixe')->first();

        $attributes = array(
            'usucod' => $user->usucode,
            'usunome' => $user->usunome,
            'ususenha' => $user->ususenha,
            'avatar'    =>$user->avatar,
            'filial'    =>$user->filial,
            'is_medic'  => $user->is_medic,
            'id_medic'  => $user->medic,   
            'is_admin'  => $user->is_admin,
            'auth_encaixe'  => $user->auth_encaixe,  
        );

        return $user;
    }
    return null;



}

/**
 * Update the "remember me" token for the given user in storage.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
 * @param  string $token
 * @return void
 */
public function updateRememberToken(Authenticatable $user, $token)
{
   dd("vtc3");
    // TODO: Implement updateRememberToken() method.
    $user->setRememberToken($token);

    $user->save();

}

/**
 * Retrieve a user by the given credentials.
 *
 * @param  array $credentials
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
public function retrieveByCredentials(array $credentials)
{
    // dd('salve',$credentials);
    $qry = User::where('usunome','=',strtoupper($credentials['usunome']))->where('status','ATIVO');
    // dd($qry);
    if($qry->count() > 0)
    {
        //DD("AEW");
       $user = $qry->select('usucod', 'usunome', 'ususenha','avatar','filial','is_medic','medic','is_admin','auth_encaixe')->first();


        //dd($attributes);

       return $user;
   }

   return null;


}
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


/**
 * Validate a user against the given credentials.
 *
 * @param  \Illuminate\Contracts\Auth\Authenticatable $user
 * @param  array $credentials
 * @return bool
 */
public function validateCredentials(Authenticatable $user, array $credentials)
{
    dd('salve',$credentials);

    //DD($user->usunome);

    //DD($credentials['email']);

    //DD($user->getAuthPassword());
    //DD($this->codif('12345'));

    //if($this->codif($credentials['password']) == $user->getAuthPassword()){
      //  dd("foi");
    //}

    /*if($user->usunome == strtoupper($credentials['email'])){
        dd("foi");
    }*/
    
    if($user->usunome == strtoupper($credentials['usunome']) && $this->codif($credentials['senhausu']) == $user->getAuthPassword())
    {

        $user->save();

        return true;
    }
    return false;


}
}