<?php

namespace App\Traits;

use App\Models\Pur\PurItemM;
use App\Models\Pur\PurOrderM;
use App\Models\Task\TaskM;

/**
 * 
 */
trait PurTrait
{
    use TaskTrait, NoteTrait;
    public function AddNewPurOrder($task_id, $by, $items = [], $note)
    {

        $pur_order =  PurOrderM::create([
            'task_id' => $task_id,
            'note' => $note,
            'main_ok' => null,
            'main_ok_id' => null,
            'main_ok_time' => null,
            'main_done' => null,
            'main_done_id' => null,
            'main_done_time' => null,
            'created_at' => config('app.date.now'),
            'created_by' => $by,
            'updated_at' => null,
            'updated_by' => null,

        ]);
        foreach ($items as $i) {
            PurItemM::create([
                'order_id' => $pur_order->id,
                'name' => $i['item'],
                // 'type' => $i['type'],
                'q' => $i['q'],
                'note' => $i['detail'],

            ]);
        }
        return $pur_order;
    }
    public function GetAllPurOrder($is_done = false, $is_app_from_main = false, $ForNoti = false)
    {
        if ($is_done) {
            return PurOrderM::where('main_ok', '=', 1)
                ->where('main_done', '=', 1)
                ->with('Items', 'Task', 'CBy')
                ->orderBy('id', 'desc') //asc
                ->get();
        } elseif ($is_app_from_main) {
            return PurOrderM::where('main_ok', '=', 1)
                ->where('main_done', '=', null)
                ->with('Items', 'Task', 'CBy')
                ->orderBy('id', 'desc') //asc
                ->get();
        } else {
            return PurOrderM::with('Items', 'Task', 'CBy')
                ->orderBy('id', 'desc') //asc
                ->get();
        }
    }
    public function GetAllPurOrderByTask($task_id, $is_done = false)
    {
        if ($is_done) {
            return PurOrderM::where('task_id', '=', $task_id)
                ->with('Items', 'Task', 'CBy')
                ->where('main_ok', '=', 1)
                ->where('main_done', '=', 1)
                ->orderBy('id', 'desc') //asc

                ->get();
        } else {
            return PurOrderM::where('task_id', '=', $task_id)
                ->with('Items', 'Task', 'CBy')
                ->orderBy('id', 'desc') //asc

                ->get();
        }
    }
    public function GetAllPurOrderByEmpId($created_at, $is_done = false)
    {
        if ($is_done) {

            return PurOrderM::where('created_at', '=', $created_at)
                ->where('main_ok', '=', 1)
                ->where('main_done', '=', 1)
                ->with('Items', 'Task', 'CBy')
                ->orderBy('id', 'desc') //asc

                ->get();
        } else {
            return PurOrderM::where('created_at', '=', $created_at)
                ->with('Items', 'Task', 'CBy')
                ->orderBy('id', 'desc') //asc

                ->get();
        }
    }
    public function GetPurById($pur_id)
    {
        return PurOrderM::where('id', '=', $pur_id)
            ->with('Items', 'Task',  'CBy')
            ->firstOrFail();
    }
    public function AddActionFromEmp($pur_id, $emp_id, $action,)
    {
        /**
         * 1 = main_ok &main_ok_date
         * 2 = main_done &main_done_date
         */
        $pur = PurOrderM::where('id', '=', $pur_id)
            ->firstOrFail();
        if ($action == 1) {
            $this->SendNewNoti($emp_id, $pur->created_at, __("app.noti.PurMainSend"), route('emp.pur.Details', $pur->id), 0);
            return PurOrderM::where('id', '=', $pur_id)
                ->firstOrFail()
                ->update([
                    'main_ok_id' => $emp_id,
                    'main_ok' => 1,
                    'main_ok_time' => config('app.date.now'),
                ]);
        } else if ($action == 2) {
            // TaskM::where('id', '=', $pur->task_id)->firstOrFail();
            $this->AddNewProg(null, $pur->task_id, $emp_id, "($pur_id) تم احضار المشتريات");
            $this->SendNewNoti($emp_id, $pur->created_at, __("app.noti.PurInStock"), route('emp.pur.Details', $pur->id), 0);
            return PurOrderM::where('id', '=', $pur_id)
                ->firstOrFail()
                ->update([
                    'main_done_id' => $emp_id,
                    'main_done' => 1,
                    'main_done_time' => config('app.date.now'),
                ]);
        } else {
            return;
        }
    }
}
