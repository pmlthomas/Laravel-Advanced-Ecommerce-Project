@extends('admin.admin_master')
@section('admin')

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 450px;">
        <form method="post" action="{{ route('admin.category.store') }}">
            @csrf

            <h3 style="margin-bottom: 15px;">Ajouter une catégorie</h3>

            <div class="form-group">
                <label class="info-title" for="category_name_fr">Nom Français</label>
                <input type="text" name="category_name_fr" class="form-control unicase-form-control text-input" autofocus>
                @error('category_name_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="category_name_en">Nom Anglais</label>
                <input type="text" name="category_name_en" class="form-control unicase-form-control text-input">
                @error('category_name_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-upper btn btn-primary btn-md checkout-page-button">Ajouter la catégorie</button>
        </form>
    </div>

@endsection