<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class cli extends Controller
{
    public function ViewLogin()
    {
        return view('auth.login.cli');
    }
    public function Login(Request $request)
    {
        //validate
        $validator = validator($request->all(), [
            'username' => 'required|exists:client,username',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('cli.auth.Login')->withErrors($validator->errors());
        }
        //login
        $login = $this->CLI_Login($request->username, $request->password);
        if (!$login) {
            session()->flash('password');
            return redirect()->route('cli.auth.Login');
        }
        //done
        $cli = $this->CLI_Auth();
        if ($cli->active != 1) {
            return redirect()->route('cli.auth.Block');
        } else {
            $this->ViewHent(__("app.Succ.Login"), "Success");
            return redirect()->route('cli.dash');
        }

        // return $request;
    }
    public function Block()
    {
        return view('auth.block');
    }
    public function Logout()
    {
        $this->CLI_Logout();
        return redirect()->route('cli.auth.ViewLogin');
    }
}
