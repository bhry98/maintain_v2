<?php

namespace App\Http\Controllers\web\ws;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd()
    {
        $data = [
            'emp' => $this->GetSelectEmployee(true),
        ];
        return view('ws.add.emp', $data);
    }
    // public function ViewChengMang()
    // {
    //     $data = [
    //         'dep' => $this->GetSelectWorkShop(),
    //         'emp' => $this->GetSelectEmp(true),
    //     ];
    //     return view('Emp::wshop.edit-emp', $data);
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
    //             $this->ChangeManForWorkShop(
    //                 $request->dep,
    //                 $request->mang,
    //             );
    //         });
    //         $this->AddSysLog($by, "Edit Work Shop Mang id = $request->dep");
    //         $this->ViewHent(__("app.Succ.EditMang"), "Success");
    //         return redirect()->back();
    //     } catch (\Exception $th) {
    //         $this->ViewAlert($th->getMessage(), "Danger");
    //         return redirect()->back();
    //     }
    // }
    // public function ViewEdit($code)
    // {
    //     $data = [
    //         'ws' => $this->GetWorkShopByCode($code),
    //         'emp' => $this->GetSelectEmp(true),
    //     ];
    //     return view('Emp::wshop.edit', $data);
    // }
    public function All()
    {
        return view('ws.all.emp');
    }
    // public function Edit(Request $request, $code)
    // {
    //     // return $request;
    //     $ws = $this->GetWorkShopByCode($code);
    //     // return $request;
    //     $rule = [
    //         'name.ar' => 'required',
    //         'code' => 'required|regex:/^\S*$/u|unique:work_shop,code,' . $ws->id,
    //         'mang' => 'required',
    //     ];
    //     $request->validate($rule);
    //     //add to database
    //     try {
    //         $by = $this->EMP_Auth()->id;
    //         DB::transaction(function () use ($request, $ws) {
    //             $this->EditWorkShop($ws->id, $request->name, $request->code, $request->mang, $request->note);
    //         });
    //         $this->AddSysLog($by, "Edit Work Shop code = $request->code");
    //         $this->ViewHent(__("app.Succ.EditWShop"), "Success");
    //         return redirect()->route('emp.ws.ViewEdit', $request->code);
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
            'mang' => 'required',
        ];
        $request->validate($rule);
        //add to database
        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $ws =  $this->AddNewWorkShop($by->id, $request->name, $request->mang, $request->note);
                $this->AddSysLog($by, "Add New Work Shop code = $ws->id");
            });
            $this->ViewHent(__("app.succ.AddWShop"), "Success");
            return redirect()->back();
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
    // public function AllTask()
    // {
    //     return view('Emp::task.all-for-ws');
    // }
}
