@extends('layouts.app')
@section('title', 'Equipments')

@section('content')
    <h1>Equipments</h1>
    <a href="{{ route('equipments.create') }}">Add equipment</a>

   <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @forelse ($equipment as $equipments)
            <tr>
                <td>{{ $equipments->equipment_name }}</td>
                <td>{{ $equipments->description }}</td>
                <td>{{ $equipments->category->category_name ?? '-' }}</td>
                <td>{{ $equipments->quantity }}</td>
                <td>{{ ucfirst($equipments->status) }}</td>
                <td>
                    <a href="{{ route('equipments.show', $equipments) }}">View</a>
                    <a href="{{ route('equipments.edit', $equipments) }}">Edit</a>
                    <form method="POST" action="{{ route('equipments.destroy', $equipments) }}"
                        onsubmit="return confirm('Delete this equipment?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No equipment yet.</td></tr>
        @endforelse
    </table>

    {{ $equipment->links() }}
@endsection