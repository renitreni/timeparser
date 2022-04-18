<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** @package App\Models */
class Attendance extends Model
{
    use HasFactory;

    public $fillable = ['person_id','person', 'base_date', 'time_in', 'time_out', 'filename'];
}
