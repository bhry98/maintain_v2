<?php

namespace App\Http\Controllers\web\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class emp extends Controller
{
    public function ViewLogin()
    {
        return view('auth.login.emp');
    }
    public function Login(Request $request)
    {
        //validate
        $validator = validator($request->all(), [
            'username' => 'required|exists:emp,username',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('emp.auth.Login')->withErrors($validator->errors());
        }
        //login
        // app();

        $login = $this->EMP_Login($request->username, $request->password);
        if (!$login) {
            session()->flash('password');
            return redirect()->route('emp.auth.Login');
        }
        //done
        $emp = $this->EMP_Auth();
        if ($emp->active != 1) {
            return redirect()->route('emp.auth.Block');
        } else {
            $this->ViewHent(__("app.Succ.Login"), "Success");
            return redirect()->route('emp.dash');
        }

        // return $request;
    }

    public function Block()
    {
        return view('auth.block');
    }
    public function Logout()
    {
        $this->EMP_Logout();
        return redirect()->route('emp.auth.ViewLogin');
    }
}
