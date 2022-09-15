<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function CouponsView()
    {
        $allCoupons = Coupon::all();
        return view('admin.coupon.coupon_view', compact('allCoupons'));
    }

    public function AddCouponPage()
    {
        return view('admin.coupon.add_coupon');
    }

    public function StoreCoupon(Request $request)
    {
        $this->validate($request, [
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ], [
            'required' => '*Cet élément doit être renseigné',
        ]);  

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => str_replace('-', '/', $request->coupon_validity),
            'created_at' => Carbon::now(),
        ]);

        return redirect('admin/coupons');
    }

    public function EditCouponPage($id)
    {
        $old_coupon = Coupon::find($id);
        return view('admin.coupon.edit_coupon', compact('old_coupon'));
    }

    public function UpdateCoupon(Request $request)
    {
        $old_coupon = Coupon::find($request->id);

        $this->validate($request, [
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ], [
            'required' => '*Cet élément doit être renseigné',
        ]);  

        $old_coupon->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
        ]);

        return redirect('admin/coupons');
    }

    public function DeleteCoupon($id)
    {
        Coupon::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function ApplyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->get();

        if(!empty($coupon)) {
            if($coupon[0]->coupon_validity <= Carbon::now()->format('Y/m/d')) {
                Session::put('coupon_discount', $coupon[0]->coupon_discount);
                Session::put('coupon_name', $coupon[0]->coupon_name);
            }
        }
        return redirect()->back();
    }

    public function RemoveCoupon()
    {
        Session::remove('coupon_discount');
        Session::remove('coupon_name');
        return redirect()->back();
    }
}
