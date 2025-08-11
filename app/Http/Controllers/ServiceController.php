<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('company')->get();
        return view('services.index', ['services' => $services]);
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
            'image_path' => 'nullable|image|max:2048'
        ]);

        try {
            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('services', 'public');
            }

            Service::create($data);

            return redirect()
                ->route('services.index')
                ->with('success', 'Service created successfully.');

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
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
