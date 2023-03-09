<?php

namespace App\Http\Livewire\Emp\All;

use App\Models\People\EmpM;
use Livewire\Component;

class Emp extends Component
{
    public $emp;
    public $search = null;

    public function render()
    {
        if ($this->search != null) {
            $this->emp = EmpM::where('code', 'LIKE', "%$this->search%")->with('WShop', 'Mang')->get();
        } else {
            $this->emp = EmpM::with('WShop', 'Mang')->get();
        }
        return view('livewire.emp.all.emp');
    }
}
