<?php

namespace App\Http\Controllers\Backend;

use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class TeacherController extends Controller
{
    public function create()
    {
        $departments = Department::all();

        return view('dashboard.pages.teacher.create',compact('departments'));
    }


    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'teacher_name' => 'required',
            'address'      => 'required', 
            'email'        => 'required|email|unique:teachers', 
            'contact_no'   => 'required', 
            'designation'  => 'required', 
            'department_id'=> 'required', 
            'credit_to_be_taken' => 'required|numeric', 
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $teacher = new Teacher();
        $teacher->teacher_name = $request->teacher_name;
        $teacher->address      = $request->address;
        $teacher->email        = $request->email;
        $teacher->contact_no   = $request->contact_no;
        $teacher->designation  = $request->designation;
        $teacher->department_id = $request->department_id;
        $teacher->credit_to_be_taken = $request->credit_to_be_taken;

        $teacher->save();

        session()->flash('type','success');
        session()->flash('message','Teacher Saved Successfully');
        
        return redirect()->back();
    }
}
