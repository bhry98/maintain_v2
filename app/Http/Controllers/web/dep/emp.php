<?php

namespace App\Http\Controllers\web\dep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd()
    {
        $data = [
            'emp' => $this->GetSelectCli(true),
        ];
        return view('dep.add.emp', $data);
    }
    // public function ViewChengMang()
    // {
    //     $data = [
    //         'dep' => $this->GetSelectDep(),
    //         'emp' => $this->GetSelectCli(true),
    //     ];
    //     return view('dep.edit-emp', $data);
    // }
    // public function ChengMang(Request $request)
    // {
    //     $rule = [
    //         'mang' => 'required',
    //         'dep' => 'required',
    //     ];
    //     $request->validate($rule);
    //     // return $request;
    //     try {
    //         $by = $this->EMP_Auth()->id;
    //         DB::transaction(function () use ($request, $by) {
    //             $this->ChangeManForDep(
    //                 $request->dep,
    //                 $request->mang,
    //                 $by,
    //             );
    //         });
    //         $this->AddSysLog($by, "Edit Dep Mang id = $request->code");
    //         $this->ViewHent(__("app.Succ.EditMang"), "Success");
    //         return redirect()->back();
    //     } catch (\Exception $th) {
    //         $this->ViewAlert($th->getMessage(), "Danger");
    //         return redirect()->back();
    //     }
    // }
    public function ViewEdit($code)
    {
        $data = [
            'dep' => $this->GetDepByCode($code),
            'emp' => $this->GetSelectCli(true),
        ];
        return view('dep.edit.emp', $data);
    }
    public function All()
    {
        return view('dep.all.emp');
    }
    public function Edit(Request $request, $code)
    {
        // return $request;
        $dep = $this->GetDepByCode($code);
        $rule = [
            'name' => 'required',
            'code' => 'required|regex:/^\S*$/u|unique:dep,code,' . $dep->id,
            'mang' => 'required',
            'level' => 'required|numeric|min:0|max:5',
        ];
        $request->validate($rule);
        //add to database
        try {
            $by = $this->EMP_Auth()->id;
            DB::transaction(function () use ($request, $by, $dep) {
                $this->EditDep(
                    $dep->id,
                    $request->name,
                    $request->mang,
                    $request->code,
                    $request->level,
                    $request->note,
                    $by,
                );
            });
            $this->AddSysLog($by, "Edit dep code = $request->code");
            $this->ViewHent(__("app.succ.EditDep"), "Success");
            return redirect()->route('emp.dep.ViewEdit', $request->code);
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
    public function Add(Request $request)
    {
        // return $request;
        $rule = [
            'name' => 'required',
            'code' => 'required|regex:/^\S*$/u|unique:dep,code',
            'mang' => 'required',
            'level' => 'required|numeric|min:0|max:5',
        ];
        $request->validate($rule);
        //add to database
        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $this->AddNewdep(
                    $request->name,
                    $request->mang,
                    $request->code,
                    $request->level,
                    $request->note,
                    $by->id,
                );
            });
            $this->AddSysLog($by->id, "Add New dep code = $request->code");
            $this->ViewHent(__("app.succ.AddDep"), "Success");
            return redirect()->back();
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
}
