<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $departments = Department::all();
        return view('dashboard.pages.department.index',compact('departments'));
    }


    public function store(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'department_code'  => 'required|min:3|max:7|unique:departments|regex:/^[a-zA-Z]+[a-zA-Z0-9]*$/', //must te start with Letter, not number first, don't use space & _
            'department_name'  => 'required|unique:departments' //must te start with Letter, not number first, don't use space & _
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $department = new Department();
        $department->department_code = $request->department_code;
        $department->department_name = $request->department_name;

        $department->save();

        session()->flash('type','success');
        session()->flash('message','Department Saved Successfully');
        
        return redirect()->back();
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('dashboard.pages.department.edit',compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        $validator= Validator::make($request->all(),[
            'department_code'  => 'required|min:3|max:7|unique:departments,department_code,'.$department->id.'|regex:/^[a-zA-Z]+[a-zA-Z0-9]*$/', //must te start with Letter, not number first, don't use space & _
            'department_name'  => 'required|unique:departments,department_name,'.$department->id //must te start with Letter, not number first, don't use space & _
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // $department = Department::find($id);
        $department->department_code = $request->department_code;
        $department->department_name = $request->department_name;

        $department->update();

        session()->flash('type','success');
        session()->flash('message','Department Updated Successfully');
        
        return redirect()->back();
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();

        session()->flash('type','success');
        session()->flash('message','Department Deleted Successfully');
        
        return redirect()->back();

    }
}
