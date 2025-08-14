<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\OfferImage;
use App\Models\OfferCategory;
use App\Models\FooterColor;

class OfferImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:offer_categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);



        // Store file
        $path = $request->file('image')->store('offer_images', 'public');

        // Save in DB
        OfferImage::create([
            'image_path' => $path,
            'category_id' => $request->category_id
        ]);
        $newCategory = OfferCategory::find($request->category_id);
        $categories = OfferCategory::all();
        $images = OfferImage::where('category_id', $newCategory->id)
            ->get()
            ->map(function ($image) {
                $image->image_path = asset('storage/' . $image->image_path);
                return $image;
            });

        return view('offres', [
            'categories' => $categories,
            'images' => $images,
            'selectedCategoryId' => $newCategory->id
        ]);

        return redirect()
            ->route('offer-images.index')
            ->with('success', 'Image uploaded successfully.');
    }

    public function index(Request $request)
    {
        // Get category ID from request or default to first category
        $categoryId = $request->input('category_id');

        // If no category selected, pick the first available
        if (!$categoryId) {
            $firstCategory = OfferCategory::orderBy('id')->first();
            if (!$firstCategory) {
                // No categories at all → return empty data
                return view('offres', [
                    'categories' => [],
                    'images' => [],
                    'selectedCategoryId' => null
                ]);
            }
            $categoryId = $firstCategory->id;
        }

        // Get all categories
        $categories = OfferCategory::all();

        // Get images for selected category
        $images = OfferImage::where('category_id', $categoryId)
            ->get()
            ->map(function ($image) {
                // Make sure the path is full URL
                $image->image_path = asset('storage/' . $image->image_path);
                return $image;
            });

        return view('offres', [
            'categories' => $categories,
            'images' => $images,
            'selectedCategoryId' => $categoryId
        ]);
    }



    public function deleteMultiple(Request $request)
    {
        // Decode JSON-encoded data from frontend
        $ids = json_decode($request->input('ids'), true);
        $selectedCategoryId = json_decode($request->input('category_id'), true);

        // Ensure $ids is an array of integers
        $ids = array_map('intval', (array) $ids);
        $selectedCategoryId = intval($selectedCategoryId);

        if (empty($ids)) {
            return response()->json([
                'message' => 'No image IDs provided.'
            ], 400);
        }

        // Delete images from storage and DB
        $images = OfferImage::whereIn('id', $ids)->get();

        foreach ($images as $image) {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        // Fetch updated categories and images
        $categories = OfferCategory::all();

        $images = OfferImage::where('category_id', $selectedCategoryId)->get()->map(function ($image) {
            $image->image_path = asset('storage/' . $image->image_path);
            return $image;
        });

        // Return Blade partial with updated data
        return view('offres', [
            'categories' => $categories,
            'images' => $images,
            'selectedCategoryId' => $selectedCategoryId
        ]);
    }

    public function indexClient(Request $request)
    {
        // Get category ID or default to -1 (Toutes)
        $categoryId = $request->input('category_id', -1);

        // Get all real categories from DB
        $categories = OfferCategory::all();

        // Prepend the "Toutes" category without saving to DB
        $toutesCategory = (object)[
            'id' => -1,
            'name' => 'Toutes'
        ];
        $categories->prepend($toutesCategory);

        // Get images
        if ($categoryId == -1) {
            $images = OfferImage::all()
                ->map(function ($image) {
                    $image->image_path = asset('storage/' . $image->image_path);
                    return $image;
                });
        } else {
            $images = OfferImage::where('category_id', $categoryId)
                ->get()
                ->map(function ($image) {
                    $image->image_path = asset('storage/' . $image->image_path);
                    return $image;
                });
        }

        return view('offerclient', [
            'footerColors' => FooterColor::first(),
            'categories' => $categories,
            'images' => $images,
            'selectedCategoryId' => $categoryId,
        ]);
    }
}