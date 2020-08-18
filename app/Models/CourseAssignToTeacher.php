<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseAssignToTeacher extends Model
{
    protected $fillable = [
        'department_id',
        'teacher_id',
        'course_id',
        'credit_took',
    ];
}
