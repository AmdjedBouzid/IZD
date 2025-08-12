<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Metadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_name',
        'website_logo_path',
        'huge_title',
        'description',
        'font_color',
    ];

    public $timestamps = false;
}
