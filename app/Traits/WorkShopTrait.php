<?php

namespace App\Traits;

use App\Models\Org\WShopM;

/**
 *  
 */
trait WorkShopTrait
{
    public function GetSelectWorkShop()
    {
        return WShopM::get(['id', 'name']);
    }
    public function ChangeManForWorkShop($ws_id, $by, $emp_id)
    {
        return  WShopM::where('id', '=', $ws_id)->firstOrFail()->update([
            'mang_id' => $emp_id,
            'updated_at' => config('app.date.now'),
            'updated_by' => $by,
        ]);
    }

    public function GetAllWorkShop($WithEmp = false, $WithTask = false)
    {
        if ($WithEmp == true) {
            return WShopM::with('Emps', 'Mang')->get();
        } elseif ($WithTask == true) {
            return WShopM::with('Mang', 'Task')->withCount('TaskDone', 'Task')->get();
        } else {
            return WShopM::with('Mang')->get();
        }
    }

    public function GetWorkShopById($id)
    {
        return WShopM::where('id', '=', $id)->firstOrFail();
    }
    public function AddNewWorkShop($by, $name, $mang_id, $note)
    {
        return WShopM::create([
            'name' => $name,
            'mang_id' => $mang_id,
            'note' => $note,
            'created_at' => config('app.date.now'),
            'created_by' => $by,
            'updated_at' => null,
            'updated_by' => null,
        ]);
    }
    public function EditWorkShop($id, $by, $name, $mang_id, $note)
    {
        return WShopM::where('id', '=', $id)->firstOrFail()->update([
            'name' => $name,
            'mang_id' => $mang_id,
            'note' => $note,
            'updated_at' => config('app.date.now'),
            'updated_by' => $by,
        ]);
    }
}
