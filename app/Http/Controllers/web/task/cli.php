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
    public function AddRate(Request $request)
    {
        // return $request;
        $rule = [
            'task' => 'required',
            'rate' => 'required|min:1|max:5',
            'emp' => 'required',
        ];
        $request->validate($rule);
        try {
            $by = $this->CLI_Auth();
            DB::transaction(function () use ($request, $by) {
                $this->AddRateForTaskByClient($request->emp, $request->task, $request->rate, $request->note, $by->id);
                $this->AddNewProg(1, $request->task, $by->id, __("app.task.prog.AddRate"));
            });
            $this->AddSysLog($by, "Add Rate For Task = $request->task");
            $this->ViewHent(__("app.succ.AddRate"), "Success");
            return redirect()->back();
        } catch (\Exception $th) {
            $this->ViewAlert($th->getMessage(), "Danger");
            return redirect()->back();
        }
    }
}
