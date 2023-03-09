<?php

namespace App\Http\Controllers\web\task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class cli extends Controller
{
    public function ViewAdd()
    {
        $dep = $this->GetSelectDep();
        $cli = $this->CLI_Auth();
        foreach ($cli->dep_id as $keyc => $valuec) {
            foreach ($dep as $keyd => $valued) {
                if ($valued->id == $valuec) {
                    $select[] = $valued;
                }
            }
        }
        // dd($select);
        $data = [
            'dep' => $select,
        ];
        return view('task.add.cli', $data);
    }
    public function All()
    {
        return view('task.all.cli');
    }

    public function Details($id)
    {
        $data = [
            'task' => $this->GetTaskById($id),
        ];
        return view('task.detail.cli', $data);
    }
    public function Add(Request $request)
    {
        $rule = [
            'tittle' => 'required|max:30',
            'dep' => 'required',
            'detail' => 'required|min:10',
        ];
        $request->validate($rule);
        try {
            $by = $this->CLI_Auth();
            DB::transaction(function () use ($request, $by) {
                $task = $this->AddNewTask(
                    $request->dep,
                    $by->id,
                    $request->tittle,
                    $request->detail,
                );
                $this->AddNewProg(1, $task->id, $by->id, __("app.task.prog.AddNewT"));
            });
            $this->AddSysLog($by, "Add New Task = $request->code");
            $this->ViewHent(__("app.succ.AddTask"), "Success");
            return redirect()->back();
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
    // public function AddProg(Request $request, $id)
    // {
    //     $rule = [
    //         'stat' => 'required',
    //         'note' => 'required',
    //     ];
    //     $request->validate($rule);
    //     try {
    //         $by = $this->CLIEMP_Auth()->id;
    //         DB::transaction(function () use ($id, $request, $by) {
    //             $this->AddNewProg($id, $request->stat, $by, $request->note);
    //         });
    //         $this->AddSysLog($by, "Add New Task Prog = $request->id");
    //         $this->ViewHent(__("app.Succ.AddTaskProg"), "Success");
    //         return redirect()->back();
    //     } catch (\Exception $th) {
    //         $this->ViewAlert($th->getMessage(), "Danger");
    //         return redirect()->back();
    //     }
    // }
}
