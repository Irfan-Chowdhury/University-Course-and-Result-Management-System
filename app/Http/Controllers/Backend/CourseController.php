<?php

namespace App\Http\Controllers\Backend;

use App\Models\Course;
use App\Models\Semester;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class CourseController extends Controller
{
    public function create()
    {
        $departments = Department::all();
        $semesters   = Semester::all();

        $courses = DB::table('courses')
                ->join('departments','departments.id','=','courses.department_id')
                ->join('semesters','semesters.id','=','courses.semester_id')
                ->select('courses.*','departments.department_code','semesters.semester_name')
                ->get();

        return view('dashboard.pages.course.create',compact('departments','semesters','courses'));
    }

    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'course_code'  => 'required|max:10|unique:courses',
            'course_name'  => 'required|unique:courses', 
            'credit'       => 'required|numeric|min:0.5|max:5', 
            'description'  => 'required', 
            'department_id'=> 'required', 
            'semester_id'  => 'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $course = new Course();
        $course->course_code   = $request->course_code;
        $course->course_name   = $request->course_name;
        $course->credit        = $request->credit;
        $course->description   = $request->description;
        $course->department_id = $request->department_id;
        $course->semester_id   = $request->semester_id;

        $course->save();

        session()->flash('type','success');
        session()->flash('message','Course Saved Successfully');
        
        return redirect()->back();
    }

    public function edit($id)
    {
        $departments = Department::all();
        $semesters   = Semester::all();

        $course = DB::table('courses')
                ->join('departments','departments.id','=','courses.department_id')
                ->join('semesters','semesters.id','=','courses.semester_id')
                ->select('courses.*','departments.department_code','semesters.semester_name')
                ->where('courses.id',$id)
                ->first();

        return view('dashboard.pages.course.edit',compact('departments','semesters','course'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->course_code   = $request->course_code;
        $course->course_name   = $request->course_name;
        $course->credit        = $request->credit;
        $course->description   = $request->description;
        $course->department_id = $request->department_id;
        $course->semester_id   = $request->semester_id;

        $course->save();

        session()->flash('type','success');
        session()->flash('message','Course Update Successfully');
        
        return redirect()->back();
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();

        session()->flash('type','success');
        session()->flash('message','Course Deleted Successfully');
        
        return redirect()->back();
    }
}
