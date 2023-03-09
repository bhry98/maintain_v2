<?php

namespace App\Http\Controllers\web\cli;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd()
    {
        $data = [
            'dep' => $this->GetSelectDep(),
            'cli' => $this->GetSelectCli(true),
            'role' => $this->GetSelectRole(),
        ];
        return view('cli.add.emp', $data);
    }
    // public function ViewEdit($code)
    // {
    //     $data = [
    //         'clie' => $this->GetCliByCode($code),
    //         'dep' => $this->GetSelectDep(),
    //         'cli' => $this->GetSelectCli(true),
    //         'role' => $this->GetSelectRole(),
    //     ];
    //     return view('Emp::client.edit', $data);
    // }
    public function All()
    {
        return view('cli.all.emp');
    }
    // public function Edit(Request $request, $code)
    // {
    //     $cli = $this->GetCliByCode($code);
    //     $rule = [
    //         'name.ar' => 'required',
    //         'dep' => 'required|min:1',
    //         'emp' => 'required',
    //         'code' => 'required|regex:/^\S*$/u|unique:client,code,' . $cli->id,
    //         'email' => 'required',
    //         'username' => 'required|unique:client,username,' . $cli->id,
    //         'password' => 'nullable|min:8|max:16',
    //     ];
    //     $request->validate($rule);
    //     // return $request;
    //     //add to database
    //     try {
    //         $by = $this->EMP_Auth()->id;
    //         DB::transaction(function () use ($request, $by, $cli) {
    //             $this->EditClient(
    //                 $cli->id,
    //                 $request->dep, //
    //                 $request->emp, //
    //                 $request->is_mang, //
    //                 $request->code, //
    //                 $request->name, //
    //                 $request->email, //
    //                 $request->username, //
    //                 $request->password, //
    //                 $request->role, //
    //                 $request->active, //
    //                 $by,
    //             );
    //         });
    //         $this->AddSysLog($by, "Edit Client code = $request->code");
    //         $this->ViewHent(__("app.Succ.EditClient"), "Success");
    //         return redirect()->route('emp.cli.ViewEdit', $request->code);
    //     } catch (\Exception $th) {
    //         $this->ViewAlert($th->getMessage(), "Danger");
    //         return redirect()->back();
    //     }
    // }
    public function Add(Request $request)
    {
        $rule = [
            'name' => 'required',
            'dep' => 'required|min:1',
            'emp' => 'required',
            'code' => 'required|regex:/^\S*$/u|unique:client,code',
            'email' => 'required|email:rfc,dns',
            'username' => 'required|unique:client,username',
            'password' => 'required|min:8|max:16',
        ];
        $request->validate($rule);
        // return $request;

        //add to database
        try {
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $this->AddNewClient(
                    $request->dep, //
                    $request->emp, //
                    $request->is_mang, //
                    $request->code, //
                    $request->name, //
                    $request->email, //
                    $request->username, //
                    $request->password, //
                    $request->role, //
                    $request->active, //
                    $by->id,
                );
            });
            $this->AddSysLog($by->id, "Add New Client code = $request->code");
            $this->ViewHent(__("app.succ.AddClient"), "Success");
            return redirect()->back();
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
}
