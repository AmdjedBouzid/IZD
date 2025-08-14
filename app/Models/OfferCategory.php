<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class OfferCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            foreach ($category->images as $images) {
                if ($images->image_path) {
                    Storage::disk('public')->delete($images->image_path);
                }
            }

            $category->images()->delete();
        });
    }

    /**
     * Relationship: A category has many images
     */
    public function images()
    {
        return $this->hasMany(OfferImage::class, 'category_id');
    }
}