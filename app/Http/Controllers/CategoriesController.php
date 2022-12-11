<?php

namespace App\Http\Controllers;

use App\Models\AddCategory;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function main_category()
    {
        $categories = AddCategory::all();
        return view('admin.categories.main_category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'date_added' => 'required'
        ]);

        AddCategory::create([
            'category_name' => $request->category_name,
            'date_added' => $request->date_added
        ]);

        return redirect()->back()->with('message', 'Product Category Added');
    }

    public function delete_category($id)
    {
        $categories = AddCategory::find($id);
        $categories->delete();
        return redirect()->back()->with('delete_message', 'Category has been deleted!');;
    }
}
