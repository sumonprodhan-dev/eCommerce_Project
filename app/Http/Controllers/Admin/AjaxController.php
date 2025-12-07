<?php

namespace App\Http\Controllers\Admin;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    public function getSubCategory(Request $request)
    {

        $category_id = $request->category_id;
        $subcategories = SubCategory::where('category_id', $category_id)->get();

        $data = '<option value="" selected disabled>Select Sub Category</option>';
        foreach ($subcategories as $subcategory) {
            $data .= '<option value="' . $subcategory->id . '">' . $subcategory->name . '</option>';
        }
        return response()->json($data);
    }
}
