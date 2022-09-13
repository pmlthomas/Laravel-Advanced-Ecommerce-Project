<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if($product->product_discount_price == NULL) {
            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name_fr, 
                'qty' => 1, 
                'price' => $product->product_selling_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_image,
                    'color' => $request->color,
                    'size' => $request->size,
                    'slug' => $product->product_slug_fr,
                ],
            ]);
            return redirect('/');
        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $product->product_name_fr, 
                'qty' => $request->chosen_quantity, 
                'price' => $product->product_selling_price, 
                'weight' => 1, 
                'options' => [
                    'image' => $product->product_image,
                    'color' => $request->color,
                    'size' => $request->size,
                    'slug' => $product->product_slug_fr,
                    'name_en' => $product->product_name_en,
                    'discount' => $product->product_discount_price,
                ],
            ]);
            return redirect('/');
        }
    }

    public function RemoveFromCart($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }

    public function CartPage()
    {
        return view('frontend.my_cart');
    }
}
