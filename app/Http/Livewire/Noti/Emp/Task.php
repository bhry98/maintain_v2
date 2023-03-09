<?php

namespace App\Http\Livewire\Noti\Emp;

use App\Traits\TaskTrait;
use Livewire\Component;

class Task extends Component
{
    use TaskTrait;
    public $task;
    public $by;
    public function render()
    {
        $this->by = $this->EMP_Auth();
        $this->task = $this->GetAllTaskForWorkShopByid($this->by->workshop_id, true);
        return view('livewire.noti.emp.task');
    }
}
