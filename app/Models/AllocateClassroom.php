<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllocateClassroom extends Model
{
    protected $fillable = [
        'department_id',
        'course_id',
        'room_id',
        'day',
        'from',
        'to',
        'status',
    ];
}
