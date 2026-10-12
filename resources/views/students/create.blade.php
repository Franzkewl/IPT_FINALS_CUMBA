@extends('layouts.app')
@section('title', 'New Student')

@section('content')
    <h1>New Student</h1>
    @include('students._form', ['student' => new \App\Models\Student])
@endsection