<?php

namespace App\Http\Livewire\Role;

use App\Models\Sys\RoleM;
use Livewire\Component;

class All extends Component
{
    public $roles;
    public $search = null;
    public function render()
    {
        if ($this->search != null) {
            $this->roles = RoleM::where('code', $this->search)->withCount('Emps AS Emps')->get();
        } else {
            $this->roles = $this->GetAllRole();
        }

        return view('livewire.role.all');
    }
}
