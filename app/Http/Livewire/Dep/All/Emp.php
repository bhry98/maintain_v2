<?php

namespace App\Http\Livewire\Dep\All;

use App\Models\Org\DepM;
use Livewire\Component;

class Emp extends Component
{
    public $dep;
    public $search = null;

    public function render()
    {
        if ($this->search != null) {
            $this->dep = DepM::where('code', 'LIKE', "%$this->search%")->with('Mang')->get();
        } else {
            $this->dep = DepM::with('Mang')->get();
        }
        return view('livewire.dep.all.emp');
    }
}
