
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Student</h1>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf

            <div class="m-3 w-50">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
            </div>

            <div class="m-3 w-50">
                <label for="school_id" class="form-label">School</label>
                <select class="form-control" name="school_id" required>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}" {{ $school->id == $student->school_id ? 'selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="m-3 w-50">
                <label for="subjects" class="form-label">Subjects</label>
                <select class="form-control" name="subjects[]" multiple required>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ in_array($subject->id, $student->subjects->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>

    <script src="{{url('js/bootstrap.bundle.js')}}"></script>
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>
</body>
</html>