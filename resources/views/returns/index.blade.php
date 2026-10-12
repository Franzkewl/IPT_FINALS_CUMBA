@extends('layouts.app')
@section('title', 'Returns')

@section('content')
    <h1>Returns</h1>
    <a href="{{ route('returns.create') }}">Add return</a>

    <table border="1" cellpadding="5">
        <tr>
            <th>Borrower</th>
            <th>Equipment</th>
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

    {{ $returns->links() }}
@endsection
           