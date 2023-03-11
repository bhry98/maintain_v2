<?php

namespace App\Http\Livewire\Modal\Task;

use App\Models\Org\WShopM;
use App\Models\People\EmpM;
use App\Traits\TaskTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Move extends Component
{
    use TaskTrait;
    //
    public $task_;
    public $by;
    public $ws;
    public $emp;
    public $select_emp;
    public $GetSelectEmp = null;
    public function render()
    {
        return view('livewire.modal.task.move');
    }
    public function mount()
    {
        $this->by = $this->EMP_Auth();
        $this->ws = WShopM::get(['id', 'name']);
        $this->emp = collect();
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
}
