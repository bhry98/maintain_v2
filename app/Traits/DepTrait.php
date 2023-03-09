<?php

namespace App\Traits;

use App\Models\Org\DepM;

/**
 * 
 */
trait DepTrait
{
    public function AddNewDep($name, $mang_id, $code, $level, $note, $created_by)
    {
        return   DepM::create([
            'name' => $name,
            'mang_id' => $mang_id,
            'code' => $code,
            'level' => $level,
            'note' => $note,
            'created_at' => config('app.date.now'),
            'created_by' => $created_by,
            'updated_at' => null,
            'updated_by' => null,
        ]);
    }
    public function EditDep($id, $name, $mang_id, $code, $level, $note, $created_by)
    {
        return  DepM::where('id', '=', $id)->firstOrFail()->update([
            'name' => $name,
            'mang_id' => $mang_id,
            'code' => $code,
            'level' => $level,
            'note' => $note,
            'updated_at' => config('app.date.now'),
            'updated_by' => $created_by,
        ]);
    }

    public function ChangeManForDep($dep_code, $emp_id, $by)
    {
        return DepM::where('code', $dep_code)->firstOrFail()->update([
            'mang_id' => $emp_id,
            'updated_at' => config('app.date.now'),
            'updated_by' => $by,
        ]);
    }
    // public function GetDepByCliId()
    // {
    //     return DepM::get(['code', 'name', 'id']);
    // }
    public function GetSelectDep()
    {
        return DepM::get(['code', 'name', 'id']);
    }
    public function GetAllDep()
    {
        $dep = DepM::with('Man')->get();
        return $dep;
    }
    public function GetDepByCode($code, $withIssues = false)
    {
        if ($withIssues) {
            $d = DepM::where('code', '=', $code)->with('Issue')->firstOrFail();
        } else {
            $d = DepM::where('code', '=', $code)->firstOrFail();
        }
        return $d;
    }
}
