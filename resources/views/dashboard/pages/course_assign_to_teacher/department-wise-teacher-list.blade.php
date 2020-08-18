<option value="">--Select Teacher--</option>
@foreach ($teachers as $teacher)
    <option value="{{$teacher->id}}">{{$teacher->teacher_name}}</option>
@endforeach