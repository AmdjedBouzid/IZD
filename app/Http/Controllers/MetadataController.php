<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MetadataController extends Controller
{
    public function update(Request $request, Metadata $metadata)
    {

        $validated = $request->validate([
            'website_name' => 'sometimes|string|max:255',
            'huge_title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'website_logo_path' => 'sometimes|image',
            'font_color' => 'sometimes|string|max:20',
        ]);
        try {
            if ($request->hasFile('website_logo_path')) {
                Storage::disk('public')->delete($metadata->website_logo_path);
                $filePath = $request->file('website_logo_path')->store('logos', 'public');
                $validated['website_logo_path'] = $filePath;
            } else {
                unset($validated['website_logo_path']);
            }

            $metadata->update($validated);

            return redirect()->route('banners&metadata')->with('success', 'Metadonnées mises à jour avec succès.');
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong while deleting the banner.');
        }
    }
}
