<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferCategoryRequest;
use App\Models\OfferCategory;

class OfferCategoryController extends Controller
{

    // Store a new category
    public function store(StoreOfferCategoryRequest $request)
    {
        $newCategory = OfferCategory::create($request->validated());
        $newCategory->save();
        $categories = OfferCategory::all();
        $images = [];


        return view('offres', [
            'categories' => $categories,
            'images' => $images,
            'selectedCategoryId' => $newCategory->id
        ]);
    }

    public function destroy($id)
    {
        $category = OfferCategory::findOrFail($id);
        $category->delete();

        return redirect()
            ->route('offer-images.index')
            ->with('success', 'Category deleted successfully.');
    }
}
