<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'title', 'description', 'image_path'];
    public $timestamps = false;
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
