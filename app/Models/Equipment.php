<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';

    protected $primaryKey = 'equipment_id';

    protected $fillable = [
        'equipment_name',
        'description',
        'quantity',
        'category_id',
        'status',
    ];

    public const CONDITIONS = [
        'status' => ['available', 'borrowed', 'maintenance'],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function borrowing()
    {
        return $this->hasMany(Borrowing::class, 'equipment_id');
    }
}
