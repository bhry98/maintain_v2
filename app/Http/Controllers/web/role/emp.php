<?php

namespace App\Http\Controllers\web\role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class emp extends Controller
{
    public function ViewAdd()
    {
        return view('role.add.emp');
    }
    public function ViewEdit($code)
    {
        $date = [
            'role' => $this->GetRoleByCode($code)
        ];
        return view('role.edit.emp', $date);
    }
    public function All()
    {
        return view('role.all.emp');
    }
    public function Detail($code)
    {
        $date = [
            'role' => $this->GetRoleByCode($code),
        ];
        return view('role.detail.emp', $date);
    }
    public function Add(Request $request)
    {

        $rule = [
            'name.ar' => 'required',
            'code' => 'required|unique:role,code',
            'role' => 'required|array|min:1',
        ];
        $request->validate($rule);

        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $role = $this->AddNewRole(
                    $request->name,
                    $request->code,
                    $request->role,
                    $by->id,
                    $request->note,
                );
                $this->AddSysLog($by->id, "Add New Role = $role->id");
            });
            $this->ViewHent(__("app.succ.AddRole"), "Success");
            return redirect()->back();
        } catch (\Exception $r) {
            $this->ViewAlert($r->getMessage(), "Danger");
            return redirect()->back();
        }
    }
    public function Edit(Request $request, $code)
    {
        // return $request;
        $r = $this->GetRoleByCode($code);
        $rule = [
            'name.ar' => 'required',
            'code' => 'required|unique:role,code,' . $r->id,
            'role' => 'required|array|min:1',
        ];
        $request->validate($rule);
        try {
            $by = $this->EMP_Auth();    
            DB::transaction(function () use ($r, $request, $by) {
                $role = $this->EditRole(
                    $r->id,
                    $request->name,
                    $request->code,
                    $request->role,
                    $by->id,
                    $request->note,
                );
                $this->AddSysLog($by->id, "Edit Role = $role->id");
            });
            $this->ViewHent(__("app.succ.EditRole"), "Success");
            return redirect()->back();
        } catch (\Exception $r) {
            $this->ViewAlert($r->getMessage(), "Danger");
            return redirect()->back();
        }
    }
    public function ViewChengRoleCli()
    {
        $data = [
            'role' => $this->GetSelectRole(),
            'cli' => $this->GetSelectCli(),
        ];
        return view('role.edit.edit-cli', $data);
    }
    public function ViewChengRoleEmp()
    {
        $data = [
            'role' => $this->GetSelectRole(),
            'emp' => $this->GetSelectEmployee(),
        ];
        return view('role.edit.edit-emp', $data);
    }
    public function ChengRole(Request $request)
    {
        $rule = [
            'type' => 'required',
            'emp' => 'required',
            'role' => 'required',
        ];
        $request->validate($rule);
        if ($request->type == 'emp') {
            try {
                $by = $this->EMP_Auth()->id;

                DB::transaction(function () use ($request, $by) {
                    $this->ChRoleForEmp($request->role, $request->emp);
                });
                $this->AddSysLog($by, "Edit Role For Emp code_emp=$request->emp &id_role= $request->role");
                $this->ViewHent(__("app.succ.EditRole"), "Success");
                return redirect()->back();
            } catch (\Exception $e) {
                $this->ViewAlert($e->getMessage(), "Danger");
                return redirect()->back();
            }
        } elseif ($request->type == 'cli') {
            try {
                $by = $this->EMP_Auth()->id;
                DB::transaction(function () use ($request, $by) {
                    $this->ChRoleForCli($request->role, $request->emp);
                });
                $this->AddSysLog($by, "Edit Role For Client code_client=$request->emp &id_role= $request->role");
                $this->ViewHent(__("app.succ.EditRole"), "Success");
                return redirect()->back();
            } catch (\Exception $e) {
                $this->ViewAlert($e->getMessage(), "Danger");
                return redirect()->back();
            }
        } else {
            $this->ViewAlert(__("app.Errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
}
