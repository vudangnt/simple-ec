<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'brand_id', 'status', 'description', 'price', 'sort'
    ];

    /**
     * get product image
     */
    public function images() {
        return $this->hasMany(Images::class, 'product_id');
    }

    /** get brand product */
    public function brand() {
        return $this->belongsTo(Brands::class, 'brand_id');
    }
}
