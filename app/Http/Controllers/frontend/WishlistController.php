<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{

    public function WishListView()
    {
        $products = Wishlist::where('user_id', Auth::user()->id)->paginate(3);

        $wishlist_products = [];
        $products_rating = [];
        foreach($products as $item) {
            $product = Product::where('id', $item->product_id)->get();
            array_push($wishlist_products, $product[0]);
            array_push($products_rating, Review::where('product_id', $item->product_id)->get('ranking'));
        }

        return view('frontend.wishlist', compact('wishlist_products', 'products_rating', 'products'));
    }

    public function StoreWishlist($id)
    {
        if (Auth::check()) {
            $exist = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->first();

            if (!$exist) {
                Wishlist::insert([
                    'product_id' => $id,
                    'user_id' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                ]);
            }
        }
        return redirect()->back();
    }

    public function RemoveWishlist($id)
    {
        Wishlist::where('product_id', $id)->delete();
        return redirect()->back();
    }
}