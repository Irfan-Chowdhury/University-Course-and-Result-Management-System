<?php

namespace App\Http\Controllers\Backend;

use App\Models\Course;
use App\Models\Student;
use App\Models\EnrollInCourse;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class EnrollInCourseController extends Controller
{
    public function create()
    {
        $students = Student::orderBy('student_reg_no','ASC')->get();

        return view('dashboard.pages.enroll_in_course.create',compact('students')); 
    }


    public function studentWiseInfo(Request $request)
    {
        $studentDetails = DB::table('students')
                    ->where('students.id',$request->student_id)
                    // ->where('students.id',2)
                    ->join('departments','students.department_id','=','departments.id')
                    ->first();

        // return $studentDetails;
        $courses =  Course::where('courses.department_id',$studentDetails->department_id)->get(); 
        
        // return $courses;
    

        return view('dashboard.pages.enroll_in_course.student-wise-info',compact('studentDetails','courses'));
    }


    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'student_id'   => 'required',
            'course_id'    => 'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $check = EnrollInCourse::where('student_id',$request->student_id)
                                ->where('course_id',$request->course_id)
                                ->exists();
        if ($check) {
            
            session()->flash('error_message','Course has already been taken');
            return redirect()->back();
        }

        $enroll_course = new EnrollInCourse();
        $enroll_course->student_id = $request->student_id;
        $enroll_course->course_id  = $request->course_id;
        $enroll_course->save();

        session()->flash('type','success');
        session()->flash('message','Course Enrolled Successfully');
        
        return redirect()->back();
    }
}
