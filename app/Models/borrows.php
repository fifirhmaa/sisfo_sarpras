<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'purposes',
        'borrow_date',
        'return_date',
        'status',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Items::class, 'item_id', 'id');
    }

// In app/Models/Borrow.php
    public function return()
    {
        return $this->hasOne(Returns::class, 'borrow_id');
    }
}