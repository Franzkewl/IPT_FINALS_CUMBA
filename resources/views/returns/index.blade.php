@extends('layouts.app')
@section('title', 'Returns')

@section('content')
    <h1>Returns</h1>
    <a href="{{ route('returns.create') }}" class="btn btn-primary mb-3">Add Return</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <tr>
            <th>Borrower</th>
            <th>Equipment</th>
            <th>Due Date</th>
            <th>Date Returned</th>
            <th>Condition</th>
            <th>Late Days</th>
            <th>Late Fee</th>
            <th>Received By</th>
            
        </tr>
        @forelse ($returns as $return)
            <tr>
                <td>{{ $return->borrowing->student->first_name ?? '-' }} {{ $return->borrowing->student->last_name ?? '' }}</td>
                <td>{{ $return->borrowing->equipment->equipment_name ?? '-' }}</td>
                <td>{{ $return->borrowing->due_date?->format('d M Y') }}</td>
                <td>{{ $return->returned_date?->format('d M Y') }}</td>
                <td>{{ ucfirst($return->condition) }}</td>
                <td>{{ $return->late_days }}</td>
                <td>{{ number_format($return->late_fee, 2) }}</td>
                <td>{{ $return->received_by }}</td>
            </tr>
        @empty
            <tr><td colspan="5">No returns yet.</td></tr>
        @endforelse
    </table>
</div>
    {{ $returns->links() }}
@endsection
           