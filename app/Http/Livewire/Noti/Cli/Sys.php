<?php

namespace App\Http\Livewire\Noti\Cli;

use App\Traits\NoteTrait;
use Livewire\Component;

class Sys extends Component
{
    use NoteTrait; 
    public $noti;
    public $by;
    public function render()
    {
        $this->by = $this->CLI_Auth();
        $this->noti = $this->GetAllNotiForCliByShow($this->by->id);
        return view('livewire.noti.cli.sys');
    }
    public function Show($_noti_id)
    {
        $this->SetShowByNotiId($_noti_id);
    }
}
