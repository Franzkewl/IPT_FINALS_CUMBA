@extends('layouts.app')
@section('title', $equipment->equipment_name)

@section('content')
    <h1>{{ $equipment->equipment_name }}</h1>
    <p>{{ $equipment->description ?: 'No description.' }}</p>

    <a href="{{ route('categories.edit', $equipment) }}">Edit</a>
    <a href="{{ route('categories.index') }}">Back to list</a>

    <h2>Equipment in this equipment ({{ $equipment->equipment->count() }})</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Status</th>
        </tr>
        @forelse ($equipment->equipment as $item)
            <tr>
                <td>{{ $item->equipment_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No equipment yet.</td>
            </tr>
        @endforelse
    </table>
@endsection