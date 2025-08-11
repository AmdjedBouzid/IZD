<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', ['companies'=>$companies]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'huge_title' => 'required|string|max:255',
            // 'description' => 'nullable|string'
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

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'huge_title' => 'required|string|max:255',
            // 'description' => 'nullable|string'
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
