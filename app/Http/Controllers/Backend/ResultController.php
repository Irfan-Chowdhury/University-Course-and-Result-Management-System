<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Models\Result;
use App\Models\Student;
use App\Models\Department;
use App\Models\EnrollInCourse;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    public function create()
    {
        $students = Student::orderBy('student_reg_no','ASC')->get();

        return view('dashboard.pages.result.create',compact('students')); 
    }

    public function show($id)
    {
        $students = Student::orderBy('student_reg_no','ASC')->get();

        $single_student = Student::find($id);

        // $single_student = DB::table('students')
        //                 // ->join('departments','students.department_id','=','departments.id')
        //                 ->where('students.id',$id)
        //                 ->first();

        $department = Department::find($single_student->department_id);
        
        // return $department;

        $courses = DB::table('enroll_in_courses')
                    ->join('courses','enroll_in_courses.course_id','=','courses.id')
                    ->where('enroll_in_courses.student_id','=',$id) //id = students'id
                    // ->where('enroll_in_courses.status','=',1) //New 
                    ->get();

        // return $courses;
        
        return view('dashboard.pages.result.create',compact('students','single_student','department','courses'));
    }

    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'student_id' => 'required',
            'course_id'  => 'required', 
            'grade'      => 'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ==================== Option-1 ===================

        $enroll_course_id = DB::table('enroll_in_courses')
                            ->select('id')
                            ->where('student_id',$request->student_id) 
                            ->where('course_id',$request->course_id) 
                            ->first();

        
        $data = Result::where('student_id',$request->student_id)
                        ->where('course_id',$request->course_id)
                        ->first();

        // return $data->id;

        if ($data) 
        {
            $result = Result::find($data->id);
            $result->student_id = $request->student_id;
            $result->course_id  = $request->course_id;
            $result->grade      = $request->grade;
            $result->update();

            session()->flash('message','Result Updated Successfully');
            return redirect()->route('result.create');
        }
        else 
        {
            $result = new Result();
            $result->student_id = $request->student_id;
            $result->course_id  = $request->course_id;
            $result->grade      = $request->grade;
            $result->enroll_in_courses_id = $enroll_course_id->id;
            $result->save();

            session()->flash('message','Result Saved Successfully');
            return redirect()->route('result.create');
        }

        

        // ==================== Option-2 [But One Problem, Can't send Flash message that is Insert or Update & created_at coloumn creating Null value  ] ===================

        //**
        //Note:   DB::table('blogs')->updateOrInsert([Conditions],[fields with value]);
        //**
        
        
        // DB::table('results') 
        //     ->updateOrInsert(  
        //         ['student_id' => $request->student_id,'course_id' => $request->course_id,'enroll_in_courses_id' => $enroll_course_id->id],
        //         ['grade' => $request->grade]
        //     );

        // session()->flash('type','success');
        // session()->flash('message','Result Saved Successfully');
        
        // return redirect()->route('result.create');
    }
}
