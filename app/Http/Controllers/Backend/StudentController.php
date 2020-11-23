<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\Student;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $last_tudent_info = Student::orderBy('id', 'DESC')->first();

        return view('dashboard.pages.student.create',compact('departments','last_tudent_info'));
    }

    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'student_name' => 'required',
            'email'        => 'required|email|unique:students', 
            'contact_no'   => 'required', 
            'date'         => 'required', //year
            'address'      => 'required', 
            'department_id'=> 'required', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        // ============ Student_Reg_No Start ==================
        $year = date('Y',strtotime($request->date));

        //return $year;

        $department = Department::find($request->department_id);
        $dept_code = $department->department_code;

        $previous_total = Student::where('department_id',$request->department_id)
                        ->where('year','=',$year)
                        ->count();

        //return $previous_total;

        $new_total = $previous_total + 1;

        if ($new_total<10){
            $student_reg_no = $dept_code.'-'.$year.'-'.'00'.$new_total;
        }
        elseif ($new_total>=10 && $new_total<=99) {
            $student_reg_no = $dept_code.'-'.$year.'-'.'0'.$new_total;
        }
        elseif ($new_total>=100 && $new_total<=999) {
            $student_reg_no = $dept_code.'-'.$year.'-'.$new_total;
        }

        //return $student_reg_no;

        // ==================== Student_Reg_No End ==============

        $student = new Student();
        $student->student_name   = $request->student_name;
        $student->email          = $request->email;
        $student->contact_no     = $request->contact_no;
        $student->year           = $year;
        $student->address        = $request->address;
        $student->department_id  = $request->department_id;
        $student->student_reg_no = $student_reg_no;
        $student->save();
        

        session()->flash('success_message','Registration Done Successfully');        
        return redirect()->back();

    }
}
