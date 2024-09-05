<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
        <!-- Bootstrap CSS v5.2.1 -->
        </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#"> Blog</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link active " aria-current="page" href="#">ALL Students</a>
                 </div>
              </div>
            </div>
          </nav>
 
           <div class="text-center"> 
             <a name=""id=""class="btn btn-success mt-4 "href="{{ route('create') }}"role="button" >Create Post</a>
           </div>
        <div
            class="table-responsive container mt-5 "   >
        
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"> id</th>
                        <th scope="col">Student_name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Student_school</th>
                        <th scope="col">School_location</th>
                        <th scope="col">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr class="">
                        <td scope="row">{{ $student['student_id']}}</td>
                        <td>{{ $student['student_name'] }}</td>
                        <td>{{ $student['subject_names'] }}</td>
                        <td>{{ $student['school_name'] }}</td>
                        <td>{{ $student['school_location'] }}</td>
                        
                        <td>
                            <a name="" id="" class="btn btn-info m-1" href="{{ route('students.show',$student['student_id']) }}" role="button">View</a>
                            <a name="" id="" class="btn btn-primary m-1" href="{{ route('students.edit',$student['student_id']) }}" role="button">Edit</a>
                            <a name="" id="" class="btn btn-danger m-1" href="{{ route('delete',$student['student_id']) }}" role="button">Delete</a>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
        
      
        <script src="{{url('js/bootstrap.bundle.js')}}"></script>
        <script src="{{url('js/jquery-3.6.0.min.js')}}"></script>


    </body>
</html>


