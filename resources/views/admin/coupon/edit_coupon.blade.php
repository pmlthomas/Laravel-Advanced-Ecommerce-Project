@extends('admin.admin_master')
@section('admin')

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 450px;">
        <form method="post" action="{{ route('admin.coupon.update') }}">
            @csrf

            <h3 style="margin-bottom: 15px;">Modifier le coupon</h3>

            <input type="hidden" name="id" value="{{ $old_coupon->id }}">

            <div class="form-group">
                <label class="info-title" for="coupon_name">Nom</label>
                <input type="text" name="coupon_name" class="form-control unicase-form-control text-input" autofocus>
                @error('coupon_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="coupon_discount">Réduction</label>
                <input type="text" name="coupon_discount" class="form-control unicase-form-control text-input">
                @error('coupon_discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="coupon_validity">Date de fin de validité</label>
                <input type="date" lang="fr" name="coupon_validity" class="form-control unicase-form-control text-input">
                @error('coupon_validity')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-upper btn btn-primary btn-md checkout-page-button">Enregister les modifications</button>
        </form>
    </div>

@endsection