<?php

namespace App\Traits;

use App\Models\People\EmpM;
use Illuminate\Support\Facades\Hash;

/**
 * 
 */
trait EmpTrait
{

    public function AddNewEmployee($name, $code, $email, $username, $password, $is_mang, $mang_id, $workshop_id, $role_id, $active, $created_by)
    {
        return EmpM::create([
            'name' => $name,
            'code' => $code,
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password),
            'is_mang' => $is_mang,
            'mang_id' => $mang_id,
            'workshop_id' => $workshop_id,
            'role_id' => $role_id,
            'active' => $active,
            'created_by' => $created_by,
            'created_at' => config('app.date.now'),
            'updated_by' => null,
            'updated_at' => null,
        ]);
    }
    public function EditEmpoyee($id, $name, $code, $email, $username, $password, $is_mang, $mang_id, $workshop_id, $role_id, $active, $updated_by)
    {
        if (is_null($password)) {
            $pass = EmpM::where('id', '=', $id)->firstOrFail()->password;
        } else {
            $pass = Hash::make($password);
        }

        return EmpM::where('id', '=', $id)
            ->firstOrFail()
            ->update([
                'name' => $name,
                'code' => $code,
                'email' => $email,
                'username' => $username,
                'password' => $pass,
                'is_mang' => $is_mang,
                'mang_id' => $mang_id,
                'workshop_id' => $workshop_id,
                'role_id' => $role_id,
                'active' => $active,
                'updated_by' => $updated_by,
                'updated_at' => config('app.date.now'),
            ]);
    }
    public function GetSelectEmployee($is_mang = false)
    {
        if ($is_mang == true) {
            return EmpM::where('is_mang', '=', '1')->get(['id', 'code', 'name']);
        } else {
            return EmpM::get(['id', 'code', 'name']);
        }
    }
    public function GetEmployeeByCode($code)
    {
        return EmpM::where('code', '=', $code)->firstOrFail();
    }
}
