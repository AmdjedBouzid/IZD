<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        $metadata = Metadata::first();
        return view('companies.index', ['companies'=>$companies, 'metadata' => $metadata]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            Company::create($validated);
            return redirect()
                ->route('companies.index')
                ->with('success', 'Company created successfully.');
        } catch (\Throwable $e) {
            Log::error('Company creation failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong while creating the company.']);
        }
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $company->update($validated);
            return redirect()
                ->route('companies.index')
                ->with('success', 'Company updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Company update failed: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong while updating the company.']);
        }
    }

    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return redirect()
                ->route('companies.index')
                ->with('success', 'Company deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Company deletion failed: ' . $e->getMessage());
            return redirect()
                ->route('companies.index')
                ->withErrors(['general' => 'Something went wrong while deleting the company.']);
        }
    }
}
