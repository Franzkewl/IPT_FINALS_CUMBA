@extends('layouts.app')
@section('title', 'Borrowings')

@section('content')
    <h1>Borrowings</h1>
    <a href="{{ route('borrowings.create') }}">Add borrowing</a>

   <table border="1" cellpadding="5">
    <tr>
        <th>Student Name</th>
        <th>Equipment Name</th>
        <th>Borrowed</th>
        <th>Due</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @forelse ($borrowings as $borrowing)
        <tr>
            <td>{{ $borrowing->student->first_name ?? '-' }}
            {{ $borrowing->student->last_name ?? '-' }}</td>
            <td>{{ $borrowing->equipment->equipment_name ?? '-' }}</td>
            <td>{{ $borrowing->borrowed_date?->format('Y M d') }}</td>
            <td>{{ $borrowing->due_date?->format('Y M d') }}</td>
            <td>{{ ucfirst($borrowing->status) }}</td>
            <td>
                    <a href="{{ route('borrowings.show', $borrowing) }}">View</a>
                    <a href="{{ route('borrowings.edit', $borrowing) }}">Edit</a>
                    <form method="POST" action="{{ route('borrowings.destroy', $borrowing) }}"
                        onsubmit="return confirm('Delete this borrowing?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No borrowings yet.</td></tr>
        @endforelse
    </table>

    {{ $borrowings->links() }}
@endsection