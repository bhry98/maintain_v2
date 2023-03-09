<?php

namespace App\Traits;

use App\Models\People\ClientM;
use App\Models\People\EmpM;
use App\Models\Sys\RoleM;

trait RoleTrait
{
    public function GetSelectRole()
    {
        return RoleM::get(['id', 'name', 'code']);
    }
    public function GetRoleByCode($code)
    {
        return RoleM::where('code', '=', $code)->withCount('Emps AS Emps')->firstOrFail();
    }
    public function GetAllRole()
    {
        return RoleM::withCount('Emps AS Emps')->get();
    }
    public function AddNewRole(
        $name,
        $code,
        $roles,
        $created_by,
        $note,
    ) {
        return    RoleM::create([
            'name' =>  $name,
            'code' =>  $code,
            'permission' =>  $roles,
            'note' =>  $note,
            'created_at' => config('app.date.now'),
            'created_by' =>  $created_by,
            'updated_at' => null,
            'updated_by' => null,
        ]);
    }
    public function EditRole(
        $id,
        $name,
        $code,
        $roles,
        $updated_by,
        $note,
    ) {
        RoleM::find($id)->update([
            'name' =>  $name,
            'code' =>  $code,
            'permission' =>  $roles,
            'note' =>  $note,
            'updated_at' => config('app.date.now'),
            'updated_by' =>  $updated_by,
        ]);
        return RoleM::where('id', '=', $id)->firstOrFail();
    }
    public function ChRoleForEmp($role_id, $emp_code)
    {
        return EmpM::where('code', '=', $emp_code)->firstOrFail()->update([
            'role_id' => $role_id
        ]);
    }
    public function ChRoleForCli($role_id, $cli_code)
    {
        return ClientM::where('code', '=', $cli_code)->firstOrFail()->update([
            'role_id' => $role_id
        ]);
    }
}
