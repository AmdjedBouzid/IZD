<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'category_id'];

    /**
     * Relationship: An image belongs to a category
     */
    public function category()
    {
        return $this->belongsTo(OfferCategory::class, 'category_id');
    }
}
