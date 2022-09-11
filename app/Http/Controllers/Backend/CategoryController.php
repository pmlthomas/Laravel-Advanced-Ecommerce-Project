<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{   
    public function CategoryView()
    {
        $allCategories = Category::all();
        return view('admin.category.categories', compact('allCategories'));
    }

    public function AddCategoryPage()
    {
        return view('admin.category.add_category');
    }

    public function StoreCategory(Request $request)
    {
        $this->validate($request, [
            'category_name_fr' => 'required',
            'category_name_en' => 'required',
        ], [
            'category_name_fr.required' => 'Le nom français de la catégorie doit être renseigné',
            'category_name_en.required' => 'Le nom anglais de la catégorie doit être renseigné',
        ]);

        Category::insert([
            'category_name_fr' => $request->category_name_fr,
            'category_name_en' => $request->category_name_en,
            'category_slug_fr' => strtolower(str_replace(' ', '-', $request->category_name_fr)),
            'category_slug_en' =>strtolower(str_replace(' ', '-', $request->category_name_en)),
        ]);

        $allCategories = Category::all();
        return redirect('/admin/category')->with('allCategories', $allCategories);
    }

    public function EditCategoryPage($id)
    {
        $old_category = Category::find($id);

        return view('admin.category.edit_category', compact('old_category', 'id'));
    }

    public function UpdateCategory(Request $request)
    {
        $old_category = Category::find($request->id);

        $old_category->update([
            'category_name_fr' => $request->category_name_fr,
            'category_name_en' => $request->category_name_en,
            'category_slug_fr' => strtolower(str_replace(' ', '-', $request->category_name_fr)),
            'category_slug_en' =>strtolower(str_replace(' ', '-', $request->category_name_en)),
        ]);

        $allCategories = Category::all();
        return redirect('/admin/category')->with('allCategories', $allCategories);
    }

    public function DeleteCategory($id)
    {
        Category::find($id)->delete();

        $allCategories = Category::all();
        return view('admin.category.categories', compact('allCategories'));
    }
}

