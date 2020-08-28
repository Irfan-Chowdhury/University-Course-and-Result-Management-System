<?php

namespace App\Http\Controllers\Backend;

use DB;
use App\Models\AllocateClassroom;
use App\Models\Department;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewClassScheduleAndRoomAllocationController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('dashboard.pages.view_class_schedule_and_room_allocation.index',compact('departments')); 
    }

    public function show(Request $request)
    {        
        $data = DB::table('courses') //fetch courses info 
                    ->select('courses.id AS course_id','course_code','course_name')
                    ->where('courses.department_id',$request->department_id)
                    ->get();

        
        $data2 = AllocateClassroom::select('course_id') //retrive common value 
                ->where('status',1)
                ->distinct()
                ->get();


        foreach($data as $key => $item1)
        {
            $record[$key] = NULL; //initially assign NUll

            foreach ($data2 as $item2) 
            {
                if ($item1->course_id == $item2->course_id) // course_id match check between courses data and common data 
                {
                    $record[$key] =  $item2->course_id ; // if true then assing data of 'common' (data2) in a array
                }
            }
            
        }
        //return $record[1];

         
        foreach ($data as $key => $value) 
        {            
            // $schedules[] = Code...   //we can declare this way or

            if ($record[$key]!= NULL) // check is NULL or not
            {
                $schedules[$key] = AllocateClassroom::select('allocate_classrooms.*','rooms.room_no',
                            DB::raw("CONCAT('Room No :', ' ', room_no, ', ', allocate_classrooms.day, ', ') as schedule_info"))
                            ->join('rooms','allocate_classrooms.room_id','=','rooms.id')
                            ->where('allocate_classrooms.course_id',$value->course_id)
                            ->where('allocate_classrooms.status',1)
                            ->get();
            }
            else {
                $schedules[$key] = NULL; // if records null, $schedules also will be NULL
            }
        }

        // return $schedules[4];

        $departments = Department::all();
        return view('dashboard.pages.view_class_schedule_and_room_allocation.index',compact('departments','data','schedules')); 

    }
}
