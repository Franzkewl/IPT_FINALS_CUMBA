@extends('layouts.app')
@section('title', 'Borrowing Details')
@section('content')
    <h1>Borrowing Details</h1>
    <p>Purpose: {{ $borrowing->purpose ?: 'No purpose.' }}</p>
    <a href="{{ route('borrowings.edit', $borrowing) }}">Edit</a>
    <a href="{{ route('borrowings.index') }}">Back to list</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>Student Name</th>
            <th>Equipment Name</th>
            <th>Borrowed</th>
            <th>Due</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>{{ $borrowing->student->first_name ?? '-' }}
            {{ $borrowing->student->last_name ?? '-' }}</td>
            <td>{{ $borrowing->equipment->equipment_name ?? '-' }}</td>
            <td>{{ $borrowing->borrowed_date?->format('Y M d') }}</td>
            <td>{{ $borrowing->due_date?->format('Y M d') }}</td>
            <td>{{ ucfirst($borrowing->status) }}</td>
            <td>
                <a href="{{ route('borrowings.edit', $borrowing) }}">Edit</a>
                <form method="POST" action="{{ route('borrowings.destroy', $borrowing) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this borrowing?')">Delete</button>
                </form>
            </td>
        </tr>
    </table>
@endsection