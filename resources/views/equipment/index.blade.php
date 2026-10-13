@extends('layouts.app')
@section('title', 'Equipments')

@section('content')
    <h1>Equipments</h1>
    <a href="{{ route('equipments.create') }}" class="btn btn-primary mb-3">Add Equipment</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
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
                    <a href="{{ route('equipments.show', $equipments) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('equipments.edit', $equipments) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('equipments.destroy', $equipments) }}"
                        onsubmit="return confirm('Delete this equipment?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No equipment yet.</td></tr>
        @endforelse
    </table>
</div>
    {{ $equipment->links() }}
@endsection