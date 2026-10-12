<?php

namespace App\Http\Controllers;

use App\Models\ReturnRecord;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returns = ReturnRecord::with('borrowing.student', 'borrowing.equipment')
            ->orderBy('return_id', 'desc')
            ->paginate(10);

        return view('returns.index', compact('returns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('returns.create', [
            'return'     => new ReturnRecord(),
            'borrowings' => Borrowing::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'borrowing_id'  => ['required', 'exists:borrowings,borrowing_id'],
            'returned_date' => ['required', 'date', 'before_or_equal:today'],
            'condition'     => ['required', 'in:good,damaged,lost'],    
            'received_by'   => ['required', 'string', 'max:100'],
        ]);

        $borrowing = Borrowing::findOrFail($data['borrowing_id']);

        if ($borrowing->status === 'returned') {
            return back()->withErrors(['borrowing_id' => 'This borrowing was already returned.'])->withInput();
        }

        $due = Carbon::parse($borrowing->due_date);
        $returned = Carbon::parse($data['returned_date']);

        $data['late_days'] = max(0, (int) $due->diffInDays($returned, false));
        $data['late_fee']  = $data['late_days'] * 5;     // 5 per day, change to your rate

        DB::transaction(function () use ($data, $borrowing) {
            ReturnRecord::create($data);
            $borrowing->update(['status' => 'returned']);
        });

        return redirect()->route('returns.index')->with('success', 'Return recorded.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReturnRecord $returnRecord)
    {
        $returnRecord->load(['borrowing.student', 'borrowing.equipment']);
        return view('returns.show', compact('returnRecord'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReturnRecord $return)
    {
        return view('returns.edit', [
            'return'     => $return,
            'borrowings' => Borrowing::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReturnRecord $returnRecord)
    {
        $data = $request->validate([
            'borrowing_id'  => ['required', 'exists:borrowings,borrowing_id'],
            'returned_date' => ['required', 'date', 'before_or_equal:today'],
            'condition'     => ['required', 'in:good,damaged,lost'],    
            'late_days' => ['required', 'integer', 'min:0'],
            'late_fee'  => ['required', 'numeric', 'min:0'],
            'received_by'   => ['required', 'string', 'max:100'],
        ]);

        $borrowing = $returnRecord->borrowing;

        $due = Carbon::parse($borrowing->due_date);
        $returned = Carbon::parse($data['returned_date']);

        $data['late_days'] = max(0, (int) $due->diffInDays($returned, false));
        $data['late_fee']  = $data['late_days'] * 5;     // 5 per day, change to your rate

        DB::transaction(function () use ($data, $returnRecord) {
            $returnRecord->update($data);
        });

        return redirect()->route('returns.index')->with('success', 'Return record updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnRecord $returnRecord)
    {
        DB::transaction(function () use ($returnRecord) {
            $borrowing = $returnRecord->borrowing;
            $borrowing->update(['status' => 'borrowed']);
            $returnRecord->delete();
        });

        return redirect()->route('returns.index')->with('success', 'Return record deleted.');
    }
}
