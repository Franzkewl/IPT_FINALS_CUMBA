@extends('layouts.app')
@section('title', 'New Borrowing')

@section('content')
    <h1>New Borrowing</h1>
    @include('borrowings._form', ['borrowing' => new \App\Models\Borrowing])
@endsection