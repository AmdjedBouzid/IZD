<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'huge_title', 'description'];
    
    public $timestamps = false;

    public function services()
    {
        return $this->hasMany(Service::class);
    }

}