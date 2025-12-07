<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategory()
    {

        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {

        return $this->belongsTo(Brand::class);
    }

    public function productImages()
    {

        return $this->hasMany(ProductImage::class);
    }

    public function scopeActive($query)
    {

        return $query->where('status', true);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }
}
