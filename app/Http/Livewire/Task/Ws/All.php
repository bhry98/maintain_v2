<?php

namespace App\Http\Livewire\Task\Ws;

use App\Models\People\EmpM;
use App\Traits\SysTrait;
use Livewire\Component;

use App\Traits\TaskTrait;
use Illuminate\Support\Facades\DB;

class All extends Component
{
    use TaskTrait, SysTrait;

    public $task;
    public $by;
    public $emp_id_select;
    public $emp = [];

    public function render()
    {

        $this->by = $this->EMP_Auth();
        $this->task = $this->GetAllTaskForWorkShopByid($this->by->workshop_id);
        $this->emp = EmpM::where('workshop_id', '=', $this->by->workshop_id)->get();
        return view('livewire.task.ws.all');
    }

    public function MoveToEmp($_task)
    {
        if ($this->emp_id_select && $_task) {
            DB::transaction(function () use ($_task) {
                $this->GetTaskForMyByEmp($_task, $this->emp_id_select);
                $this->AddNewProg(null, $_task, $this->emp_id_select, __("app.task.prog.AppTaskFromEmp"));
            });

            $this->emp_id_select = null;
        } else {
            $this->ViewAlert(__("app.errors.SWW"), "Danger");
        }
        $this->render();
    }
    public function StartTaskTime($_task, $_emp)
    {
        //, $this->emp_id_select
        if ($_task && $_emp) {
            DB::transaction(function () use ($_task, $_emp) {
                $this->StartTaskById($_task);
                $this->AddNewProg(null, $_task, $_emp, __("app.task.prog.StartTaTime"));
            });
            $this->emp_id_select = null;
        } else {
            $this->ViewAlert(__("app.errors.SWW"), "Danger");
        }
        $this->render();
    }
}
