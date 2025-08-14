<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Metadata;
use App\Models\Banner;
use App\Models\Service;
use App\Models\Contact;
use App\Models\FooterColor;

class LandingPageController extends Controller
{
    public function index()
    {
        $services = Service::with('company')->get();
        $contactIcons = config('contact-icons');
        $contacts = Contact::all()
            ->groupBy('platform')
            ->map(function ($group) {
                return $group;
            });

        return view('welcome', [
            'footerColors' => FooterColor::first(),
            'companies' => Company::all(),
            'metadata' => Metadata::first(),
            'banners' => Banner::all(),
            'services' => $services,
            'contacts' => $contacts,
            'contactIcons' => $contactIcons,
        ]);
    }
}
