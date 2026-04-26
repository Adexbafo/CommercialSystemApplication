<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // These fields are now "unlocked" for mass assignment
    protected $fillable = ['name', 'slug'];

    /**
     * Relationship: One category has many products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}