<?php

namespace App\Http\Livewire\Task\All;

use App\Models\Org\WShopM;
use App\Models\People\EmpM;
use App\Models\Task\TaskM;
use App\Traits\TaskTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Emp extends Component
{
    use TaskTrait;
    public $task;
    public $ws_id_select;
    public $emp_id_select;
    public $by;
    //
    public $ws;
    public $emp;
    public $select_emp;
    public $GetSelectEmp = null;
    public $search = null;

    public function mount()
    {
        $this->by = $this->EMP_Auth();
        $this->ws = WShopM::get(['id', 'name']);
        $this->emp = collect();
    }
    public function render()
    {

        if ($this->search != null) {
            // $this->task = TaskM::where('code', 'LIKE', "%$this->search%")->with('Client', 'Dep', 'Emp')->get();
        } else {
            $this->task = TaskM::with('Client', 'Dep', 'Emp', 'Client', 'WShop')->orderBy('id', 'desc')->get();
        }
        return view('livewire.task.all.emp');
    }
    public function updatedGetSelectEmp($_ws)
    {
        $this->emp = EmpM::where('workshop_id', '=', $_ws)->get(['name', 'id']);
    }
    public function MoveTask($_task)
    {
        if ($this->select_emp == null) {
            DB::transaction(function () use ($_task) {
                $this->MoveTaskToWorkShop($this->by->id, $_task, $this->GetSelectEmp);
                $tt = $this->GetTaskById($_task);
                $this->AddNewProg(null, $_task, $this->by->id, __("app.task.prog.MoveTo") . " ( " . $tt->WShop->name . " )");
                //
                $this->GetSelectEmp = null;
            });
        } else {
            DB::transaction(function () use ($_task) {
                $this->MoveTaskToWorkShop($this->by->id, $_task, $this->GetSelectEmp);
                $tt = $this->GetTaskById($_task);
                $this->AddNewProg(null, $_task, $this->by->id, __("app.task.prog.MoveTo") . " ( " . $tt->WShop->name . " )");

                //
                $this->GetTaskForEmpByMain($_task, $this->select_emp);
                $this->SendNewNoti($this->by->id, $this->select_emp, __("app.noti.MainSendTaskFYou"), route('emp.task.Detail', $_task), 0);
                //
                $this->GetSelectEmp = null;
                $this->select_emp = null;
            });
        }
    }

    // public function MoveTo($_task)
    // {
    // $this->MoveTaskToWorkShop($this->by->id, $_task, $this->ws_id_select);
    //     $tt = $this->GetTaskById($_task);
    //     $this->AddNewProg(null, $_task, $this->by->id, __("app.task.prog.MoveTo") . " ( " . $tt->WShop->name . " )");
    //     $this->ws_id_select = null;
    //     // $this->emp = EmpM::get();
    // }
    // public function MoveToEmp($_task)
    // {
    //     $tt = $this->GetTaskById($_task);
    //     if ($this->emp_id_select && $tt->workshop_id != null && $tt->emp_ok == null) {
    //         DB::transaction(function () use ($_task) {
    //             $this->GetTaskForEmpByMain($_task, $this->emp_id_select);
    //             $this->SendNewNoti($this->by->id, $this->emp_id_select, __("app.noti.MainSendTaskFYou"), route('emp.task.Detail', $_task), 0);
    //         });
    //         // $this->GetTaskForMyByEmp($_task, $this->emp_id_select);
    //     } else {
    //         # code...
    //     }
    // }
}
