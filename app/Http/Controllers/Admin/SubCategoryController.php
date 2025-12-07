<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->get();
        return view('admin.sub_category.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug|max:255',
        ]);

        try {

            SubCategory::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
            ]);
            notyf()->success('Sub Category created successfully.');
            return redirect()->route('admin.subcategory.index');
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data['subCategory'] = SubCategory::findOrFail($id);
       $data['categories']  = Category::get();
       return view('admin.sub_category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:sub_categories,slug,' . $subCategory->id . '|max:255',
        ]);

        try {

            $subCategory->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
            ]);
            notyf()->success('Sub Category updated successfully.');
            return redirect()->route('admin.subcategory.index');
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $subCategory->delete();
        notyf()->success('Sub Category deleted successfully.');
        return redirect()->route('admin.subcategory.index');
    }
}
