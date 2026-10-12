<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $primaryKey = 'student_id';

    protected $fillable = [
        'first_name',
        'middle_initial',
        'last_name',
        'course',
        'year_level',
        'gender',
        'birthdate',
        'contact_number',
        'email',
        'total_borrowed_items',
    ];

    public function borrowing()
    {
        return $this->hasMany(Borrowing::class, 'student_id');
    }
}
