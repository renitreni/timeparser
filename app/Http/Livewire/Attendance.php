<?php

namespace App\Http\Livewire;

use App\Models\Attendance as ModelsAttendance;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Attendance extends DataTableComponent
{
    public int $perPage = 50;

    public function columns(): array
    {
        return [
            Column::make('Person', 'person_id')->sortable(),
            Column::make('Date', 'date_in')->sortable(),
            Column::make('Time In', 'time_in')->sortable(),
            Column::make('Time Out', 'time_out')->sortable(),
            Column::make('Hrs. Work'),
            Column::make('Status'),
        ];
    }

    public function query(): Builder
    {
        return ModelsAttendance::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.attendance';
    }
}
