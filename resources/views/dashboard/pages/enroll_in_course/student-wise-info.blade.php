<div id="studentinfo">
    <div class="form-group">
        <label><b>Name</b></label>
        <input type="text" name="studentName" class="form-control" readonly value="{{$studentDetails->student_name}}">
    </div>
    
    <div class="form-group">
        <label><b>Email</b></label>
        <input type="text" name="email" class="form-control" readonly value="{{$studentDetails->email}}">
    </div>
    
     <div class="form-group">
        <label><b>Department</b></label>
        <input type="text" name="departmentId" class="form-control" readonly value="{{$studentDetails->department_name}}">
    </div>

    <div class="form-group">
        <label><b>Select Course</b></label>
        <select name="course_id" id="courseId" class="form-control">
                <option value="">--- Select Course ---</option>
            @foreach ($courses as $course)
                <option value="{{$course->id}}">{{$course->course_name}}</option>
            @endforeach
        </select>
        @error('course_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror 
    </div>
</div>