@extends('layouts.app')
@section('title', 'New Equipment')

@section('content')
    <h1>New Equipment</h1>
    @include('equipment._form', ['equipment' => new \App\Models\Equipment])
@endsection