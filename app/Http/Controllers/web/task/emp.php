<?php

namespace App\Http\Controllers\web\task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd($ot = null)
    {

        $data = [
            'ws' => $this->GetSelectWorkShop()->where('id', '!=', $this->EMP_Auth()->workshop_id),
            'task' => $this->GetSelectTask($this->EMP_Auth()->workshop_id),
            'ot' => $ot,
        ];
        return view('task.add.emp', $data);
    }
    public function All()
    {
        return view('task.all.emp');
    }
    public function AllMyWsTask()
    {
        return view('task.ws.emp');
    }
    public function EndByEmp(Request $request)
    {
        // return $request;
        $by = $this->EMP_Auth();
        if ($request->task && $request->note) {
            DB::transaction(function () use ($request, $by) {
                $t = $this->GetTaskById($request->task);
                $this->EndTaskByEmp($request->task, $request->note);
                $this->SendNewNoti($by->id, $t->cli_id, "تم انهاء الطلب برجاء التقييم", route('cli.task.Details', $request->task), 1);
            });
            $this->AddSysLog($by->id, "End Task By My = $request->task");
            $this->ViewHent(__("app.succ.EndTask"), "Success");
            return redirect()->back();
        } else {
            $this->ViewAlert(__("app.errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
    public function End(Request $request)
    {
        if ($request->task && $request->note) {
            $tas = $this->GetTaskById($request->task);
            if (is_null($tas->workshop_id)) {
                $this->ViewAlert(__("app.errors.TaskWShopNull"), "Danger");
                return redirect()->back();
            } else {
                $by = $this->EMP_Auth();
                DB::transaction(function () use ($request, $by) {
                    $this->EndTaskById(
                        $request->task,
                        $by->id,
                        "تم غلق الطلب بواسطة (" . $by->name . ")"
                    );
                    $task = $this->GetTaskById($request->task);
                    // $this->SendNewNoti($this->EMP_Auth()->id, $task->client_id, "تم انهاء الطلب", "تم انهاء الطلب كود ($task->id) بنجاح", 1);
                });
                $this->AddSysLog($by, "End Task = $request->task");
                $this->ViewHent(__("app.succ.EndTask"), "Success");
                return redirect()->back();
            }
        } else {
            $this->ViewAlert(__("app.errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
    // public function Open($id)
    // {
    //     if ($id) {
    //         // $tas = $this->GetTaskById($id);
    //         $by = $this->EMP_Auth();
    //         DB::transaction(function () use ($id, $by) {
    //             $this->OpenTaskById(
    //                 $id,
    //                 $by->id,
    //                 "تم فتح الطلب بواسطة (" . $by->name['ar'] . ")"
    //             );
    //         });
    //         $this->AddSysLog($by, "Open Task = $id");
    //         $this->ViewHent(__("app.Succ.OpenTask"), "Success");
    //         return redirect()->back();
    //     } else {
    //         $this->ViewAlert(__("app.Errors.SWW"), "Danger");
    //         return redirect()->back();
    //     }
    // }
    public function MoveToWS(Request $request)
    {
        if ($request->task && $request->ws) {
            $by = $this->EMP_Auth();
            $tas =   $this->MoveTaskToWorkShop($by->id, $request->task, $request->ws);
            if ($tas) {
                $this->AddNewProg(null, $request->task, $by->id, __("app.task.prog.MoveTo"));
                return redirect()->back();
            } else {
                $this->ViewAlert(__("app.Errddddors.SWW"), "Danger");
                return redirect()->back();
            }
        } else {
            $this->ViewAlert(__("app.Errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
    public function AppToMy(Request $request)
    {
        if ($request->task) {
            $by = $this->EMP_Auth();
            $tas =   $this->GetTaskForMyByEmp($request->task, $by->id);
            if ($tas) {
                $this->AddNewProg(null, $request->task, $by->id, __("app.task.prog.StartTaTime"));
                return redirect()->back();
            } else {
                $this->ViewAlert(__("app.Errddddors.SWW"), "Danger");
                return redirect()->back();
            }
        } else {
            $this->ViewAlert(__("app.Errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
    public function AppToEmp(Request $request)
    {
        if ($request->task && $request->emp_take) {
            // $by = $this->EMP_Auth();
            $tas =   $this->GetTaskForMyByEmp($request->task, $request->emp_take);
            if ($tas) {
                $this->AddNewProg(null, $request->task, $request->emp_take, __("app.task.prog.AppToEmp"));
                return redirect()->back();
            } else {
                $this->ViewAlert(__("app.Errddddors.SWW"), "Danger");
                return redirect()->back();
            }
        } else {
            $this->ViewAlert(__("app.errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
    public function Details($id)
    {
        $data = [ //'id' =>$id,//@livewire('task.detail.emp', ['task_code' => $id])

            'ws' => $this->GetSelectWorkShop(),
            'task' => $this->GetTaskById($id),
        ];
        return view('task.detail.emp', $data);
    }
    public function Add(Request $request)
    {
        // return $request;
        $rule = [
            'task' => 'required',
            'tittle' => 'required',
            'ws' => 'required',
            'detail' => 'required|min:10',
        ];
        $request->validate($rule);

        try {
            $TT = $this->GetTaskById($request->task);
            foreach ($TT->HoldTime as  $v) {
                if ($v->end == null) {
                    $this->ViewAlert(__("app.task.prog.IsHoldNow"), "Danger");
                    return redirect()->back();
                }
            }
            // date()
            $by = $this->EMP_Auth();
            DB::transaction(function () use ($request, $by) {
                $new_task =  $this->AddNewHelp($by->id, $request->task, $request->ws, $request->tittle, $request->detail);
                $this->AddHoldTimeForTask($request->task, $request->tittle);
                $this->AddNewProg(false, $request->task, $by->id, __("app.task.prog.HelpFromWs"));
                $this->AddNewProg(false, $new_task->id, $by->id, __("app.task.prog.AddNewT"));
            });
            $this->AddSysLog($by->id, "Add New Help For Task = $request->task");
            $this->ViewHent(__("app.succ.AddTask"), "Success");
            return redirect()->back();
        } catch (\Error $th) {
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
    //         $by = $this->EMP_Auth()->id;
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
