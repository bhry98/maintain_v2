<?php

namespace App\Http\Controllers\web\mach;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd()
    {
        $data = [
            'dep' => $this->GetSelectDep(),
        ];
        return view('mach.add.emp', $data);
    }
    public function ViewEdit($code)
    {
        $data = [
            'mach' => $this->GetMachByCode($code),
            'dep' => $this->GetSelectDep(),
        ];
        return view('mach.edit.emp', $data);
    }
    public function All()
    {
        return view('mach.all.emp');
    }
    // public function Details($id)
    // {
    //     $data = [
    //         'pur' => $this->GetPurById($id)
    //     ];
    //     return view('pur.detail.emp', $data);
    // }

    public function Add(Request $request)
    {
        // return $request;
        $rule = [
            'name' => 'required',
            'code' => 'required|regex:/^\S*$/u|unique:mach,code',
            'dep' => 'required',
            // 'note' => 'required',
        ];
        $request->validate($rule);
        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $new_mach = $this->AddNewMach($by->id, $request->name, $request->code, $request->dep, $request->note);
                $by->mang_id == null ? $mang = $by->id : $mang = $by->mang_id;
                $this->SendNewNoti($by->id, $mang, "تم اضافة ماكينة جديدة  ($new_mach->name) ", "Maintain/Machine/$new_mach->id/Details", 0);
                $this->AddSysLog($by->id, "Add New Mach = $new_mach->id");
            });
            $this->ViewHent(__("app.succ.AddMach"), "Success");
            return redirect()->back();
        } catch (\Exception $r) {
            $this->ViewAlert($r->getMessage(), "Danger");
            return redirect()->back();
        }
    }
    public function Edit(Request $request, $code)
    {
        // return $request;
        $mach = $this->GetMachByCode($code);

        $rule = [
            'name' => 'required',
            'code' => 'required|regex:/^\S*$/u|unique:mach,code,' . $mach->id,
            'dep' => 'required',
            // 'note' => 'required',
        ];
        $request->validate($rule);
        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by, $mach) {
                $this->EditMach($mach->id, $by->id, $request->name, $request->code, $request->dep, $request->note);
                // $by->mang_id == null ? $mang = $by->id : $mang = $by->mang_id;
                // $this->SendNewNoti($by->id, $mang, "تم اضافة  جديدة  ($new_mach->name) ", "Maintain/Machine/$new_mach->id/Details", 0);
                $this->AddSysLog($by->id, "Edit Mach = $mach->id");
            });
            $this->ViewHent(__("app.succ.EditMach"), "Success");
            return redirect()->back();
        } catch (\Exception $r) {
            $this->ViewAlert($r->getMessage(), "Danger");
            return redirect()->back();
        }
    }
}
