<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'description',
        'is_active',
        'total_items',
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }

    public function refreshTotalItems(): void
    {
        $this->total_items = $this->equipment()->sum('quantity');
        $this->save();
    }

}
