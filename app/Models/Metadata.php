<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metadata extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'huge_title', 'description'];
    
    public $timestamps = false;
}