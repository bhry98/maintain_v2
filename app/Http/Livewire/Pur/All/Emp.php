<?php

namespace App\Http\Livewire\Pur\All;

use App\Traits\PurTrait;
use Livewire\Component;

class Emp extends Component
{
    use PurTrait;
    public $pur;
    public function render()
    {
        $this->pur = $this->GetAllPurOrder();
        return view('livewire.pur.all.emp');
    }
}
