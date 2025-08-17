<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


use App\Models\Metadata;
use App\Models\Banner;

use App\Models\Contact;
use App\Models\FooterColor;

class ServiceController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $services = Service::with('company')->get();
        return view('services', compact('services', 'companies'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('services.create', compact('companies'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image'
        ]);

        try {
            Log::info('1');

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('services', 'public');
                Log::info('1.5');
            }

            Log::info('2');
            Service::create($data);
            Log::info('3');

            return redirect()
                ->route('services.index')
                ->with('success', 'Service créé avec succès.');
        } catch (\Throwable $e) {
            Log::error('Service creation failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the service.');
        }
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        $companies = Company::all();
        return view('services.edit', compact('service', 'companies'));
    }

    public function update(Request $request, Service $service)
    {
        Log::info('Creating service with data: ', $request->all());
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image'
        ]);


        if ($request->hasFile('image_path')) {
            Storage::disk('public')->delete($service->image_path);
            $validated['image_path'] = $request->file('image_path')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service)
    {
        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service supprimé avec succès.');
    }


    public function getService($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
        $service->load('company');
        $services = Service::with('company')->get();
        $contactIcons = config('contact-icons');
        $contacts = Contact::all()
            ->groupBy('platform')
            ->map(function ($group) {
                return $group;
            });
        return view('service_details', [
            'service' => $service,
            'footerColors' => FooterColor::first(),
            'companies' => Company::all(),
            'metadata' => Metadata::first(),
            'banners' => Banner::all(),
            'services' => $services,
            'contacts' => $contacts,
            'contactIcons' => $contactIcons,
        ]);
        // return response()->json([
        //     'service' => $service,
        //     'footerColors' => FooterColor::first(),
        //     'companies' => Company::all(),
        //     'metadata' => Metadata::first(),
        //     'banners' => Banner::all(),
        //     'services' => $services,
        //     'contacts' => $contacts,
        //     'contactIcons' => $contactIcons,
        // ]);
    }
}
