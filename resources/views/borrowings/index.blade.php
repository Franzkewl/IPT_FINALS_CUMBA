@extends('layouts.app')
@section('title', 'Borrowings')

@section('content')
    <h1>Borrowings</h1>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary mb-3">Add Borrowing</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
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
                    <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('borrowings.edit', $borrowing) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('borrowings.destroy', $borrowing) }}"
                        onsubmit="return confirm('Delete this borrowing?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No borrowings yet.</td></tr>
        @endforelse
    </table>
</div> 

    {{ $borrowings->links() }}
@endsection