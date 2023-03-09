<?php

namespace App\Traits;

use App\Models\People\ClientM;
use Illuminate\Support\Facades\Hash;

/**
 * 
 */
trait ClientTrait
{
    function EditClient($id, $dep_id, $mang_id, $is_mang, $code, $name, $email, $username, $password, $role_id, $active, $updated_by)
    {
        if (is_null($password)) {
            $pass = ClientM::where('id', '=', $id)->firstOrFail()->password;
        } else {
            $pass = Hash::make($password);
        }
        return ClientM::where('id', '=', $id)->firstOrFail()->update([
            'name' => $name,
            'is_mang' => $is_mang,
            'mang_id' => $mang_id,
            'dep_id' => $dep_id,
            'username' => $username,
            'email' => $email,
            'password' => $pass,
            'code' => $code,
            'role_id' => $role_id,
            'active' => $active,
            'updated_at' => config('app.date.now'),
            'updated_by' => $updated_by,
        ]);
    }
    function AddNewClient($dep_id, $mang_id, $is_mang, $code, $name, $email, $username, $password, $role_id, $active, $created_by)
    {
        return ClientM::create([
            'name' => $name,
            'is_mang' => $is_mang,
            'mang_id' => $mang_id,
            'dep_id' => $dep_id,
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'code' => $code,
            'role_id' => $role_id,
            'active' => $active,
            'created_at' => config('app.date.now'),
            'created_by' => $created_by,
            'updated_at' => null,
            'updated_by' => null,
        ]);
    }
    public function GetAllCliMan()
    {
        return ClientM::where('is_mang', '=', 1)->get();
    }
    public function GetCliByCode($code)
    {
        return ClientM::where('code', '=', $code)->firstOrFail();
    }
    public function GetCliMangByCliCode($code)
    {
        // return
    }
    public function GetSelectCli($isMang = false)
    {
        if ($isMang == true) {
            return ClientM::where('is_mang', '=', 1)->get(['code', 'name', 'id']);
        } else {
            return ClientM::get(['code', 'name', 'id']);
        }
    }
    public function GetAllClient()
    {
        $cli = ClientM::get();
        return $cli;
    }
}
