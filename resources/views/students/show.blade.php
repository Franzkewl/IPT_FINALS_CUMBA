@extends('layouts.app')
@section('title', $student->first_name . ' ' . $student->last_name)

@section('content')
    <h1>{{ $student->first_name }} {{ $student->middle_initial }} {{ $student->last_name }}</h1>
    <p>Email: {{ $student->email }}</p>
    <p>Course: {{ $student->course }}</p>
    <p>Year Level: {{ $student->year_level }}</p>

    <a href="{{ route('students.edit', $student) }}">Edit</a>
    <a href="{{ route('students.index') }}">Back to list</a>
@endsection
