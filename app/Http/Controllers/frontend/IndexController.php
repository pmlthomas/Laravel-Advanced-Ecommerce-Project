<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\MultiImage;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Image;

class IndexController extends Controller
{
    public function Index()
    {
        $allCategories = Category::all();
        $allSliders = HomeSlider::where('status', 1)->get();

        $new_products = Product::orderBy('id', 'DESC')->limit(6)->get();
        $hot_deals_products = Product::where('hot_deals', 1)->limit(4)->get();
        $featured_products = Product::where('featured', 1)->limit(6)->get();
        $special_deals_products = Product::where('special_deals', 1)->limit(4)->get();
        $special_offers_products = Product::where('special_offer', 1)->limit(4)->get();
        $allBrands = Brand::limit(6)->get();

        return view('frontend.index', compact('allSliders', 'allCategories', 'new_products', 'featured_products', 'hot_deals_products', 'allBrands', 'special_deals_products', 'special_offers_products'));
    }

    public function AuthForms()
    {
        return view('auth.login');
    }

    public function UserProfile()
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);
        return view('frontend.user_profile', compact('userInfos'));
    }

    public function EditUserProfilePage()
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);
        return view('frontend.user_edit_profile', compact('userInfos'));
    }

    public function UpdateUserProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);

        if ($request->hasFile('profile_image')) {
            if ($request->file('profile_image')->isValid()) {
                $file = $request->file('profile_image');
                $filename = 'profile-photos/'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

                Image::make($file)->save(public_path('storage/').$filename);

                $userInfos->profile_photo_path = $filename;
                $userInfos->save();
            }
        }

        $userInfos->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return view('frontend.user_profile', compact('userInfos'));
    }

    public function EditPasswordPage()
    {
        return view('frontend.user_edit_password');
    }

    public function UpdatePassword(Request $request)
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);

        if (Hash::check($request->current_password, $userInfos->password) ) {
            if ($request->new_password == $request->confirm_password) {
                $userInfos->password = Hash::make($request->new_password);
                $userInfos->save(); 

                $userInfos = User::find($userId);

                return view('frontend.user_profile', compact('userInfos'));
            } else {
                return view('frontend.user_edit_password');
            }
        } else {
            return view('frontend.user_edit_password');
        }
    }

    public function ProductDetailsView($id, $slug)
    {
        $product = Product::find($id);
        $hot_deals_products = Product::where('hot_deals', 1)->limit(4)->get();
        $featured_products = Product::where('featured', 1)->get();

        $product_sub_category_id = $product->sub_category_id;
        $related_products = Product::where('sub_category_id', $product_sub_category_id)->get();

        $multi_images = MultiImage::where('product_id', $id)->limit(4)->get();

        $product_ratings = Review::where('product_id', $id)->get('ranking');
        $reviews = Review::where('product_id', $id)->get();
        $ratings_number = count($product_ratings);

        $product_color_fr = explode(',', $product->product_color_fr);
        $product_color_en = explode(',', $product->product_color_en);

        $product_size_fr = explode(',', $product->product_size_fr);
        $product_size_en = explode(',', $product->product_size_en);

        return view('frontend.product_details', compact(
            'product', 'reviews', 'multi_images', 'product_ratings', 'ratings_number', 'hot_deals_products', 'related_products',
            'product_color_fr', 'product_color_en', 'product_size_fr', 'product_size_en',
        ));
    }

    public function SubCategoryProducts($id, $slug)
    {
        $sub_category_products = Product::where('sub_category_id', $id)->paginate(6);
        $allCategories = Category::all();
        $product_ratings = Review::where('product_id', $id)->get('ranking');    

        return view('frontend.sub_category_products', compact('sub_category_products', 'allCategories', 'product_ratings'));
    }
    
    public function SubSubCategoryProducts($id, $slug)
    {
        $sub_sub_category_products = Product::where('sub_sub_category_id', $id)->paginate(6);
        $allCategories = Category::all();
        $product_ratings = Review::where('product_id', $id)->get('ranking');

        return view('frontend.sub_sub_category_products', compact('sub_sub_category_products', 'allCategories', 'product_ratings'));
    }

    public function UserOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10); 
        return view('frontend.user_orders', compact('orders'));
    }

    public function SeeUserOrders($id)
    {
        $order = Order::find($id);
        $order_items = Order_item::where('order_id', $id)->get();

        return view('frontend.user_see_order', compact('order', 'order_items'));
    }

    public function DownloadInvoice($id)
    {
        $order = Order::find($id);
        $order_items = Order_item::where('order_id', $id)->get();

        $pdf = Pdf::loadView('frontend.download_invoice', compact('order', 'order_items'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('facture.pdf');
    }

    public function CancelOrder(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->update([
            'cancel_date' => Carbon::now('Europe/Paris')->format('d F Y h:i'),
            'return_reason' => $request->cancel_reason,
            'status' => 'Canceled'
        ]);
        return redirect('/mes-commandes');
    }

    public function SearchProduct(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
        ]);

        $searched_products = Product::where('product_name_fr', 'LIKE', "%$request->search%")->paginate(6); 
        $allCategories = Category::all();
        $search = $request->search;

        return view('frontend.product_search', compact('searched_products', 'allCategories', 'search'));
    }     

    public function SortByPrice(Request $request)
    {
       $price_range = explode(',', $request->price_range);
       $minPrice = $price_range[0];
       $maxPrice = $price_range[3];

       $searched_products = Product::where('product_name_fr', 'LIKE', "%$request->search%")->whereBetween('product_selling_price', [$minPrice, $maxPrice])->get();
       $allCategories = Category::all();
       $search = $request->search;
       
       return view('frontend.product_search', compact('searched_products', 'allCategories', 'search'));
    }
}
