@extends('admin.admin_master')
@section('admin')

    <style>
        .select {
            margin-right: 20px;
            min-width: 150px;
        }
        p {
            font-size: 0.8em;
        }
    </style>

    <script src="jquery-3.6.0.min.js"></script>

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 30px;">
        <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf

            <h3 style="margin-bottom: 15px;">Ajouter un produit</h3>

            <div style="display: flex;">
                <div class="select" style="display: flex; flex-direction: column;">
                    <label class="info-title" for="category_id">Catégorie</label>
                    <select name="category_id" class="form-control" style="margin-bottom: 20px;">
                        @foreach($allCategories as $item)
                            <option value="{{ $item->id }}">{{ $item->category_name_fr }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="select" style="display: flex; flex-direction: column;">
                    <label class="info-title" for="sub_category_id">Sous-catégorie</label>
                    <select name="sub_category_id" class="form-control" style="margin-bottom: 20px;">
                        @foreach($allSubCategories as $item)
                            <option value="{{ $item->id }}">{{ $item->sub_category_name_fr }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="select" style="display: flex; flex-direction: column;">
                    <label class="info-title" for="sub_sub_category_id">Sous-sous-catégorie</label>
                    <select name="sub_sub_category_id" class="form-control" style="margin-bottom: 20px;">
                        @foreach($allSubSubCategories as $item)
                            <option value="{{ $item->id }}">{{ $item->sub_sub_category_name_fr }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="select" style="display: flex; flex-direction: column;">
                    <label class="info-title" for="brand_id">Marque</label>
                    <select name="brand_id" class="form-control" style="margin-bottom: 20px;">
                        @foreach($allBrands as $item)
                            <option value="{{ $item->id }}">{{ $item->brand_name_fr }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: flex;">
                <div class="form-group">
                    <label class="info-title" for="product_name_fr">Nom Français</label>
                    <input style="width: 250px; margin-right: 20px;" type="text" name="product_name_fr" class="form-control unicase-form-control text-input" autofocus>
                    @error('product_name_fr')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="info-title" for="product_name_en">Nom Anglais</label>
                    <input style="width: 250px; margin-right: 20px;" type="text" name="product_name_en" class="form-control unicase-form-control text-input">
                    @error('product_name_en')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="info-title" for="product_code">Code produit</label>
                    <input style="width: 250px;" type="text" name="product_code" class="form-control unicase-form-control text-input">
                    @error('product_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="display: flex; flex-direction: column;">
                <div style="display: flex;">
                    <div class="select" style="display: flex; flex-direction: column; margin-right: -80px;">
                        <div class="form-group">
                            <label class="info-title" for="product_short_desc_fr">Courte description Français</label>
                            <textarea name="product_short_desc_fr" style="width: 370px; height: 60px;"></textarea>
                            @error('product_short_desc_fr')
                                <span class="text-danger" style="margin-top: -10px;"><br>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="select" style="display: flex; flex-direction: column;">
                        <div class="form-group">
                            <label class="info-title" for="product_short_desc_en">Courte description Anglais</label>
                            <textarea name="product_short_desc_en" style="width: 370px; height: 60px;"></textarea>
                            @error('product_short_desc_en')
                                <span class="text-danger" style="margin-top: -10px;"><br>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div style="display: flex;">
                    <div class="select" style="display: flex; flex-direction: column; margin-right: -80px;">
                        <div class="form-group">
                            <label class="info-title" for="product_long_desc_fr">Longue description Français</label>
                            <textarea name="product_long_desc_fr" style="width: 370px; height: 120px;"></textarea>
                            @error('product_long_desc_fr')
                                <span class="text-danger" style="margin-top: -10px;"><br>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="select" style="display: flex; flex-direction: column;">
                        <div class="form-group">
                            <label class="info-title" for="product_long_desc_en">Longue description Anglais</label>
                            <textarea name="product_long_desc_en" style="width: 370px; height: 120px;"></textarea>
                            @error('product_long_desc_en')
                                <span class="text-danger" style="margin-top: -10px;"><br>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex;">
                <div class="form-group">
                    <label class="info-title" for="product_discount_price">Réduction</label>
                    <input style="width: 250px; margin-right: 20px;" type="text" name="product_discount_price" class="form-control unicase-form-control text-input">
                    @error('product_discount_price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="info-title" for="product_quantity">Quantité</label>
                    <input style="width: 250px; margin-right: 20px;" type="text" name="product_quantity" class="form-control unicase-form-control text-input">
                    @error('product_quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="info-title" for="product_selling_price">Prix (sans symbole)</label>
                    <input style="width: 250px; margin-right: 20px;" type="text" name="product_selling_price" class="form-control unicase-form-control text-input">
                    @error('product_selling_price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="display: flex; flex-direction: column;">
                <div style="display: flex;">
                    <div style="display: flex; flex-direction: column; margin-right: 30px; max-width: 260px;">
                        <label for="product_tags_fr">Tags Français</label>
                        <input type="text" name="product_tags_fr" value="test, test, test" data-role="tagsinput">
                        @error('product_tags_fr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; margin-right: 30px; max-width: 260px;">
                        <label for="product_color_fr">Couleur Français</label>
                        <input type="text" name="product_color_fr" value="rouge, noir, vert" data-role="tagsinput">
                        @error('product_color_fr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; margin-right: 30px; max-width: 260px;">
                        <label for="product_size_fr">Taille Français</label>
                        <input type="text" name="product_size_fr" value="court, moyen, grand" data-role="tagsinput">
                        @error('product_size_fr')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div style="display: flex;">
                    <div style="display: flex; flex-direction: column; margin-right: 30px; max-width: 260px;">
                        <label for="product_tags_en" style="margin-top: 10px;">Tags Anglais</label>
                        <input type="text" name="product_tags_en" value="test, test, test" data-role="tagsinput">
                        @error('product_tags_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; margin-right: 30px; max-width: 260px;">
                        <label for="product_color_en" style="margin-top: 10px;">Couleur Anglais</label>
                        <input type="text" name="product_color_en" value="red, black, green" data-role="tagsinput">
                        @error('product_color_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: flex; flex-direction: column; max-width: 260px;">
                        <label for="product_size_en" style="margin-top: 10px; margin-right: 30px;">Taille Anglais</label>
                        <input type="text" name="product_size_en" value="small, medium, large" data-role="tagsinput">
                        @error('product_size_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div style="display: flex;">
                <div class="form-group">
                    <div style="display: flex; flex-direction: column;">
                        <label for="product_image" style="margin-top: 10px; margin-right: 30px;">Image</label>
                        <input type="file" name="product_image">
                        @error('product_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group" style="margin-right: -15px;">
                    <div style="display: flex; flex-direction: column;">
                        <label for="image" style="margin-top: 10px; margin-right: 30px;">Multi images</label>
                        <input type="file" name="image[]" multiple>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group" style="margin-top: 15px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_1" name="hot_deals" value="1">
                                    <label for="checkbox_1">Offres du moment</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_2" name="featured" value="1">
                                    <label for="checkbox_2">Mis en avant</label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="controls">
                                <fieldset>
                                    <input type="checkbox" id="checkbox_3" name="special_offer" value="1">
                                    <label for="checkbox_3">Offre spéciale</label>
                                </fieldset>
                                <fieldset>
                                    <input type="checkbox" id="checkbox_4" name="special_deals" value="1">
                                    <label for="checkbox_4">Occasions spéciales</label>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-upper btn btn-primary btn-md checkout-page-button">Ajouter le produit</button>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style type="text/css">
        .bootstrap-tagsinput .tag{
            margin-right: 2px;
            color: white;
            font-weight: 700px;
        } 
    </style>

@endsection