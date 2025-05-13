<?php

namespace App\Http\Livewire\PermissionMatrix;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Editor extends Component
{
    public $role;
    public $permissions = [];
    public $selectedPermissions = [];

    public function mount($roleName)
    {
        $this->role = Role::where('name', $roleName)->firstOrFail();
        $this->permissions = Permission::all()->pluck('name')->toArray();
        $this->selectedPermissions = $this->role->permissions->pluck('name')->toArray();
    }

    public function updatedSelectedPermissions()
    {
        $this->role->syncPermissions($this->selectedPermissions);
        session()->flash('message', 'Permissions updated.');
    }

    public function render()
    {
        return view('livewire.permission-matrix.editor');
    }
}
