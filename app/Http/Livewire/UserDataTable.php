<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserDataTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Action"),
        ];
    }

    public function query(): Builder
    {
        return User::query()->with(['roles']);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_data_table';
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
