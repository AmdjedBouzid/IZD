<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\FooterColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $colors = FooterColor::first();
        return view('contacts', compact('contacts', 'colors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform'  => 'required',
            'value' => 'required|string|max:255',
            'name' => 'required|string|max:255',
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

    public function update(Request $request, Contact $contact)
    {
        Log::info('Updating contact with data: ', request()->all());

        $data = $request->validate([
            'platform'  => 'sometimes',
            'value' => 'sometimes|string|max:255',
            'name' => 'sometimes|string|max:255',
            'primary'   => 'sometimes|string',
            'secondary' => 'sometimes|string',
            'items'     => 'sometimes|string',
        ]);


        
        try {

            $contact->update($data);
            $colors = FooterColor::first();
            $colors->update($request->only(['primary', 'secondary', 'items']));
            
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
