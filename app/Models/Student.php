<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_name',
        'email',
        'contact_no',
        'address',
        'department_id',
    ];
}
