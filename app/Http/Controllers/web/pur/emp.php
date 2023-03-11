<?php

namespace App\Http\Controllers\web\pur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class emp extends Controller
{
    public function ViewAdd()
    {
        $data = [
            // 'ws' => $this->GetSelectTask()->where('workshop_id', '=', $this->EMP_Auth()->workshop_id),
            'task' => $this->GetSelectTask($this->EMP_Auth()->workshop_id),
            // 'ot' => $ot,
        ];
        return view('pur.add.emp', $data);
    }
    public function All()
    {
        return view('pur.all.emp');
    }
    public function Details($id)
    {
        $data = [
            'pur' => $this->GetPurById($id)
        ];
        return view('pur.detail.emp', $data);
    }
    public function Action(Request $request, $pur_id)
    {
        // return $request;
        $by = $this->EMP_Auth();

        $action = $this->AddActionFromEmp($pur_id, $by->id, $request->action);
        if ($action) {
            $this->ViewHent(__("app.Succ.TackAction"), "Success");
            return redirect()->back();
        } else {
            $this->ViewAlert(__("app.Errors.SWW"), "Danger");
            return redirect()->back();
        }
    }
    public function Add(Request $request)
    {
        // return $request;
        $rule = [
            'task' => 'required',
            // 'data' => 'required|min:1',
            'data' => 'required|array|min:1',
        ];
        $request->validate($rule);
        foreach ($request->data as $key => $value) {
            if ($request->data[$key]['item'] == null || $request->data[$key]['q'] == null) {
                $this->ViewAlert(__("app.errors.PurNItem"), "Danger");
                return redirect()->back();
            }
        }
        try {
            $by = $this->EMP_Auth()->id;
            DB::transaction(function () use ($request, $by) {
                $pur_order = $this->AddNewPurOrder($request->task, $by, $request->data, $request->note);
                $taskn = $this->GetTaskById($request->task);
                $taskn->update(['status' => '3']);
                $this->AddHoldTimeForTask($taskn->id, "في انتظار المشتريات ($pur_order->id)");
                $this->AddNewProg(null, $taskn->id, $by, "تم طلب مشتريات خاصة بالعطل ($pur_order->id)");
                $this->SendNewNoti($by, $taskn->main_ok_id, "تم اضافة طلب مشتريات جديد كود ($pur_order->id) ", "Maintain/Pur/$pur_order->id/Details", 0);
                $this->AddSysLog($by, "Add New Pur Order = $pur_order->id");
            });
            $this->ViewHent(__("app.succ.AddPur"), "Success");
            return redirect()->back();
        } catch (\Exception $r) {
            $this->ViewAlert($r->getMessage(), "Danger");
            return redirect()->back();
        }
    }
}
