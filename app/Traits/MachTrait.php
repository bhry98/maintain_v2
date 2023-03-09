<?php

namespace App\Traits;

use App\Models\Org\MachM;

/**
 * 
 */
trait MachTrait
{
    public function GetAllMach()
    {
        return MachM::with('Dep', 'Tasks')->get();
    }
    public function AddNewMach($created_by, $name, $code, $dep_id, $details = null)
    {
        return MachM::create([
            'name' => $name,
            'code' => $code,
            'dep_id' => $dep_id,
            'details' => $details,
            'created_at' => config('app.date.now'),
            'created_by' => $created_by,
            'updated_at' => null,
            'updated_by' => null,
        ]);
    }
}
