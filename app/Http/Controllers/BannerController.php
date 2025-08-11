<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', [
            'banners' => $banners]);
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'image_path' => 'nullable|image|max:2048',
            ]);

            if ($request->hasFile('image_path')) {
                $data['image_path'] = $request->file('image_path')->store('banners', 'public');
            }

            Banner::create($data);

            return redirect()
                ->route('banners.index')
                ->with('success', 'Banner created successfully.');
        } catch (\Throwable $e) {
            Log::error('Banner creation failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the banner.');
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $banner->delete();

            return redirect()
                ->route('banners.index')
                ->with('success', 'Banner deleted successfully.');
        } catch (\Throwable $e) {
            Log::error('Banner deletion failed: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Something went wrong while deleting the banner.');
        }
    }
}


















