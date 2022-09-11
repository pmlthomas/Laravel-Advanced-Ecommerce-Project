<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function ProductView()
    {
        $allProducts = Product::all();
        return view('admin.product.products', compact('allProducts'));
    }

    public function AddProductPage()
    {
        $allCategories = Category::all();
        $allSubCategories = SubCategory::all();
        $allSubSubCategories = SubSubCategory::all();

        $allBrands = Brand::all();

        return view('admin.product.add_product', compact(
            'allCategories', 'allSubCategories', 'allSubSubCategories',
            'allBrands', 
        ));
    }

    public function StoreProduct(Request $request)
    {
        // Rules and Error Message
         $this->validate($request, [
            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'sub_sub_category_id' => 'required',
            'product_name_fr' => 'required',
            'product_name_en' => 'required',

            'product_quantity' => 'required',
            'product_tags_fr' => 'required',
            'product_tags_en' => 'required',
            'product_size_fr' => 'required',
            'product_size_en' => 'required',
            'product_color_fr' => 'required',
            'product_color_en' => 'required',
            'product_image' => 'required',
            'image' => 'required',

            'product_selling_price' => 'required',
            'product_short_desc_fr' => 'required',
            'product_short_desc_en' => 'required',
            'product_long_desc_fr' => 'required',
            'product_long_desc_en' => 'required',
         ], [
            'required' => '*Cet élément doit être rempli',
         ]);
            
        // Image and Inserting in Database
        $image_file = $request->file('product_image');
        $image_filename = hexdec(uniqid()).'.'.$image_file->getClientOriginalExtension();
        Image::make($image_file)->resize(917, 1000)->save(public_path('backend/upload/products/').$image_filename);
        $product_image = 'backend/upload/products/'.$image_filename;

        Product::insert([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
            'product_name_fr' => $request->product_name_fr,
            'product_name_en' => $request->product_name_en,
            'product_slug_fr' => strtolower(str_replace(' ', '-', $request->product_name_fr)),
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,

            'product_quantity' => $request->product_quantity,
            'product_tags_fr' => $request->product_tags_fr,
            'product_tags_en' => $request->product_tags_en,
            'product_size_fr' => $request->product_size_fr,
            'product_size_en' => $request->product_size_en,
            'product_color_fr' => $request->product_color_fr,
            'product_color_en' => $request->product_color_en,
            'product_image' => $product_image,

            'product_selling_price' => $request->product_selling_price,
            'product_discount_price' => $request->product_discount_price,
            'product_short_desc_fr' => $request->product_short_desc_fr,
            'product_short_desc_en' => $request->product_short_desc_en,
            'product_long_desc_fr' => $request->product_long_desc_fr,
            'product_long_desc_en' => $request->product_long_desc_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
        ]);

        // Multiple images
        $product = Product::where('product_name_fr', $request->product_name_fr)->get();

        $multi_img_files = $request->file('image');
        foreach ($multi_img_files as $item) {
            $multi_img_filename = hexdec(uniqid()).'.'.$item->getClientOriginalExtension();
            Image::make($item)->resize(917, 1000)->save(public_path('backend/upload/products/').$multi_img_filename);
           
            MultiImage::insert([
                'product_id' => $product[0]->id,
                'image' => 'backend/upload/products/'.$multi_img_filename,
            ]);
        }

        $allProducts = Product::all();
        return redirect('/admin/product')->with('allProducts', $allProducts);
    }

    public function EditProductPage($id)
    {
        $old_product = Product::find($id);
        $id = $old_product->id;
        
        $allCategories = Category::all();
        $allSubCategories = SubCategory::all();
        $allSubSubCategories = SubSubCategory::all();
        $allBrands = Brand::all();
        $multi_images = MultiImage::where('product_id', $id)->get();

        return view('admin.product.edit_product', compact('old_product', 'multi_images', 'id', 'allCategories', 'allSubCategories', 'allSubSubCategories', 'allBrands'));
    }

    public function UpdateProduct(Request $request)
    {
        $old_product = Product::find($request->id);

        // Rules and Error Message
        $this->validate($request, [
            'brand_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'sub_sub_category_id' => 'required',
            'product_name_fr' => 'required',
            'product_name_en' => 'required',

            'product_quantity' => 'required',
            'product_tags_fr' => 'required',
            'product_tags_en' => 'required',
            'product_size_fr' => 'required',
            'product_size_en' => 'required',
            'product_color_fr' => 'required',
            'product_color_en' => 'required',
            'product_image' => 'required',

            'product_selling_price' => 'required',
            'product_short_desc_fr' => 'required',
            'product_short_desc_en' => 'required',
            'product_long_desc_fr' => 'required',
            'product_long_desc_en' => 'required',
        ], [
            'required' => '*Cet élément doit être rempli',
        ]);

        // Image and Updating
        $image_file = $request->file('product_image');
        $image_filename = hexdec(uniqid()).'.'.$image_file->getClientOriginalExtension();
        Image::make($image_file)->resize(917, 1000)->save(public_path('backend/upload/products/').$image_filename);
        $product_image = 'backend/upload/products/'.$image_filename;

        $old_product->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'sub_sub_category_id' => $request->sub_sub_category_id,
            'product_name_fr' => $request->product_name_fr,
            'product_name_en' => $request->product_name_en,
            'product_slug_fr' => strtolower(str_replace(' ', '-', $request->product_name_fr)),
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_code' => $request->product_code,

            'product_quantity' => $request->product_quantity,
            'product_tags_fr' => $request->product_tags_fr,
            'product_tags_en' => $request->product_tags_en,
            'product_size_fr' => $request->product_size_fr,
            'product_size_en' => $request->product_size_en,
            'product_color_fr' => $request->product_color_fr,
            'product_color_en' => $request->product_color_en,
            'product_image' => $product_image,

            'product_selling_price' => $request->product_selling_price,
            'product_discount_price' => $request->product_discount_price,
            'product_short_desc_fr' => $request->product_short_desc_fr,
            'product_short_desc_en' => $request->product_short_desc_en,
            'product_long_desc_fr' => $request->product_long_desc_fr,
            'product_long_desc_en' => $request->product_long_desc_en,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
        ]);

        // Multiple images Updating

        $multi_img_files = $request->file('image');
        foreach ($multi_img_files as $item) {
            $multi_img_filename = hexdec(uniqid()).'.'.$item->getClientOriginalExtension();
            Image::make($item)->resize(917, 1000)->save(public_path('backend/upload/products/').$multi_img_filename);
            
            MultiImage::insert([
                'product_id' => $request->id,
                'image' => 'backend/upload/products/'.$multi_img_filename,
            ]);
        }
        
        $allProducts = Product::all();
        return redirect('/admin/product')->with('allProducts', $allProducts);
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id); 
        $product_image = ($product->product_image);
        unlink($product_image);
        Product::findOrFail($id)->delete();

        $images = MultiImage::where('product_id', $id)->get();
        foreach ($images as $item) {
            unlink($item->image);
            MultiImage::where('product_id', $id)->delete();
        }

        $allProducts = Product::all();
        return redirect('/admin/product')->with('allProducts', $allProducts);
    }   

    public function DeleteMultiImg($id)
    {
        MultiImage::find($id)->delete();

        return redirect()->back();
    }

    public function UpdateMultiImg(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $file = $request->file('image');
                $filename = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
                Image::make($file)->resize(917, 1000)->save(public_path('backend/upload/products/').$filename);
                $new_multi_img = 'backend/upload/products/'.$filename;

                MultiImage::find($id)->update([
                    'image' => $new_multi_img,
                ]);

                return redirect()->back();
            } else {
                return redirect('/admin/dashboard');
            }
        } else {
            return redirect('/admin/dashboard');
        }

    }

    public function ActivateProduct($id)
    {
        Product::find($id)->update(['status' => 1]);
        return redirect()->back();
    }

    public function InactivateProduct($id)
    {
        Product::find($id)->update(['status' => 0]);
        return redirect()->back();
    }

    public function ProductDetailsView($id)
    {
        $product = Product::find($id);
        $hot_deals_products = Product::where('hot_deals', 1)->limit(4)->get();
        $featured_products = Product::where('featured', 1)->get();

        $multi_images = MultiImage::where('product_id', $id)->limit(4)->get();

        $product_ratings = Review::where('product_id', $id)->get('ranking');
        $reviews = Review::where('product_id', $id)->get();
        $ratings_number = count($product_ratings);

        return view('frontend.product_details', compact('product', 'reviews', 'multi_images', 'product_ratings', 'ratings_number', ));
    }
}