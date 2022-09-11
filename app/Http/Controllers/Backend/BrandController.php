<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView()
    {
        $allBrands = Brand::all();
        return view('admin.brand.brands', compact('allBrands'));
    }

    public function AddBrandPage()
    {
        return view('admin.brand.brand_add');
    }

    public function StoreBrand(Request $request)
    {
        $this->validate($request, [
            'brand_name_fr' => 'required|max:255',
            'brand_image' => 'required',
        ], [
            'brand_name_fr.required' => '*Le nom de la marque doit être renseigné',
            'brand_image.required' => '*L\'image de la marque doit être renseignée',
        ]);

        if ($request->hasFile('brand_image')) {
            if ($request->file('brand_image')->isValid()) {
                $file = $request->file('brand_image');
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

                Image::make($file)->resize(300, 300)->save(public_path('backend/upload/').$filename);

                $brand_image = 'backend/upload/'.$filename;
            }
        }

        Brand::insert([
            'brand_name_fr' => $request->brand_name_fr,
            'brand_slug_fr' => strtolower(str_replace(' ', '-', $request->brand_name_fr)),
            'brand_image' => $brand_image,
        ]);

        return redirect('/admin/brand');
    }

    public function DeleteBrand($id)
    {
        Brand::find($id)->delete();

        $allBrands = Brand::all();
        return view('admin.brand.brands', compact('allBrands'));
    }
}
