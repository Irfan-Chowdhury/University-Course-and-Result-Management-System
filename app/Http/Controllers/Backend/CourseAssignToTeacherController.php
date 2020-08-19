<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use DB;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\CourseAssignToTeacher;


class CourseAssignToTeacherController extends Controller
{
    public function create()
    {
        $departments = Department::all();

        return view('dashboard.pages.course_assign_to_teacher.create',compact('departments'));
    }

    public function departmentWiseTeacherList(Request $request)
    {
        if ($request->ajax()) //this way is better
        {
            $teachers = Teacher::where('department_id',$request->department_id)
                                ->get();

            return view('dashboard.pages.course_assign_to_teacher.department-wise-teacher-list',compact('teachers'));
        }
    }

    public function teacherWiseCreditAndCourseInfo(Request $request)
    {
        if ($request->ajax()) 
        {
            $teacher = Teacher::where('id',$request->teacher_id)
                                ->where('department_id',$request->department_id)
                                ->first();

            $credit_took = DB::table('course_assign_to_teachers')
                                ->where('teacher_id',$request->teacher_id)
                                ->sum('credit_took');
            
            $remaining_credit = $teacher->credit_to_be_taken - $credit_took;

            // return $remaining_credit;

            $courses = Course::where('department_id',$request->department_id)->get();

            return view('dashboard.pages.course_assign_to_teacher.teacher-wise-credit_and_course-info',compact('teacher','remaining_credit','courses'));
        }
    }
    
    
    public function courseNameAndCreditInfo(Request $request)
    {
        $course = Course::where('id',$request->course_id)->first();

        return view('dashboard.pages.course_assign_to_teacher.course-name_and_credit-info',compact('course'));
    }


    //this alert not working properly
    // public function creditCheckForAlert(Request $request)
    // {
    //     $credit_took = DB::table('course_assign_to_teachers')
    //                             ->where('teacher_id',$request->teacher_id)
    //                             ->sum('credit_took');
        
    //     $course = Course::where('id',$request->course_id)->first();
    //     $now_total = $credit_took + $course->credit;

    //     $teacher = Teacher::where('id',$request->teacher_id)->first();

    //     if ($now_total >= $teacher->credit_to_be_taken) {

    //         return response()->json($now_total);
    //     }
    //     else 
    //     {
    //         return redirect()->route('course_assign_to_teacher.store');
    //     }
    // }


            //======== Alert Message Script but it's not working Please use it in (create.blade.php)======
    
    //--- Script Start
    
    // <script>
        //this alert not working properly
        // $("#creditCheck").click(function()
        // {
        //     var teacherId = $('#teacherId').val();
        //     var courseId = $('#courseId').val();

        //     //return confirm(courseId);

        //     $.get("{{route('credit-check-for-alert')}}",{teacher_id:teacherId,course_id:courseId}, function (data) 
        //     {
        //        return confirm('Credit almost over than Remaining Credit. Are you sure to continue this  ?');
        //     });
        // });
    // </script>
    
    //--- Script End



    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'department_id' => 'required',
            'teacher_id'    => 'required', 
            'course_id'     => 'required|unique:course_assign_to_teachers', 
        ]);

        if($validator->fails())
        {
           return redirect()->back()->withErrors($validator)->withInput();
        }

        $course = Course::where('id',$request->course_id)->first(); //1.For pass size of credit 
        
        
        $courseAssignToTeacher = new CourseAssignToTeacher;
        $courseAssignToTeacher->department_id = $request->department_id;
        $courseAssignToTeacher->teacher_id    = $request->teacher_id;
        $courseAssignToTeacher->course_id     = $request->course_id;
        $courseAssignToTeacher->credit_took   = $course->credit; //1.pass size of credit 
        $courseAssignToTeacher->save();

        session()->flash('type','success');
        session()->flash('message','Course assign to teacher successfully');
        
        return redirect()->back();
    }
 
}
