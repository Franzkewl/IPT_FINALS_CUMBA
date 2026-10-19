<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Equipment;
use App\Models\ReturnRecord;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'categories' => Category::count(),
            'students'   => Student::count(),
            'equipment'  => Equipment::count(),
            'borrowings' => Borrowing::count(),
            'borrowed'   => Borrowing::where('status', 'borrowed')->count(),
            'returned'   => ReturnRecord::count(),
            'overdue'    => Borrowing::where('status', 'overdue')
                ->orWhere(fn ($q) => $q->where('status', 'borrowed')->whereDate('due_date', '<', today()))
                ->count(),
            'late_fees'  => ReturnRecord::sum('late_fee'),
        ];

        $recent = Borrowing::with(['student', 'equipment'])
            ->orderBy('borrowing_id', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'recent'));
    }
}
