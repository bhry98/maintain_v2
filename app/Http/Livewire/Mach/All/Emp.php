<?php

namespace App\Http\Livewire\Mach\All;

use App\Traits\MachTrait;
use Livewire\Component;

class Emp extends Component
{
    use MachTrait;
    public $search;
    public $mach;
    public function render()
    {
        $this->mach = $this->GetAllMach();
        return view('livewire.mach.all.emp');
    }
}
