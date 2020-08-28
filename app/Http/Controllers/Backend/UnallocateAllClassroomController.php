<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\AllocateClassroom;

class UnallocateAllClassroomController extends Controller
{
    public function create()
    {
        return view('dashboard.pages.unallocate_all_classrooms.create'); 
    }

    public function unallocate()
    {
        AllocateClassroom::where('status',1)
                    ->update(['status'  => 0]);

        session()->flash('message','All Classrooms Unallocated Successfully');
        return redirect()->back();
    }
}
