<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use App\Models\ReturnRecord;
use Illuminate\Database\Seeder;

class ReturnRecordSeeder extends Seeder
{
    public function run(): void
{
    $borrowings = Borrowing::with(['student', 'equipment'])
        ->whereIn('status', ['borrowed', 'overdue'])
        ->inRandomOrder()
        ->limit(10)
        ->get();

    foreach ($borrowings as $borrowing) {
        $returned = $borrowing->borrowed_date->copy()->addDays(rand(1, 12));
        if ($returned->gt(today())) {
            $returned = today();
        }
        $lateDays = max(0, (int) $borrowing->due_date->diffInDays($returned, false));

        ReturnRecord::factory()->create([
            'borrowing_id'   => $borrowing->borrowing_id,
            'student_name'   => $borrowing->student->first_name . ' ' . $borrowing->student->last_name,
            'equipment_name' => $borrowing->equipment->equipment_name,
            'due_date'       => $borrowing->due_date->toDateString(), 
            'returned_date'  => $returned->toDateString(),
            'late_days'      => $lateDays,
            'late_fee'       => $lateDays * 5,
        ]);

        $borrowing->delete();
    }
}
}