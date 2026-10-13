@extends('layouts.app')
@section('title', 'Students')

@section('content')
    <h1>Students</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Students</a>
    
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>First Name</th>
            <th>Middle Initial</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Year Level</th>
            <th>Birthdate</th>
            <th>Contact Number</th>
            <th>Actions</th>
        </tr>
        @forelse ($students as $student)
            <tr>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->middle_initial }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->year_level }}</td>
                <td>{{ $student->birthdate }}</td>
                <td>{{ $student->contact_number }}</td>
                <td>
                    <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('students.destroy', $student) }}"
                          onsubmit="return confirm('Delete this student?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No students yet.</td></tr>
        @endforelse
    </table>
</div>
    {{ $students->links() }}
@endsection