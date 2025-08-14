<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Relationship: A category has many images
     */
    public function images()
    {
        return $this->hasMany(OfferImage::class, 'category_id');
    }
}
