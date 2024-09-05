<!-- resources/views/students/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('css/home.css')}}">
</head>
<body>
    <div class="container mt-5">
        <h1>Student Details</h1>

        <div class="card cardd">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $student->name }}</h5>
                <p class="card-text"><strong>School:</strong> {{ $student->school->name }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $student->school->location }}</p>
                <p class="card-text"><strong>Subjects:</strong> 
                    @foreach ($student->subjects as $subject)
                        {{ $subject->name }}@if (!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to Student List</a>
    </div>

    <script src="{{url('js/bootstrap.bundle.js')}}"></script>
    <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>
</body>
</html>
