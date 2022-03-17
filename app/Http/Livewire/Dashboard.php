<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
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
            $value = str_replace("\t1\t0\t1\t0", "\ttimein", $value);
            $value = str_replace("\t1\t1\t1\t0", "\ttimeout", $value);
            if ($value != "") {
                $finalRows[] = preg_split("/\t/", trim($value, ' '));
            }
        }

        foreach ($finalRows as $key => $value) {
            $datetime = preg_split('/\s/', $value[1]);
            if ($value[2] == 'timein') {
                Attendance::query()->create(
                    [
                        'filename' => $path,
                        'person_id' => $value[0],
                        'date_in' => $datetime[0],
                        'time_in' => $datetime[1]
                    ],
                );
            } else if ($value[2] == 'timeout') {
                Attendance::query()->updateOrCreate(
                    ['person_id' => $value[0], 'date_in' => $datetime[0]],
                    [
                        'date_out' => $datetime[0],
                        'time_out' => $datetime[1]
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
