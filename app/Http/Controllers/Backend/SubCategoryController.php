<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $allSubCategories = SubCategory::all();
        return view('admin.sub_category.sub_categories', compact('allSubCategories'));
    }

    public function AddSubCategoryPage()
    {
        $allCategories = Category::all();
        return view('admin.sub_category.add_sub_category', compact('allCategories'));
    }

    public function StoreSubCategory(Request $request)
    {
        $this->validate($request, [
            'sub_category_name_fr' => 'required',
            'sub_category_name_en' => 'required',
            'category_id' => 'required',
        ], [
            'sub_category_name_fr.required' => 'Le nom français de la sous-catégorie doit être renseigné',
            'sub_category_name_en.required' => 'Le nom anglais de la sous-catégorie doit être renseigné',
            'category_id.required' => 'La catégorie de la nouvelle sous-catégorie doit être renseignée', 
        ]);

        SubCategory::insert([
            'sub_category_name_fr' => $request->sub_category_name_fr,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_slug_fr' => strtolower(str_replace(' ', '-', $request->sub_category_name_fr)),
            'sub_category_slug_en' =>strtolower(str_replace(' ', '-', $request->sub_category_name_en)),
            'category_id' => $request->category_id,
        ]);

        $allSubCategories = SubCategory::all();
        return redirect('/admin/sub-category')->with('allSubCategories', $allSubCategories);
    }

    public function EditSubCategoryPage($id)
    {
        $old_sub_category = SubCategory::find($id);
        $allCategories = Category::all();

        return view('admin.sub_category.edit_sub_category', compact('old_sub_category', 'id', 'allCategories'));
    }

    public function UpdateSubCategory(Request $request)
    {
        $old_sub_category = SubCategory::find($request->id);

        $old_sub_category->update([
            'sub_category_name_fr' => $request->sub_category_name_fr,
            'sub_category_name_en' => $request->sub_category_name_en,
            'sub_category_slug_fr' => strtolower(str_replace(' ', '-', $request->sub_category_name_fr)),
            'sub_category_slug_en' =>strtolower(str_replace(' ', '-', $request->sub_category_name_en)),
        ]);

        $allSubCategories = SubCategory::all();

        return redirect('/admin/sub-category')->with('allSubCategories', $allSubCategories);
    }

    public function DeleteSubCategory($id)
    {
        SubCategory::find($id)->delete();

        $allSubCategories = SubCategory::all();
        return view('admin.sub_category.sub_categories', compact('allSubCategories'));
    }   
}
