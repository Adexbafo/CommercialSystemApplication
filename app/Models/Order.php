<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * These are the columns we allow to be saved via Order::create()
     */
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'items',
    ];

    /**
     * The attributes that should be cast.
     * This turns the 'items' JSON from the database back into a PHP array automatically.
     */
    protected $casts = [
        'items' => 'array',
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}