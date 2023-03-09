<?php

namespace App\Http\Livewire\Task\All;

use App\Models\Org\WShopM;
use App\Models\People\EmpM;
use App\Models\Task\TaskM;
use App\Traits\TaskTrait;
use Livewire\Component;

class Emp extends Component
{
    use TaskTrait;
    public $task;
    public $ws_id_select;
    public $emp_id_select;
    public $ws;
    public $emp = [];
    public $search = null;

    public function render()
    {
        $this->ws = WShopM::get(['id', 'name']);
        $this->emp = EmpM::get();
        if ($this->search != null) {
            // $this->task = TaskM::where('code', 'LIKE', "%$this->search%")->with('Client', 'Dep', 'Emp')->get();
        } else {
            $this->task = TaskM::with('Client', 'Dep', 'Emp', 'Client', 'WShop')->orderBy('id', 'desc')->get();
        }
        return view('livewire.task.all.emp');
    }

    public function MoveTo($_task)
    {
        $by = $this->EMP_Auth();
        $this->MoveTaskToWorkShop($by->id, $_task, $this->ws_id_select);
        $tt = $this->GetTaskById($_task);
        $this->AddNewProg(null, $_task, $by->id, __("app.task.prog.MoveTo") . " ( " . $tt->WShop->name . " )");
        $this->ws_id_select = null;
        // $this->emp = EmpM::get();
    }
    public function MoveToEmp($_task)
    {
        $tt = $this->GetTaskById($_task);
        if ($this->emp_id_select && $tt->workshop_id != null && $tt->emp_ok == null) {
            $this->GetTaskForEmpByMain($_task, $this->emp_id_select);
            $this->SendNewNoti($by->id,$this->emp_id_select,);
            // $this->GetTaskForMyByEmp($_task, $this->emp_id_select);
        } else {
            # code...
        }
    }
}
