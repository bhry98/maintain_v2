<?php

namespace App\Http\Livewire\Task\Detail;

use App\Traits\TaskTrait;
use Livewire\Component;

class LiveTime extends Component
{
    use TaskTrait;
    // public $ws;
    public $task_code;
    public $task;
    //  $data = [
    //     'ws' => $this->GetSelectWorkShop(),
    //     'task' => $this->GetTaskById($id),
    // ];
    public function mount()
    {
        $this->task = $this->GetTaskById($this->task_code);
    }
    public function render()
    {
        return view('livewire.task.detail.live-time');
    }
}
