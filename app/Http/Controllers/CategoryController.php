<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Item_categorie;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{

    //category
    public function category_list()
    {
        $data = Item_categorie::all();
        return view('item.category_list', ['item_categories' => $data]);
    }
    public function add_category()
    {
        return view('item.add_category');
    }
    public function insert_category(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'full_name' => 'required|max:255|min:5|unique:students,full_name',

            'categories' => 'required',
            'description' => 'required',

        ], [
            'categories.required' => 'Categories field is required.',
            'description.required' => 'Categories Description field is required.',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }

        $save = new Item_categorie;

        $save->categories = $request->categories;
        $save->description = $request->description;
        $save->save();

        // Return a JSON response
        return response()->json(['message' => 'Category created successfully!']);

    }

    //view for edit
    public function edit_category($id)
    {
        $categorie = Item_categorie::findOrFail($id);
        return view('item.edit_category', compact('categorie'));
    }

    public function update_category($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'full_name' => 'required|max:255|min:5|unique:students,full_name',

            'categories' => 'required',
            'description' => 'required',

        ], [
            'categories.required' => 'Categories field is required.',
            'description.required' => 'Categories Description field is required.',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422); // 422 Unprocessable Entity status code for validation errors
        }
        $categorie = Item_categorie::getSingle($id);
        $categorie->categories = trim($request->categories);
        $categorie->description = trim($request->description);
        $categorie->save();

        return redirect('item/category_list')->with('success', "Category successfully Updated");
    }
    public function delete_category($id)
    {
        $categorie = Item_categorie::findOrFail($id);
        // Delete the item from the database
        $categorie->delete();

        return redirect('item/category_list')->with('success', "Category successfully delete");
    }



    //Color
    // public function color_list()
    // {
    //     $data = Item_categorie::all();
    //     return view('item.color_list', ['item_categories' => $data]);
    // }
    // public function add_color()
    // {
    //     return view('item.add_color');
    // }
    // public function insert_color(Request $request)
    // {
    //     $save = new Item_categorie;

    //     $save->categories = $request->categories;
    //     $save->description = $request->description;
    //     $save->save();

    //     return redirect('item/item')->with('success', "Color successfully Add");
    // }

    // //view for edit
    // public function edit_color($id)
    // {
    //     $categorie = Item_categorie::findOrFail($id);
    //     return view('item.edit_color', compact('categorie'));
    // }

    // public function update_color($id, Request $request)
    // {
    //     $categorie = Item_categorie::getSingle($id);
    //     $categorie->categories = trim($request->categories);
    //     $categorie->description = trim($request->description);
    //     $categorie->save();

    //     return redirect('item/color_list')->with('success', "Color successfully Updated");
    // }
    // public function delete_color($id)
    // {
    //     $categorie = Item_categorie::findOrFail($id);
    //     // Delete the item from the database
    //     $categorie->delete();

    //     return redirect('item/color_list')->with('success', "Color successfully delete");
    // }
}
