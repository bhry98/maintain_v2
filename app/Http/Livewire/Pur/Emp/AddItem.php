<?php

namespace App\Http\Livewire\Pur\Emp;

use Livewire\Component;

class AddItem extends Component
{
    public $items = [
        ['item', 'q', 'detail']
    ];

    public function render()
    {
        return view('livewire.pur.emp.add-item');
    }

    public function Add()
    {
        array_push($this->items, ['item', 'q', 'detail']);
    }

    public function Remove($index)
    {
        array_splice($this->items, $index, 1);
    }
}
