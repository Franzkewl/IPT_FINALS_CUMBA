@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <h1>Dashboard</h1>

    <div class="row g-3 mb-4">
        @foreach ([
            ['Categories', $stats['categories'], 'categories.index', 'primary'],
            ['Students', $stats['students'], 'students.index', 'primary'],
            ['Equipment', $stats['equipment'], 'equipments.index', 'primary'],
            ['Total Borrowings', $stats['borrowings'], 'borrowings.index', 'primary'],
            ['Currently Borrowed', $stats['borrowed'], 'borrowings.index', 'warning'],
            ['Overdue', $stats['overdue'], 'borrowings.index', 'danger'],
            ['Returned', $stats['returned'], 'returns.index', 'success'],
            ['Late Fees Collected', number_format($stats['late_fees'], 2), 'returns.index', 'secondary'],
        ] as [$label, $value, $route, $color])
            <div class="col-6 col-md-3">
                <a href="{{ route($route) }}" class="text-decoration-none">
                    <div class="card border-{{ $color }} h-100">
                        <div class="card-body text-center">
                            <div class="fs-2 fw-bold text-{{ $color }}">{{ $value }}</div>
                            <div class="text-muted">{{ $label }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <h2 class="h4">Recent Borrowings</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Student</th>
                <th>Equipment</th>
                <th>Borrowed</th>
                <th>Due</th>
                <th>Status</th>
            </tr>
            @forelse ($recent as $borrowing)
                <tr>
                    <td>{{ $borrowing->student->first_name ?? '-' }} {{ $borrowing->student->last_name ?? '' }}</td>
                    <td>{{ $borrowing->equipment->equipment_name ?? '-' }}</td>
                    <td>{{ $borrowing->borrowed_date?->format('Y M d') }}</td>
                    <td>{{ $borrowing->due_date?->format('Y M d') }}</td>
                    <td>{{ ucfirst($borrowing->status) }}</td>
                </tr>
            @empty
                <tr><td colspan="5">No borrowings yet.</td></tr>
            @endforelse
        </table>
    </div>
@endsection
