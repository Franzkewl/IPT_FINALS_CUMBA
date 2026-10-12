@extends('layouts.app')
@section('title', 'Categories')

@section('content')
    <h1>Categories</h1>
    <a href="{{ route('categories.create') }}">Add category</a>

   <table border="1" cellpadding="5">
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
                    <a href="{{ route('categories.show', $category) }}">View</a>
                    <a href="{{ route('categories.edit', $category) }}">Edit</a>
                    <form method="POST" action="{{ route('categories.destroy', $category) }}"
                        onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No categories yet.</td></tr>
        @endforelse
    </table>

    {{ $categories->links() }}
@endsection