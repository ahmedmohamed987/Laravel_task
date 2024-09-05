<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <script src="{{ url('js/jquery-3.6.0.min.js') }}"></script>
</head>
<body>

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <div class="m-3 w-25">
        <label for="studentName" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="studentName" required>
    </div>
 @error('name')
 <span class="text-danger m-2">
     {{$errors->first('name')}}
 </span>

 @enderror
     
 
    <div class="m-3 w-25">
        <label for="schoolName" class="form-label">School Name</label>
        <input type="text" class="form-control" name="school_name" id="schoolName" required>
    </div>
    @error('school_name')
 <span class="text-danger m-2">
     {{$errors->first('school_name')}}
 </span>

 @enderror
     

    <div class="m-3 w-25">
        <label for="schoolLocation" class="form-label">School Location</label>
        <input type="text" class="form-control" name="school_location" id="schoolLocation" required>
    </div>
    @error('school_location')
    <span class="text-danger m-2">
        {{$errors->first('school_location')}}
    </span>
   
    @enderror
    <div class="m-3 w-25">
        <label for="numSubjects" class="form-label">Number of Subjects</label>
        <input type="number" class="form-control" id="numSubjects" min="1" required>
    </div>
   
    <div id="subjectsContainer" class="m-3"></div>

    <button type="submit" class="btn btn-primary m-5">Submit</button>
</form>

<script>
$(document).ready(function() {
    $('#numSubjects').on('input', function() {
        const numSubjects = $(this).val();
        const subjectsContainer = $('#subjectsContainer');
        subjectsContainer.empty(); // Clear existing inputs

        for (let i = 1; i <= numSubjects; i++) {
            subjectsContainer.append(`
                <div class="mb-3 w-25">
                    <label for="subject${i}" class="form-label">Subject ${i}</label>
                    <input type="text" class="form-control" name="subjects[]" id="subject${i}" required>
                </div>
            `);
        }
    });
});
</script>

<script src="{{ url('js/bootstrap.bundle.js') }}"></script>
</body>
</html>
