@extends('layouts.app')
@section('title', $equipment->equipment_name)

@section('content')
    <h1>{{ $equipment->equipment_name }}</h1>
    <p>{{ $equipment->description ?: 'No description.' }}</p>

    <a href="{{ route('equipments.edit', $equipment) }}">Edit</a>
    <a href="{{ route('equipments.index') }}">Back to list</a>

    <h2>Number of borrowed equipment ({{ $equipment->borrowing()->count() }})</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Status</th>
        </tr>
        @forelse ($equipment->borrowing as $index)
            <tr>
                <td>{{ $index->student->first_name }} {{ $index->student->last_name }}</td>
                <td>{{ $index->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No equipment yet.</td>
            </tr>
        @endforelse
    </table>
@endsection