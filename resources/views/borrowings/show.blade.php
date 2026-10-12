@extends('layouts.app')
@section('title', $borrowing->borrowing_name)

@section('content')
    <h1>{{ $borrowing->borrowing_name }}</h1>
    <p>{{ $borrowing->description ?: 'No description.' }}</p>

    <a href="{{ route('categories.edit', $borrowing) }}">Edit</a>
    <a href="{{ route('categories.index') }}">Back to list</a>

    <h2>Equipment in this borrowing ({{ $borrowing->equipment->count() }})</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Student Name</th>
            <th>Equipment Name</th>
            <th>Borrowed</th>
            <th>Due</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @forelse ($borrowing->equipment as $item)
            <tr>
                <td>{{ $borrowing->student->first_name ?? '-' }}
                {{ $borrowing->student->last_name ?? '-' }}</td>
                <td>{{ $borrowing->equipment->equipment_name ?? '-' }}</td>
                <td>{{ $borrowing->borrowed_date?->format('Y M d') }}</td>
                <td>{{ $borrowing->due_date?->format('Y M d') }}</td>
                <td>{{ ucfirst($borrowing->status) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No one borrowed yet.</td>
            </tr>
        @endforelse
    </table>
@endsection