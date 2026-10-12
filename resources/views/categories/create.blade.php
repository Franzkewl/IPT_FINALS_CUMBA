@extends('layouts.app')
@section('title', 'New Category')

@section('content')
    <h1>New Category</h1>
    @include('categories._form', ['category' => new \App\Models\Category])
@endsection