<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\Student;
use App\Models\Subject;
use App\Models\StudentSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function get_data(){
        // $students = Student::
        // ->join('schools', 'students.school_id', '=', 'schools.id')
        // ->join('student_subject', 'students.id', '=', 'student_subject.student_id')
        // ->join('subjects', 'student_subject.subject_id', '=', 'subjects.id')
        // ->get();
        $students = Student::
         join('schools', 'students.school_id', '=', 'schools.id')
        ->join('student_subject', 'students.id', '=', 'student_subject.student_id')
        ->join('subjects', 'student_subject.subject_id', '=', 'subjects.id')
        ->select(
            'students.id as student_id',
            'students.id as student_id',
            'students.name as student_name', 
            'schools.name as school_name', 
            'schools.location as school_location',
            DB::raw('GROUP_CONCAT(subjects.name SEPARATOR ", ") as subject_names')
        )
        ->groupBy('students.id', 'students.name', 'schools.name', 'schools.location')
        ->get();
    
        return view('home',['students'=>$students]);
}

public function create()
{
    // Fetch schools and subjects for the form dropdowns
    // $schools = School::all();
    // $subjects = Subject::all();
    
    // Pass the data to the view
    return view('create');
}

public function store(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => ['required', 'regex:/^[\pL\s]+$/u'],
        'school_name' => ['required', 'regex:/^[\pL\s]+$/u'],
        'school_location' => ['required', 'regex:/^[\pL\s]+$/u'],
        'subjects' => 'required|array',
        'subjects.*' => 'string|max:255',
    ]);

    // Create or update the school
    $school = School::firstOrCreate([
        'name' => $request->input('school_name'),
    ], [
        'location' => $request->input('school_location')
    ]);

    // Create a new student and associate with a school
    $student = new Student;
    $student->name = $request->name;
    $student->school_id = $school->id;
    $student->save();

    // Loop through the subjects and save each one individually
    foreach ($request->subjects as $subjectName) {
        $subject = Subject::firstOrCreate(['name' => $subjectName]);

        // Attach the subject to the student
        $student->subjects()->attach($subject->id);
    }

    // Redirect with a success message
    return redirect()->route('home')->with('success', 'Student and subjects created successfully.');
}

    public function show($id)
    {
        // Retrieve the student by ID, including their school and subjects
        $student = Student::with('school', 'subjects')->findOrFail($id);

        // Pass the student data to the view
        return view('list', compact('student'));
    }

    public function delete($id){
    $student = Student::with('school', 'subjects')->findOrFail($id);
    $student->delete();
    return redirect()->route('home');
    }
    public function edit($id){
        $student= Student::with('school','subjects')->findOrFail($id);
        $schools = School::all(); // Retrieve all schools for the dropdown
        $subjects = Subject::all(); 
        return view('edit', compact('student', 'schools', 'subjects'));
    }
    public function update(Request $request,$id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'subjects' => 'required|array',
            'subjects.*' => 'exists:subjects,id',
        ]);

        // Create a new student
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->school_id = $request->school_id;
        $student->save();
        // Attach subjects to the student
        $student->subjects()->sync($request->subjects);

        // Redirect with success message
        return redirect()->route('home')->with('success', 'Student updated successfully.');
    }

}