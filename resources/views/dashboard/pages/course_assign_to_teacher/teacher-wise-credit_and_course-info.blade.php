<div class="form-group">
    <label><b>Credit To Be Taken</b></label>
    <input type="text" name="credit_to_be_taken" value="{{$teacher->credit_to_be_taken}}" class="form-control" readonly >
</div>

<div class="form-group">
    <label><b>Remaining Credit</b></label>
    <input type="text" name="credit_to_be_taken" class="form-control" value="{{$remaining_credit}}" readonly>
</div>

<div class="form-group">
    <label><b>Course Code</b></label>
    <select name="course_id" id="courseId" class="form-control">
            <option value="">--- Select Course Code ---</option>
        @foreach ($courses as $course)
            <option value="{{$course->id}}">{{$course->course_code}}</option>
        @endforeach
    </select>
</div>



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- এটার স্ক্রিপ্ট এখানেই দিতে হবে । create.blade.php তে দিলে কাজ করবেনা । -->
<script>

    //after selecting Course Code then Course name and Credit info will be loaded || check 'teacher-wise-credit_and_course-info.blade.php'
    $('#courseId').change(function() 
    {
        var courseId = $(this).val();
        if (courseId ) 
        {
            $.get("{{route('course-name_and_credit-info')}}",{course_id:courseId}, function (data) 
            {
                console.log('ok');
                $('#courseNameAndCreditInfo').empty().html(data); //
            });
        }
    })

    

</script>