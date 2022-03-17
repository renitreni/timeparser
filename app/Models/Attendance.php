<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/** @package App\Models */
class Attendance extends Model
{
    use HasFactory;

    public $fillable = ['person_id', 'date_in', 'time_in', 'date_out', 'time_out', 'filename'];
}
