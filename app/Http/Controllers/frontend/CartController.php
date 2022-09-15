<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);

        $this->validate($request, [
            'chosen_quantity' => 'required',
            'color' => 'required',
            'size' => 'required',
        ], [
            'required' => '*Cet élément doit être renseigné',
        ]);

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

        $vv =  Session::forget('coupon');

        return redirect('/');
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

    public function ShippingForm()
    {
        if (Cart::subtotal() > 0) {
            $carts = Cart::content();

            $total_price = 0;
            foreach($carts as $item) {
                $discounted_price = $item->qty * ($item->price - $item->options->discount);
                $total_price += $discounted_price;
            }
            if (session()->get('coupon_discount')) {
                $total_price = $total_price - session()->get('coupon_discount');
            }
            return view('frontend.checkout.shipping_form', compact('carts', 'total_price'));

        } else {
            return redirect()->back();
        }
    }

    public function CheckoutView(Request $request)
    {
        $carts = Cart::content();

        $total_price = 0;
        foreach($carts as $item) {
            $discounted_price = $item->qty * ($item->price - $item->options->discount);
            $total_price += $discounted_price;
        }
        if (session()->get('coupon_discount')) {
            $total_price = $total_price - session()->get('coupon_discount');
        }

        session()->forget('shipping');
        Session::put('shipping', [
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address,
            'notes' => $request->notes,
        ]);

        $shipping = session()->get('shipping');

        return view('frontend.checkout.checkout_view', compact('carts', 'total_price', 'shipping'));
    }

    public function StripeOrder()
    {
        $shipping = session()->get('shipping');

        $total_price = 0;
          foreach(Cart::content() as $item) {
              $discounted_price = $item->qty * ($item->price - $item->options->discount);
              $total_price += $discounted_price;
        }
        
        $order_id = Order::insertGetId([
            'user_id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'email' => $shipping['email'],
            'phone' => $shipping['phone'],
            'country' => $shipping['country'],
            'city' => $shipping['city'],
            'address' => $shipping['address'],
            'notes' =>  $shipping['notes'],
            
            'invoice_number' => 'EOS'.mt_rand(100000, 999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'Pending',
            'created_at' => Carbon::now(),
        ]);

        $carts = Cart::content();
        
        foreach($carts as $item) {
            Order_item::insert([
                'order_id' => $order_id,
                'product_id' => $item->id,
                'color' => $item->options->color,
                'size' => $item->options->size,
                'quantity' => $item->qty,
                'price' =>  $item->price - $item->options->discount,
                'created_at' => Carbon::now(),
            ]);
        }

        require_once __DIR__.'/../../../../vendor/autoload.php';
    
        \Stripe\Stripe::setApiKey('sk_test_51LRCAyBA6XPq8iANIynUyVnQg3VLuhzcFhfNuIA7XTINkE6K72xuhB14Dtzb9RJpcGLM69xpBq0c5dicPUqwEQDj00TXvMJePa');   
    
        if (session()->get('coupon_discount')) {
            $after_coupon_price = $total_price - session()->get('coupon_discount');
            
            if ($after_coupon_price <= 0) {
                $invoice = Order::find($order_id);
                $emailData = [
                    'invoice_number' => $invoice->invoice_number,
                    'name' => Auth::user()->name,
                ]; 
                Mail::to($shipping['email'])->send(new OrderMail($emailData));

                session()->flush();
                Cart::destroy(); 

                return redirect('/');
                
            } else {
                \Stripe\PaymentIntent::create([
                    'amount' => (int)$after_coupon_price*100,
                    'currency' => 'eur',
                    'metadata' => ['integration_check' => 'accept_a_payment'],
                ]);
            }
        } else {
            \Stripe\PaymentIntent::create([
                'amount' => (int)$total_price*100,
                'currency' => 'eur',
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);
        }

        $invoice = Order::find($order_id);
        $emailData = [
            'invoice_number' => $invoice->invoice_number,
            'name' => Auth::user()->name,
        ]; 
        Mail::to($shipping['email'])->send(new OrderMail($emailData));

        session()->flush();
        Cart::destroy();

        return redirect('/');
    }
}
