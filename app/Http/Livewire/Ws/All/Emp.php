<?php

namespace App\Http\Livewire\Ws\All;

use App\Models\Org\WShopM;
use Livewire\Component;

class Emp extends Component
{
    public $ws;
    public $search = null;

    public function render()
    {
        if ($this->search != null) {
            $this->ws = WShopM::where('name', "%$this->search%")->with('Mang')->withCount('Emps AS Emps')->get();
        } else {
            $this->ws = WShopM::with('Mang')->withCount('Emps AS Emps')->get();
        }
        return view('livewire.ws.all.emp');
    }
}
