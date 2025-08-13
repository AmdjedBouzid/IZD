<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;


class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'huge_title', 'description'];
    
    public $timestamps = false;
    
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($company) {
            foreach ($company->services as $service) {
                if ($service->image_path) {
                    Storage::disk('public')->delete($service->image_path);
                }
            }

            $company->services()->delete();
        });
    }
}
