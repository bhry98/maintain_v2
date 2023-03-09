<?php

namespace App\Http\Livewire\Noti\Emp;

use App\Traits\NoteTrait;
use Livewire\Component;

class Sys extends Component
{
    use NoteTrait;
    public $noti;
    public $by;
    public function render()
    {
        $this->by = $this->EMP_Auth();
        $this->noti = $this->GetAllNotiForEmpByShow($this->by->id);
        return view('livewire.noti.emp.sys');
    }

    public function Show($_noti_id)
    {
        $this->SetShowByNotiId($_noti_id);
    }
}
