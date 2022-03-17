<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use jeremykenedy\LaravelRoles\Models\Role;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class RoleDataTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Role::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.role_data_table';
    }
}
