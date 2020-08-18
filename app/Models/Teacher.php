<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'teacher_name',
        'address',
        'email',
        'contact_no',
        'designation',
        'department_id',
        'credit_to_be_taken',
    ];
}
