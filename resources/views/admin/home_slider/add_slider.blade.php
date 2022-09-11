@extends('admin.admin_master')
@section('admin')

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 450px;">
        <form method="post" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
            @csrf

            <h3 style="margin-bottom: 15px;">Ajouter un slider</h3>

            <div class="form-group">
                <label class="info-title" for="slider_title_fr">Titre Français</label>
                <input type="text" name="slider_title_fr" class="form-control unicase-form-control text-input" autofocus>
                @error('slider_title_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="slider_title_en">Titre Anglais</label>
                <input type="text" name="slider_title_en" class="form-control unicase-form-control text-input">
                @error('slider_stitle_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="slider_subtitle_fr">Sous-titre Français</label>
                <input type="text" name="slider_subtitle_fr" class="form-control unicase-form-control text-input">
                @error('slider_subtitle_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="slider_subtitle_en">Sous-titre Anglais</label>
                <input type="text" name="slider_subtitle_en" class="form-control unicase-form-control text-input">
                @error('slider_subtitle_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="slider_topleft_title_fr">Titre en haut à gauche Français</label>
                <input type="text" name="slider_topleft_title_fr" class="form-control unicase-form-control text-input">
                @error('slider_topleft_title_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="slider_topleft_title_en">Titre en haut à gauche Anglais</label>
                <input type="text" name="slider_topleft_title_en" class="form-control unicase-form-control text-input">
                @error('slider_topleft_title_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="info-title" for="slider_image">Image de fond</label>
                <input type="file" name="slider_image" class="form-control unicase-form-control text-input">
                @error('slider_image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" style="margin-top: 3px; margin-bottom: 10px;" class="btn-upper btn btn-primary btn-md checkout-page-button">Ajouter le slider</button>
        </form>
    </div>

@endsection