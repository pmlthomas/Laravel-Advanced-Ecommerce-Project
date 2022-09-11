<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView()
    {
        $allSubSubCategories = SubSubCategory::all();
        return view('admin.sub_sub_category.sub_sub_categories', compact('allSubSubCategories'));
    }

    public function AddSubSubCategoryPage()
    {
        $allCategories = Category::all();
        $allSubCategories = SubCategory::all();
        return view('admin.sub_sub_category.add_sub_sub_category', compact('allCategories', 'allSubCategories'));
    }

    public function StoreSubSubCategory(Request $request)
    {
        $this->validate($request, [
            'sub_sub_category_name_fr' => 'required',
            'sub_sub_category_name_en' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ], [
            'sub_sub_category_name_fr.required' => 'Le nom français de la sous-sous-catégorie doit être renseigné',
            'sub_sub_category_name_en.required' => 'Le nom anglais de la sous-sous-catégorie doit être renseigné',
            'category_id.required' => 'La catégorie de la nouvelle sous-sous-catégorie doit être renseignée', 
            'sub_category_id.required' => 'La sous-catégorie de la nouvelle sous-sous-catégorie doit être renseignée', 
            
        ]);

        SubSubCategory::insert([
            'sub_sub_category_name_fr' => $request->sub_sub_category_name_fr,
            'sub_sub_category_name_en' => $request->sub_sub_category_name_en,
            'sub_sub_category_slug_fr' => strtolower(str_replace(' ', '-', $request->sub_sub_category_name_fr)),
            'sub_sub_category_slug_en' =>strtolower(str_replace(' ', '-', $request->sub_sub_category_name_en)),
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
        ]);

        $allSubSubCategories = SubSubCategory::all();
        return redirect('/admin/sub-sub-category')->with('allSubSubCategories', $allSubSubCategories);
    }

    public function EditSubSubCategoryPage($id)
    {
        $old_sub_sub_category = SubSubCategory::find($id);
        $allCategories = Category::all();
        $allSubCategories = SubCategory::all();

        return view('admin.sub_sub_category.edit_sub_sub_category', compact('old_sub_sub_category', 'id', 'allSubCategories', 'allCategories'));
    }

    public function UpdateSubSubCategory(Request $request)
    {
        $old_sub_sub_category = SubSubCategory::find($request->id);

        $old_sub_sub_category->update([
            'sub_sub_category_name_fr' => $request->sub_sub_category_name_fr,
            'sub_sub_category_name_en' => $request->sub_sub_category_name_en,
            'sub_sub_category_slug_fr' => strtolower(str_replace(' ', '-', $request->sub_sub_category_name_fr)),
            'sub_sub_category_slug_en' =>strtolower(str_replace(' ', '-', $request->sub_sub_category_name_en)),
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
        ]);

        $allSubSubCategories = SubSubCategory::all();

        return redirect('/admin/sub-sub-category')->with('allSubSubCategories', $allSubSubCategories);
    }

    public function DeleteSubSubCategory($id)
    {
        SubSubCategory::find($id)->delete();

        $allSubSubCategories = SubSubCategory::all();
        return view('admin.sub_sub_category.sub_sub_categories', compact('allSubSubCategories'));
    }   
}
