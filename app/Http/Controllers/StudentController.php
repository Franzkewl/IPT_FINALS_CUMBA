<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('last_name')->paginate(10);
            return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'first_name' => ['required', 'string', 'max:100'],
        'middle_initial' => ['nullable', 'string', 'max:1'],
        'last_name' => ['required', 'string', 'max:100'],
        'course' => ['required', 'string', 'max:50'],
        'year_level' => ['required', 'integer', 'between:1,4'],
        'gender' => ['nullable', 'in:male,female,other'],
        'birthdate' => ['required', 'date'],
        'contact_number' => ['required', 'string', 'max:15', 'unique:students,contact_number'],
        'email'         => ['required', 'email', 'unique:students,email'],
        'total_borrowed_items' => ['nullable', 'integer', 'min:0'],
        ]);

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {

    return view('students.edit', compact('student'));

    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Student $student)
    {
    $data = $request->validate([
        'first_name' => ['required', 'string', 'max:100'],
        'middle_initial' => ['nullable', 'string', 'max:1'],
        'last_name' => ['required', 'string', 'max:100'],
        'course' => ['required', 'string', 'max:50'],
        'year_level' => ['required', 'integer', 'between:1,4'],
        'birthdate' => ['required', 'date'],
        'contact_number' => ['required', 'string', 'max:15',
            Rule::unique('students', 'contact_number')->ignore($student->student_id, 'student_id')],
        'email' => ['required', 'email',
            Rule::unique('students', 'email')->ignore($student->student_id, 'student_id')],
        'total_borrowed_items' => ['nullable', 'integer', 'min:0'],
    ]);

    $student->update($data);

    return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

}
