<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform'  => 'required',
            'value' => 'required|string|max:255',
        ]);
        
        try {
            Contact::create($data);
            
            return redirect()
                ->route('contacts.index')
                ->with('success', 'Contact created successfully.');
            } catch (\Throwable $e) {
                Log::error('Contact creation failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong while creating the contact.']);
        }
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }
    
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'platform'  => 'required',
            'value' => 'required|string|max:255',
        ]);

        try {
            $contact->update($data);

            return redirect()
                ->route('contacts.index')
                ->with('success', 'Contact updated successfully.');
        } catch (\Throwable $e) {
            Log::error('Contact update failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['general' => 'Something went wrong while updating the contact.']);
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();

            return redirect()
                ->route('contacts.index')
                ->with('success', 'Contact deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Contact deletion failed: ' . $e->getMessage());

            return redirect()
                ->route('contacts.index')
                ->withErrors(['general' => 'Something went wrong while deleting the contact.']);
        }
    }
}
