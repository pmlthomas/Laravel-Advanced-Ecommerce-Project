@extends('admin.admin_master')
@section('admin')

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 450px;">
        <form method="post" action="{{ route('admin.sub_category.update') }}">
            @csrf

            <h3 style="margin-bottom: 15px;">Modifier une sous-catégorie</h3>

            <input type="hidden" value="{{ $id }}" name="id">

            <div class="form-group">
                <label class="info-title" for="sub_category_name_fr">Nom Français</label>
                <input type="text" name="sub_category_name_fr" value="{{ $old_sub_category->sub_category_name_fr }}" class="form-control unicase-form-control text-input" autofocus>
                @error('sub_category_name_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="sub_category_name_en">Nom Anglais</label>
                <input type="text" name="sub_category_name_en" value="{{ $old_sub_category->sub_category_name_en }}" class="form-control unicase-form-control text-input">
                @error('sub_category_name_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <label class="info-title" for="category_id">Catégorie</label>
            <select name="category_id" class="form-control" style="margin-bottom: 20px;">
                <option selected>{{ $old_sub_category['category']['category_name_fr'] }}</option>
                @foreach($allCategories as $item)

                    @if($item->category_name_fr !== $old_sub_category['category']['category_name_fr'])
                        <option value="{{ $item->category_id }}">{{ $item->category_name_fr }}</option>   
                    @endif
                    
                @endforeach
            </select>

            <button type="submit" class="btn-upper btn btn-primary btn-md checkout-page-button">Enregistrer les modifications</button>
        </form>
    </div>

@endsection