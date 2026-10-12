@extends('layouts.app')
@section('title', 'Students')

@section('content')
    <h1>Students</h1>
    <a href="{{ route('students.create') }}">Add student</a>

    <table border="1" cellpadding="5">
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
                    <a href="{{ route('students.show', $student) }}">View</a>
                    <a href="{{ route('students.edit', $student) }}">Edit</a>
                    <form method="POST" action="{{ route('students.destroy', $student) }}"
                          onsubmit="return confirm('Delete this student?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">No students yet.</td></tr>
        @endforelse
    </table>

    {{ $students->links() }}
@endsection