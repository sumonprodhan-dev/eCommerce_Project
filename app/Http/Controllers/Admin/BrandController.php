<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::get();
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug|max:255',
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
        ]);


        try {

            $file_path = $this->uploadMedia($request);

            Brand::create([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $file_path,
            ]);
            notyf()->success('Brand created successfully.');

            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
             Illuminate\Support\Facades\Log::error($e->getMessage());
            notyf()->error($e->getMessage());
            return redirect()->back();
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
        $brand = Brand::findOrFail($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {



        $brand = Brand::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:brands,slug,' . $brand->id . '|max:255',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
        ]);


        try {

            if ($request->hasFile('image')) {
                $file_path = $this->uploadMedia($request, $brand);
            } else {
                $file_path = $brand->image;
            }

            $brand->update([
                'name' => $request->name,
                'slug' => Str::slug($request->slug),
                'image' => $file_path,
            ]);

            notyf()->success('Brand updated successfully.');

            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
             Illuminate\Support\Facades\Log::error($e->getMessage());
            notyf()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $brand = Brand::findOrFail($id);

        if (isset($brand->image) && File::exists(public_path($brand->image))) {
            unlink($brand->image);
        }
        $brand->delete();
        notyf()->success('Brand deleted successfully.');
        return redirect()->route('admin.brand.index');
    }


    protected function uploadMedia($request, $brand = null)
    {

        if ($request->hasFile('image')) {

            // Delete old image if it exists
            if (isset($brand->image) && File::exists(public_path($brand->image))) {
                unlink(public_path($brand->image));
            }

            // Set properties
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/brand/';

            // Create directory if it does not exist
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true, true);
            }

            // Move image to path
            $image->move(public_path($path), $imageName);

            return $path . $imageName;
        }
    }
}
