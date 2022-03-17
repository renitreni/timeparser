<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use Livewire\Component;

class PermissionEdit extends Component
{
    public $role;
    public $permissions;
    public $selectedPermission;

    /**
     * @param mixed $role 
     * @return void 
     */
    public function mount($role)
    {
        $this->sync($role);
    }

    /**
     * @param mixed $id 
     * @return void 
     */
    public function sync($id)
    {
        $this->role        = Role::query()->where('id', $id)->with(['permissions'])->first();
        $this->permissions = Permission::query()
            ->whereNotIn('id', array_map(fn ($value) => $value['id'], $this->role->permissions->toArray()))
            ->get();
    }

    /**
     * @return View|Factory 
     * @throws BindingResolutionException 
     */
    public function render()
    {
        return view('livewire.permission-edit');
    }

    /**
     * @param mixed $id 
     * @return void 
     */
    public function destroy($id)
    {
        $role       = Role::query()->find($this->role->id);
        $permission = Permission::query()->find($id);
        $role->detachPermission($permission);

        $this->sync($this->role->id);
    }

    /** @return void  */
    public function add()
    {
        $role       = Role::query()->find($this->role->id);
        $permission = Permission::query()->find($this->selectedPermission);
        $role->attachPermission($permission);

        $this->sync($this->role->id);
    }
}
