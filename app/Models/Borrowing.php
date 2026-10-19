<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrowing extends Model
{

    use HasFactory;

    protected $primaryKey = 'borrowing_id';

    protected $fillable = [
        'student_id',
        'equipment_id',
        'borrowed_date',
        'due_date',
        'purpose',
        'status',
        'released_by',
    ];

    public $casts = ['borrowed_date' => 'date', 'due_date' => 'date'];

    public const STATS = [
    'status' => ['borrowed', 'overdue'],
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function return()
    {
        return $this->hasOne(ReturnRecord::class, 'borrowing_id');
    }
}
