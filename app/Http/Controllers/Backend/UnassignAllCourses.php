<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Models\CourseAssignToTeacher;
use App\Models\EnrollInCourse;

class UnassignAllCourses extends Controller
{
    public function create()
    {
        return view('dashboard.pages.unassign_courses.create'); 
    }

    

    public function unassign_course()
    {

        // ===== Course Unassign To Teacher Start =========
        $course_assign_teacher = CourseAssignToTeacher::where('course_id','!=',0)->get();

        foreach ($course_assign_teacher as $item) {
            
            $data = CourseAssignToTeacher::find($item->id);

            $data->unassigned_course_id = $item->course_id;
            $data->update();
        }

        DB::table('course_assign_to_teachers')
              ->update([
                  'course_id'  => 0,
                  'credit_took'=> 0
                ]);
        // ===== Course Unassign To Teacher End =========



        // ===== Course Unassign In 'Student Enroll Course' Start =========


        $enroll_in_course = EnrollInCourse::where('course_id','!=',0)->get();

        foreach ($enroll_in_course as $item) {
            
            $data = EnrollInCourse::find($item->id);

            $data->unassigned_course_id = $item->course_id;
            $data->update();
        }

        DB::table('enroll_in_courses')
              ->update(['course_id'  => 0]);


        session()->flash('message','All courses unassigned for teachers & students successfully');
        return redirect()->back();
    }
}
