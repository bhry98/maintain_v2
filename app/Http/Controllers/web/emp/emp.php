<?php

namespace App\Http\Controllers\web\emp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd()
    {
        $data = [
            'ws' => $this->GetSelectWorkShop(),
            'man' => $this->GetSelectEmployee(true),
            'role' => $this->GetSelectRole(),
        ];
        return view('emp.add.emp', $data);
    }
    // public function ViewEdit($code)
    // {
    //     $data = [
    //         'emp' => $this->GetEmpByCode($code),
    //         'ws' => $this->GetSelectWorkShop(),
    //         'man' => $this->GetSelectEmp(true),
    //         'role' => $this->GetSelectRole(),
    //     ];
    //     return view('Emp::emp.edit', $data);
    // }
    public function All()
    {
        return view('emp.all.emp');
    }
    // public function Edit(Request $request, $code)
    // {
    //     $emp = $this->GetEmpByCode($code);
    //     // return $request;
    //     $rule = [
    //         'name.ar' => 'required',
    //         'dep' => 'required',
    //         'emp' => 'required',
    //         'code' => 'required|regex:/^\S*$/u|unique:emp,code,' . $emp->id,
    //         'email' => 'required',
    //         'username' => 'required|unique:emp,username,' . $emp->id,
    //         'password' => 'nullable|min:8|max:16',
    //     ];
    //     $request->validate($rule);
    //     // return $request;

    //     //add to database
    //     try {
    //         $by = $this->EMP_Auth()->id;
    //         DB::transaction(function () use ($request, $by, $emp) {
    //             $this->EditEmp(
    //                 $emp->id,
    //                 $request->is_mang,
    //                 $request->dep,
    //                 $request->emp,
    //                 $request->code,
    //                 $request->name,
    //                 $request->email,
    //                 $request->username,
    //                 $request->password,
    //                 $request->role,
    //                 $request->active,
    //                 $by,
    //             );
    //         });
    //         $this->AddSysLog($by, "Edit Employee code = $request->code");
    //         $this->ViewHent(__("app.Succ.EditEmp"), "Success");
    //         return redirect()->route('emp.emp.Edit', $request->code);
    //     } catch (\Exception $th) {
    //         $this->ViewAlert($th->getMessage(), "Danger");
    //         return redirect()->back();
    //     }
    // }
    public function Add(Request $request)
    {
        // return $request;
        $rule = [
            'name' => 'required',
            'dep' => 'required',
            'emp' => 'required',
            'code' => 'required|regex:/^\S*$/u|unique:emp,code',
            'email' => 'required',
            'username' => 'required|unique:emp,username|min:4|max:16',
            'password' => 'required|min:8|max:16',
        ];
        $request->validate($rule);
        // return $request;

        //add to database
        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $this->AddNewEmployee(
                    $request->name,
                    $request->code,
                    $request->email,
                    $request->username,
                    $request->password,
                    $request->is_mang,
                    $request->emp,
                    $request->dep,
                    $request->role,
                    $request->active,
                    $by->id
                );
                $this->AddSysLog($by->id, "Add New Employee code = $request->code");
            });
            $this->ViewHent(__("app.succ.AddEmp"), "Success");
            return redirect()->back();
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
}
