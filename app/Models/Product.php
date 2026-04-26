<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name', 
    'description', 
    'price', 
    'quantity', 
    'image', 
    'category_id' // Ensure this is here
];

// Also, add the relationship so a product knows its category
public function category()
{
    return $this->belongsTo(Category::class);
}



}