<?php

namespace App\Http\Livewire\Cli\All;

use App\Models\People\ClientM;
use Livewire\Component;

class Emp extends Component
{
    public $cli;
    public $search = null;

    public function render()
    {
        if ($this->search != null) {
            $this->cli = ClientM::where('code', 'LIKE', "%$this->search%")->with( 'Mang')->get();
        } else {
            $this->cli = ClientM::with( 'Mang')->get();
        }
        return view('livewire.cli.all.emp');
    }
}
