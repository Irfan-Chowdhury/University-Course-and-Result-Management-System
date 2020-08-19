<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewCourseStaticsController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('dashboard.pages.view_course_statics.index',compact('departments')); 
    }

    public function show(Request $request)
    {
        $departments = Department::all();

        $data = DB::table('courses')
                    ->select('course_code','course_name','semester_name','teacher_name')
                    ->join('semesters','courses.semester_id','=','semesters.id')
                    ->leftJoin('course_assign_to_teachers','course_assign_to_teachers.course_id','=','courses.id')
                    ->leftJoin('teachers','course_assign_to_teachers.teacher_id','=','teachers.id')
                    ->where('courses.department_id',$request->department_id)
                    ->get();

        // return $data;

        return view('dashboard.pages.view_course_statics.index',compact('departments','data')); 
        
    }
}
