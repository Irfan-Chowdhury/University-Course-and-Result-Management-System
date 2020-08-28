<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\Course;
use App\Models\Department;
use App\Models\AllocateClassroom;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllocateClassroomController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        $courses     = Course::all(); //temporary Cascading Later
        $rooms       = Room::all(); 

        return view('dashboard.pages.allocate_classroom.create',compact('departments','courses','rooms'));
    }

    public function store(Request $request)
    {
        // return $request->all();
        if ($request->to < $request->from) 
        {
            session()->flash('error_message',"From-Date cann't be less than To-Date");
            return redirect()->back();
        }


        $data = DB::table('allocate_classrooms')
                    ->where('department_id',$request->department_id)
                    // ->where('course_id',$request->course_id)
                    ->where('room_id',$request->room_id)
                    ->where('day',$request->day)
                    ->where('status',1)
                    ->get();

        // return $data ;

        foreach ($data as $item) 
        {
            if (($request->from >= $item->from && $request->from < $item->to) || ($request->to > $item->from && $request->to  <= $item->to) ||($request->from < $item->from && $request->to > $item->to))
            // if (($request->from >= $item->from && $request->to <= $item->to ) || ($request->from > $item->from && $request->to <= $item->to) ||($request->from < $item->from && $request->to > $item->to))
            {
                session()->flash('error_message',"Overlape");
                return redirect()->back()->withInput();
            }
        }

        $allocate_classroom = new AllocateClassroom();
        $allocate_classroom->department_id = $request->department_id;
        $allocate_classroom->course_id     = $request->course_id;
        $allocate_classroom->room_id       = $request->room_id;
        $allocate_classroom->day           = $request->day;
        $allocate_classroom->from          = $request->from;
        $allocate_classroom->to            = $request->to;
        $allocate_classroom->save();
        session()->flash('message','Classroom Allocate Successfully');
        return redirect()->back();
    }
}








// =========================================================================================
// --->> Overlape 

// D = Database || R = Request

// #1 D.      ___________ |  _____________ |  ___________
//    R.      _______     |     _______    |  ___________  ($request->from >= $item->from && $request->to <= $item->to )



// #2 D.      ___________
//    R.          _______     ($request->from > $item->from && $request->to <= $item->to)



// #3 D.      ___________
//    R.   _________________  ($request->from < $item->from && $request->to > $item->to)



// #4 D.      ___________      |   ___________
//    R.          ___________  |   _______________     ($request->from >= $item->from && $request->to > $item->to) 



// --->> No  Overlape 

// #1 D.            _______      
//    R.      ______            ($request->from < $item->from && $request->to <= $item->from)



// #2 D.      _______
//    R.             _______    ($request->from >= $item->to && $request->to > $item->to)

// =========================================================================================



// Net

  // ->orWhere([
//     ['from','>',$request->from],
//     ['from','<',$request->to],
// ])
// ->orWhere([
//     ['from','>=',$request->from],
//     ['to','<=',$request->from],
// ])