<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Dashboard extends Component
{
    use WithFileUploads;

    public $timesheet;
    public $iteration;

    /**
     * @return void
     * @throws Throwable
     * @throws ValidationException
     * @throws FileNotFoundException
     */
    public function save()
    {
        $finalRows = [];
        $this->validate([
            'timesheet' => 'required|file|max:1024', // 1MB Max
        ]);

        $path = $this->timesheet->store('timesheets');
        $rows = preg_split("/\r\n/", Storage::get($path));
        Storage::delete($path);
        foreach ($rows as $value) {
            // replace string
            $row = str_replace(", ", "_", $value);
            // data conversion
            $data = preg_split("/,/", trim($row, ' '));

            // exclude empty rows and header of file
            if ($row != "" && ! str_contains($row, 'sTime')) {
                // get date only column
                $data[5] = Carbon::parse($data[2])->format('Y-m-d');
                // get time only column
                $data[6] = Carbon::parse($data[2])->format('H:i:s');

                //insert valid and filtered row
                $finalRows[] = $data;
            }
        }
        // $finalRows array Format
        //    0 => "79"
        //    1 => "79"
        //    2 => "3/20/2022 5:30 PM"
        //    3 => "Fingerpint"
        //    4 => "2"
        //    5 => "2022-03-20"
        //    6 => "17:30:00"
        Attendance::query()->truncate();
        foreach ($finalRows as $value) {
            if (Attendance::query()->where('person_id', $value[0])->whereNull('time_in')->count() == 0) {

                Attendance::query()->updateOrCreate(
                    ['person_id' => $value[0], 'base_date' => $value[5]],
                    [
                        'person'   => $value[1],
                        'filename' => $path,
                        'time_in'  => $value[6],
                    ],
                );
            } else {
                dump('haha');
                Attendance::query()
                    ->where('person_id', $value[0])
                    ->whereNotNull('time_in')->update(
                        [
                            'time_out' => $value[6],
                        ],
                    );
            }
        }

        $this->timesheet = null;
        $this->iteration++;
        $this->emit('refreshDatatable');
    }

    /**
     * @return View|Factory
     * @throws BindingResolutionException
     */
    public function render()
    {
        return view('livewire.dashboard');
    }


    /**
     * @return void
     * @throws InvalidArgumentException
     */
    public function destroyAll()
    {
        Attendance::query()->delete();
        $this->emit('refreshDatatable');
    }
}
