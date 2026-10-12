<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnRecord extends Model
{
    use HasFactory;

    protected $table = 'returns';
    protected $primaryKey = 'return_id';

    protected $fillable = [
        'borrowing_id',
        'returned_date',
        'condition',
        'late_days',
        'late_fee',
        'received_by',
    ];

    protected $casts = ['returned_date' => 'date',];

    public const CONDITIONS = [
        'condition' => ['good', 'damaged', 'lost'],
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrowing_id');
    }
}
