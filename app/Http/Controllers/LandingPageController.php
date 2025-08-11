<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Metadata;
use App\Models\Banner;

class LandingPageController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $metadata = Metadata::first();

        return view('welcome', [
            'companies' => $companies,
            'metadata' => $metadata,
            'banners' => Banner::all()
        ]);
    }
}
