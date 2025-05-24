<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_item',
        'name',
        'category_id',
        'image',
        'stock',
        'condition',
        'location',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}