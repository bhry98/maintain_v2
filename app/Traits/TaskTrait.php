<?php

namespace App\Traits;

use App\Models\Org\WShopM;
use App\Models\Task\TaskHoldM;
use App\Models\Task\TaskM;
use App\Models\Task\TaskProgM;
use Carbon\Carbon;

/**
 * 
 */
trait TaskTrait
{
    public function GetSelectTask($For_one_workshop = null)
    {
        if ($For_one_workshop && $For_one_workshop != null) {
            return TaskM::where('workshop_id', '=', $For_one_workshop)->get(['id', 'tittle']);
        } else {
            return TaskM::get(['id', 'tittle']);
        }
    }
    public function GetTaskById($id)
    {
        return TaskM::where('id', '=', $id)
            ->with('Dep', 'Client')
            ->firstOrFail();
    }
    public function EndTaskById($task_id, $emp_id, $note)
    {
        TaskProgM::create([
            'task_id' => $task_id,
            'who' => $emp_id,
            'do' => __("app.task.End"),
            'time' => config('app.date.now'),
            'is_client' => null,
        ]);

        return TaskM::where('id', '=', $task_id)
            ->firstOrFail()
            ->update([
                'emp_done_note' => $note,
                'status' => '4',
                'is_close' => 1,
            ]);
    }
    // public function OpenTaskById($task_id, $emp_id, $note)
    // {
    //     TaskProgM::create([
    //         'task_id' => $task_id,
    //         'emp_id' => $emp_id,
    //         'time' => config('app.date.now'),
    //         'stat' => "1",
    //         'note' => $note,
    //     ]);
    //     return TaskM::where('id', '=', $task_id)
    //         ->firstOrFail()
    //         ->update([
    //             'status' => '1',
    //             'is_close' => null,
    //         ]);
    // }
    public function GetAllTask()
    {
        return TaskM::with('Dep', 'Client', 'Emp', 'WShop')
            ->orderBy('id', 'desc') //asc
            ->get();
    }
    public function GetAllTaskForDepByidForCli($array_dep_id)
    {
        foreach ($array_dep_id as $v) {
            $tasks[] =   $this->GetAllTaskForDepByid($v);
        }
        return $tasks;
        // return TaskM::with('WShop', 'Dep', 'Client')
        //     // ->where('dep_id', '=', $dep_id)
        //     ->orderBy('id', 'desc') //asc
        //     ->get();
    }
    public function GetAllTaskForDepByid($dep_id)
    {
        return TaskM::with('WShop', 'Dep', 'Client')
            ->where('dep_id', '=', $dep_id)
            ->orderBy('id', 'desc') //asc
            ->get();
    }
    public function StartTaskById($task_id)
    {
        return TaskM::where('id', '=', $task_id)
            ->firstOrFail()
            ->update([
                'status' => 2,
                'emp_start_time' => config('app.date.now'),
            ]);
    }
    public function GetTaskForEmpByMain($task_id, $emp_id)
    {
        return TaskM::where('id', '=', $task_id)
            ->firstOrFail()
            ->update([
                'emp_id' => $emp_id,
                // 'emp_ok' => 1,
                'status' => 1,
                // 'emp_start_time' => config('app.date.now'),
            ]);
    }
    public function GetTaskForMyByEmp($task_id, $emp_id)
    {
        return TaskM::where('id', '=', $task_id)
            ->firstOrFail()
            ->update([
                'emp_id' => $emp_id,
                'emp_ok' => 1,
                'status' => 2,
                'emp_start_time' => config('app.date.now'),
            ]);
    }
    public function GetAllTaskForWorkShopByid($id, $For_Notifcsion = false)
    {
        if ($For_Notifcsion) {
            return TaskM::with('Dep', 'Client', 'WShop') // 
                ->where('emp_id', '=', null) // لم بتم استلامها من قبل فني
                ->where('emp_ok', '=', null) // لم يتم التأكيد ع استلامها من قبل الفني
                ->where('workshop_id', '=', $id) // الورشة المطلوب استدعاء بياناتها
                ->orderBy('id', 'desc') //asc
                ->get();
        } else {
            return TaskM::with('Dep', 'Client', 'WShop', 'Emp') // 
                ->where('workshop_id', '=', $id) // الورشة المطلوب استدعاء بياناتها
                ->orderBy('id', 'desc') //asc
                ->get();
        }
    }
    public function AddNewTask($dep_id, $client_id, $tittle, $details)
    {
        return  TaskM::create([
            'task_id' => null,
            'mach_id' => null,
            'cli_id' => $client_id,
            'order_time' => config('app.date.now'),
            'tittle' => $tittle,
            'details' => $details,
            'dep_id' => $dep_id,
            'main_ok' => null,
            'main_ok_id' => null,
            'main_ok_time' => null,
            'workshop_id' => null,
            'emp_ok' => null,
            'emp_id' => null,
            'emp_start_time' => null,
            'hold_time' => null,
            'emp_end_time' => null,
            'emp_done' => null,
            'emp_done_note' => null,
            'status' => 1,
            'cli_done' => null,
            'is_close' => null,
        ]);
    }
    public function AddHoldTimeForTask($task_id, $tittle)
    {
        return TaskHoldM::create([
            'task_id' => $task_id,
            'start' => config('app.date.now'),
            'end' => null,
            'why' => $tittle,
        ]);
    }
    public function AddNewHelp($emp_id, $task_id, $workshop_id, $tittle, $details)
    {
        $t = TaskM::where('id', '=', $task_id)->firstOrFail();
        $t->update([
            'hold_time' => '1',
            'status' => '3',
        ]);
        return  TaskM::create([
            'task_id' => $task_id,
            'mach_id' => $t->mach_id,
            'cli_id' => $emp_id,
            'order_time' => config('app.date.now'),
            'tittle' => $tittle,
            'details' => $details,
            'dep_id' => $t->dep_id,
            'main_ok' => 1,
            'main_ok_id' => $emp_id,
            'main_ok_time' => config('app.date.now'),
            'workshop_id' => $workshop_id,
            'emp_ok' => null,
            'emp_id' => null,
            'emp_start_time' => null,
            'hold_time' => null,
            'emp_end_time' => null,
            'emp_done' => null,
            'emp_done_note' => null,
            'status' => 1,
            'cli_done' => null,
            'is_close' => null,
        ]);
    }
    public function AddNewProg($is_client = null, $task_id, $who, $do)
    {

        return TaskProgM::create([
            'task_id' => $task_id,
            'who' => $who,
            'do' => $do,
            'time' => config('app.date.now'),
            'is_client' => $is_client,
        ]);
    }
    public function GetAllProgByTaskid($id)
    {
        return TaskProgM::where('task_id', '=', $id)
            ->orderBy('id', 'desc') //asc
            ->with('Emp', 'Task')->get();
    }
    public function MoveTaskToWorkShop($emp_id, $task_id, $work_shop_id)
    {
        return  TaskM::where('id', '=', $task_id)->firstOrFail()->update([
            'workshop_id' => $work_shop_id,
            'main_ok_id' => $emp_id,
            'main_ok' => '1',
            'main_ok_time' => config('app.date.now'),
        ]);
    }
    public function EndTaskByEmp($task_id, $note)
    {
        return TaskM::where('id', '=', $task_id)
            ->firstOrFail()
            ->update([
                'emp_done' => 1,
                'emp_note' => $note,
                'emp_end_date' => config('app.date.now'),
            ]);
    }
    public function AddFeedBackByClient($task_id, $note)
    {
        return TaskM::where('id', '=', $task_id)
            ->firstOrFail()
            ->update([
                'status' => 4,
                'cli_done' => 1,
                'cli_note' => $note,
                'is_close' => 1,
            ]);
    }
    // charts
    public function GetTaskByWShopForChartLast2Week()
    {
        // return   WShopM::withCount('Tasks AS tasks')->orderBy('id')->get();
        // $last_week = date(config('app.date.format')) - 7;
        return TaskM::where('order_time', '>=', Carbon::now()->subDays(14)->toDateTimeString())->orderBy('order_time')->get();
        /**
         * "ws_name"=>["100","50","50"] // بيانات اخر 14 يوم
         */
    }
    public function GetTaskByWShopForChart()
    {
        return   WShopM::withCount('Tasks AS tasks')->orderBy('id')->get();

        /**
         * "ws_name"=>["100","50","50"] // بيانات اخر 14 يوم
         */
    }
    //filters
    // public function GetAllTaskByDep($dep_id)
    // {
    //     return  TaskM::with('Dep', 'Client', 'Emp', 'WShop')
    //         ->where('dep_id', '=', $dep_id)
    //         ->orderBy('id', 'desc') //asc
    //         ->get();
    // }
    // public function GetAllTaskForWShop($ws_id)
    // {
    //     return  TaskM::with('Dep', 'Client', 'Emp', 'WShop')
    //         ->where('workshop_id', '=', $ws_id)
    //         ->orderBy('id', 'desc') //asc
    //         ->get();
    // }
    // public function GetAllTaskWithOutWShop()
    // {
    //     return  TaskM::with('Dep', 'Client', 'Emp', 'WShop')
    //         ->where('workshop_id', '=', null)
    //         ->orderBy('id', 'desc') //asc
    //         ->get();
    // }
}
