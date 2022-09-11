@extends('admin.admin_master')
@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div style="margin-left: 30px; margin-top: 25px; margin-right: 450px;">
        <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
            @csrf

            <h3 style="margin-bottom: 15px;">Ajouter une marque</h3>

            <div class="form-group">
                <label class="info-title" for="brand_name_fr">Nom</label>
                <input type="text" name="brand_name_fr" class="form-control unicase-form-control text-input" autofocus>
                @error('brand_name_fr')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- <div class="form-group">
                <label class="info-title" for="brand_name_en">Nom Anglais</label>
                <input type="text" name="brand_name_en" class="form-control unicase-form-control text-input">
            </div> -->

            <label for="brand_image">Image</label>
            <input type="file" id="chosenImage" name="brand_image" class="form-control">
            @error('brand_image')
                <div>
                    <span class="text-danger">{{ $message }}</span>
                </div>
            @enderror

            <img src="{{ asset('backend/images/no_image.jpg') }}" id="showImage" style="height: 80px; margin-top: 20px; margin-right: 10px;">
            
            <button type="submit" class="btn-upper btn btn-primary btn-md checkout-page-button">Ajouter la marque</button>
        </form>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {
            $('#chosenImage').change(function (e) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

    </script>

@endsection