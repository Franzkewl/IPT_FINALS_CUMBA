<?php

namespace Database\Seeders;

use App\Models\Borrowing;
use App\Models\ReturnRecord;
use Illuminate\Database\Seeder;

class ReturnRecordSeeder extends Seeder
{
    public function run(): void
    {
        $borrowings = Borrowing::where('status', 'borrowed')->inRandomOrder()->limit(10)->get();

    foreach ($borrowings as $borrowing) {
    $returned = $borrowing->borrowed_date->copy()->addDays(rand(1, 12));  
    if ($returned->gt(today())) {
        $returned = today();                                             
    }
    $lateDays = max(0, $borrowing->due_date->diffInDays($returned, false));

    ReturnRecord::factory()->create([
        'borrowing_id'  => $borrowing->borrowing_id,
        'returned_date' => $returned->toDateString(),
        'late_days'     => (int) $lateDays,
        'late_fee'      => (int) $lateDays * 5,    
    ]);

    $borrowing->update(['status' => 'returned']);
    
}
    }
}