<?php

namespace App\Traits;

use App\Models\Org\PurOrderM;
use App\Models\Org\TaskM;
use App\Models\People\EmpM;

/**
 * 
 */
trait ReportTrait
{
    public function GetReportForEmpWork($emp_id, $from_date = null, $to_date = null)
    {
        if ($from_date && $to_date) {
            $data['emp'] = EmpM::where('id', '=', $emp_id)->with('WShop', 'Man:name')->firstOrFail();
            $data['task'] = TaskM::whereBetween('order_time', [$from_date, $to_date])->where('emp_id', '=', $emp_id)->get();
        } else {
            $data['emp'] = EmpM::where('id', '=', $emp_id)->with('WShop', 'Man:name')->firstOrFail();
            $data['task'] = TaskM::where('emp_id', '=', $emp_id)->get();
        }
        return $data;
    }
    public function GetReportForAllTask($ws, $dep, $from_id = null, $to_id = null, $from_date = null, $to_date = null)
    {
        if ($ws == 'all' && $dep == 'all') {
            if ($from_date && $to_date && $from_id && $to_id) {
                return TaskM::whereBetween('order_time', [$from_date, $to_date])
                    ->whereBetween('id', [$from_id, $to_id])
                    ->get();
            } elseif ($from_date && $to_date) {
                return TaskM::whereBetween('order_time', [$from_date, $to_date])
                    ->get();
            } elseif ($from_id && $to_id) {
                return TaskM::whereBetween('id', [$from_id, $to_id])
                    ->get();
            } else {
                return TaskM::get();
            }
        } elseif ($ws == 'no_ws' && $dep == 'all') {
            if ($from_date && $to_date && $from_id && $to_id) {
                return TaskM::whereBetween('order_time', [$from_date, $to_date])
                    ->whereBetween('id', [$from_id, $to_id])
                    ->where('workshop_id', '=', null)
                    ->get();
            } elseif ($from_date && $to_date) {
                return TaskM::whereBetween('order_time', [$from_date, $to_date])
                    ->where('workshop_id', '=', null)
                    ->get();
            } elseif ($from_id && $to_id) {
                return TaskM::whereBetween('id', [$from_date, $to_date])
                    ->where('workshop_id', '=', null)
                    ->get();
            } else {
                return TaskM::where('workshop_id', '=', null)->get();
            }
        } elseif ($ws != 'no_ws' && $ws != 'all' && $dep == 'all') {
            if ($from_date && $to_date && $from_id && $to_id) {
                return TaskM::where('workshop_id', '=', $ws)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->whereBetween('id', [$from_id, $to_id])
                    ->get();
            } elseif ($from_date && $to_date) {
                return TaskM::where('workshop_id', '=', $ws)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->get();
            } elseif ($from_id && $to_id) {
                return TaskM::where('workshop_id', '=', $ws)
                    ->whereBetween('id', [$from_date, $to_date])
                    ->get();
            } else {
                return TaskM::where('workshop_id', '=', $ws)->get();
            }
        } elseif ($ws == 'all' && $dep != 'all') {
            if ($from_date && $to_date && $from_id && $to_id) {
                return TaskM::where('dep_id', '=', $dep)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->whereBetween('id', [$from_id, $to_id])
                    ->get();
            } elseif ($from_date && $to_date) {
                return TaskM::where('dep_id', '=', $dep)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->get();
            } elseif ($from_id && $to_id) {
                return TaskM::where('dep_id', '=', $dep)
                    ->whereBetween('id', [$from_date, $to_date])
                    ->get();
            } else {
                return TaskM::where('dep_id', '=', $dep)->get();
            }
        } elseif ($ws == 'no_ws' && $dep != 'all') {
            if ($from_date && $to_date && $from_id && $to_id) {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', null)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->whereBetween('id', [$from_id, $to_id])
                    ->get();
            } elseif ($from_date && $to_date) {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', null)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->get();
            } elseif ($from_id && $to_id) {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', null)
                    ->whereBetween('id', [$from_date, $to_date])
                    ->get();
            } else {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', null)->get();
            }
        } elseif ($ws != 'no_ws' && $ws != 'all' && $dep != 'all') {
            if ($from_date && $to_date && $from_id && $to_id) {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', $ws)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->whereBetween('id', [$from_id, $to_id])
                    ->get();
            } elseif ($from_date && $to_date) {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', $ws)
                    ->whereBetween('order_time', [$from_date, $to_date])
                    ->get();
            } elseif ($from_id && $to_id) {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', $ws)
                    ->whereBetween('id', [$from_date, $to_date])
                    ->get();
            } else {
                return TaskM::where('dep_id', '=', $dep)
                    ->where('workshop_id', '=', $ws)->get();
            }
        } else {
            return TaskM::get();
        }
    }
    public function GetPurOrderById($pur_order)
    {
        return PurOrderM::where('id', '=', $pur_order)
            ->with('Items', 'Task', 'Emp', 'CBy')
            ->firstOrFail();
    }
}
