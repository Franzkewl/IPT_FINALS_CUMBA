<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Student;
use App\Models\Equipment;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowings = Borrowing::with(['student', 'equipment'])->orderBy('borrowed_date', 'asc')->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students   = Student::orderBy('first_name')->get();
        $equipments = Equipment::orderBy('equipment_name')->get();

        return view('borrowings.create', compact('students', 'equipments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'equipment_id' => ['required', 'exists:equipments,equipment_id'],
            'borrowed_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:borrowed_date'],
            'purpose' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:borrowed,returned,overdue'],
            'released_by' => ['required', 'string', 'max:100'],
        ]);

        Borrowing::create($data);

        return redirect()->route('borrowings.index')->with('success', 'Borrowing record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['student', 'equipment', 'return']);
        return view('borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing $borrowing)
    {
        $students   = Student::orderBy('first_name')->get();
        $equipments = Equipment::orderBy('equipment_name')->get();

        return view('borrowings.edit', compact('borrowing', 'students', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing $borrowing)
    {
        $data = $request->validate([
            'student_id' => ['required', 'exists:students,student_id'],
            'equipment_id' => ['required', 'exists:equipments,equipment_id'],
            'borrowed_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:borrowed_date'],
            'purpose' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:borrowed,returned,overdue'],
            'released_by' => ['required', 'string', 'max:100'],
        ]);

        $borrowing->update($data);

        return redirect()->route('borrowings.index')->with('success', 'Borrowing record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();

        return redirect()->route('borrowings.index')->with('success', 'Borrowing record deleted successfully.');
    }
}
