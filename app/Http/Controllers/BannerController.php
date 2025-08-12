<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        
        return view('metadata', [
            'metadata' => Metadata::first(),
            'banners' => $banners]);
    }

    public function deleteMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:banners,id',
        ]);
        try { 
            $banners = Banner::whereIn('id', $request->ids)->get();
            foreach ($banners as $banner) {
                if ($banner->image_path) {
                    Storage::disk('public')->delete($banner->image_path);
                }
            }
            Banner::whereIn('id', $request->ids)->delete();
            return response()->json(['message' => 'Banners deleted successfully.']);
        } catch (\Throwable $e) {
            Log::error('Banner deletion failed: ' . $e->getMessage());
        
            return redirect()
                ->back()
                ->with('error', 'Something went wrong while deleting the banner.');
        }
    }
    
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'image_path' => 'nullable|image',
        ]);
        try {
            if ($request->hasFile('image_path')) {
                if (!Storage::disk('public')->exists('banners')) {
                    Storage::disk('public')->makeDirectory('banners');
                }
                $data['image_path'] = $request->file('image_path')->store('banners', 'public');
            }

            Banner::create($data);

            return redirect()
                ->route('banners&metadata')
                ->with('success', 'Banner created successfully.');
        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the banner.');
        }
    }
}


















