<?php

namespace App\Http\Livewire\Task\All;

use App\Models\Task\TaskM;
use App\Traits\TaskTrait;
use Livewire\Component;

class Cli extends Component
{
    use TaskTrait;

    public $task;
    public $search = null;
    public $by;
    public function render()
    {
        //
        $tas = $this->GetAllTask();
        $cli = $this->CLI_Auth();
        foreach ($cli->dep_id as $v) {
            foreach ($tas as $vt) {
                if ($v == $vt->dep_id) {
                    $task[] = $vt;
                }
            }
        }
        //
        $this->by = $this->CLI_Auth();
        if ($this->search != null) {
            // $this->task = TaskM::where('code', 'LIKE', "%$this->search%")->with('Client', 'Dep', 'Emp')->get();
        } else {
            $this->task = $task;
            // $this->task = $this->GetAllTaskForDepByid($this->by->id);
        }
        return view('livewire.task.all.cli');
    }
}
