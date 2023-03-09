<?php

namespace App\Http\Livewire\Dash;

use App\Traits\TaskTrait;
use Livewire\Component;

class Emp extends Component
{
    use TaskTrait;
    public $last_14_day;
    public $all_task_pie;
    public function render()
    {
        $this->last_14_day = $this->GetTaskByWShopForChartLast2Week();
        $this->all_task_pie = $this->GetTaskByWShopForChart();
        return view('livewire.dash.emp');
    }
}
