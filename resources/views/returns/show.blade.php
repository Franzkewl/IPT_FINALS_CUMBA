@extends('layouts.app')
@section('title', $return->borrowing->student->first_name . ' ' . $return->borrowing->studentlast_name)

@section('content')
    <h1>{{ $return->borrowing->student->first_name }} {{ $return->borrowing->student->middle_initial }} {{ $return->borrowing->student->last_name }}</h1>
    <p>Equipment: {{ $return->borrowing->equipment->equipment_name }}</p>
    <p>Due Date: {{ $return->borrowing->due_date }}</p>
    <p>Returned Date: {{ $return->returned_date }}</p>
    <p>Condition: {{ $return->condition }}</p>
    <p>Late Days: {{ $return->late_days }}</p>
    <p>Late Fee: {{ $return->late_fee }}</p>
    <p>Received By: {{ $return->received_by }}</p>

    <a href="{{ route('returns.edit', $return) }}">Edit</a>
    <a href="{{ route('returns.index') }}">Back to list</a>
@endsection
