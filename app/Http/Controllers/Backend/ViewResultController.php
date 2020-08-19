<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Models\Result;
use App\Models\Student;
use App\Models\Department;
use App\Models\EnrollInCourse;


class ViewResultController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('student_reg_no','ASC')->get();

        return view('dashboard.pages.view_result.index',compact('students')); 
    }

    public function show($id)
    {
        $students = Student::orderBy('student_reg_no','ASC')->get();

        $single_student = Student::find($id);

        $department = Department::find($single_student->department_id);
        
        // return $department;



        // $view_courses_result = DB::table('enroll_in_courses')
        //                     ->select('course_code','course_name','grade')
        //                     ->join('courses','enroll_in_courses.course_id','=','courses.id') //show course name & code according to 'enroll_in_courses'
        //                     ->leftJoin('results','enroll_in_courses.id','=','results.enroll_in_courses_id')
        //                     ->where('enroll_in_courses.student_id','=',$id)
        //                     ->get();

        $view_courses_result = DB::table('enroll_in_courses')
                            ->select('course_code','course_name','grade')
                            ->join('courses','enroll_in_courses.course_id','=','courses.id') //show course name & code according to 'enroll_in_courses'
                            ->leftJoin('results','results.enroll_in_courses_id','=','enroll_in_courses.id') //results.enroll_in_courses_id অনুসারে যদি enroll_in_courses এর course_id==0 হইয় তাহলে ডাটা শো করবেনা, 0 না হলে ঐ টেবিলের ডাটা অনুসারে বাকি ডাটা দেখাবে   
                            ->where('enroll_in_courses.student_id','=',$id)
                            ->get();

        // return $view_courses_result;

        return view('dashboard.pages.view_result.index',compact('students','single_student','department','view_courses_result')); 

    }
}
