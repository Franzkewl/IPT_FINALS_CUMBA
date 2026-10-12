@extends('layouts.app')
@section('title', $category->category_name)

@section('content')
    <h1>{{ $category->category_name }}</h1>
    <p>{{ $category->description ?: 'No description.' }}</p>

    <a href="{{ route('categories.edit', $category) }}">Edit</a>
    <a href="{{ route('categories.index') }}">Back to list</a>

    <h2>Equipment in this category ({{ $category->equipment->count() }})</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Status</th>
        </tr>
        @forelse ($category->equipment as $item)
            <tr>
                <td>{{ $item->equipment_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->status }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No equipments in this category yet.</td>
            </tr>
        @endforelse
    </table>
@endsection