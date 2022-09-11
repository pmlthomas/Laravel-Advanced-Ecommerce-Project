@extends('admin.admin_master')
@section('admin')

    <script src="jquery-3.6.0.min.js"></script>

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 450px;">
        <form method="post" action="{{ route('admin.sub_category.store') }}">
            @csrf

            <h3 style="margin-bottom: 15px;">Ajouter une sous-catégorie</h3>

            <label class="info-title" for="category_id">Catégorie</label>
            <select name="category_id" class="form-control" style="margin-bottom: 20px;">
                @foreach($allCategories as $item)
                    <option value="{{ $item->id }}">{{ $item->category_name_fr }}</option>
                @endforeach
            </select>

            <div class="form-group">
                <label class="info-title" for="sub_category_name_fr">Nom Français</label>
                <input type="text" name="sub_category_name_fr" class="form-control unicase-form-control text-input" autofocus>
                @error('sub_category_name_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="sub_category_name_en">Nom Anglais</label>
                <input type="text" name="sub_category_name_en" class="form-control unicase-form-control text-input">
                @error('sub_category_name_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
<!-- 
            <div class="form-group">
                <label for="sub_category_icon" class="info-title">Icone de la catégorie</label>
                <input type="text" name="sub_category_icon" class="form-control unicase-form-control text-input">
                @error('sub_category_icon')
                    <div>
                        <span class="text-danger">{{ $message }}</span>
                    </div>
                @enderror
            </div> -->

            <button type="submit" class="btn-upper btn btn-primary btn-md checkout-page-button">Ajouter la sous-catégorie</button>
        </form>
    </div>

@endsection