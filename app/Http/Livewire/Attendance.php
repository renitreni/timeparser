<?php

namespace App\Http\Livewire;

use App\Models\Attendance as ModelsAttendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class Attendance extends DataTableComponent
{
    public int $perPage = 50;

    public int $currentRowId;

    public string $currentPerson;

    public $currentTimeIn;

    public $currentTimeOut;

    public function columns(): array
    {
        return [
            Column::make('Person', 'person_id')->sortable(),
            Column::make('Name', 'person')->sortable(),
            Column::make('Date', 'base_date')->sortable(),
            Column::make('Time In', 'time_in')->sortable(),
            Column::make('Time Out', 'time_out')->sortable(),
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

    public function setToEdit($id)
    {
        $this->currentRowId = $id;

        $result = ModelsAttendance::find($this->currentRowId);

        $this->currentPerson  = $result->person;
        $this->currentTimeIn  = $result->time_in;
        $this->currentTimeOut = $result->time_out;
    }

    public function setToSave($id)
    {
        ModelsAttendance::query()->where('id', $id)
            ->update([
                'person'   => $this->currentPerson,
                'time_in'  => Carbon::parse($this->currentTimeIn)->format('H:i:s'),
                'time_out' => Carbon::parse($this->currentTimeOut)->format('H:i:s'),
            ]);

        $this->emit('refreshDatatable');
        $this->currentRowId = 0;
    }

    public function setToDelete($id)
    {
        ModelsAttendance::destroy($id);
        $this->currentRowId = 0;
    }
}
