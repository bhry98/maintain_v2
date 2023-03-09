<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

/**
 * 
 */
trait AuthTrait
{
    /////////////// EMP ////////////////

    public function EMP_Auth()
    {
        return Auth::guard('emp')->user();
    }
    public function EMP_Login($username, $password)
    {
        $this->CLI_Logout();
        return Auth::guard('emp')->attempt([
            'username' => $username,
            'password' => $password
        ]);
    }
    public function EMP_Logout()
    {
        return Auth::guard('emp')->logout();
    }
    /////////////// Client ////////////////

    public function CLI_Auth()
    {
        return Auth::guard('cli')->user();
    }
    public function CLI_Login($username, $password)
    {
        // $this->DR_Logout();
        $this->EMP_Logout();
        return Auth::guard('cli')->attempt([
            'username' => $username,
            'password' => $password
        ]);
    }
    public function CLI_Logout()
    {
        return Auth::guard('cli')->logout();
    }
}
