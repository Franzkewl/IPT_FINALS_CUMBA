@extends('layouts.app')
@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ ucfirst($category->is_active ? 'Active' : 'Inactive') }}</td>
                <td>
                    <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}"
                        onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No categories yet.</td></tr>
        @endforelse
    </table>
</div>
    {{ $categories->links() }}
@endsection