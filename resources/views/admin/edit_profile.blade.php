@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    label {
        margin-top: 10px;
    }
    #input_width {
        width: 880px;
    }
    #chosenImage {
        width: 880px;
    }
    #showImage {
        height: 80px; 
        margin-top: 20px; 
        margin-left: 2px; 
        margin-right: 15px;
        max-width: 150px;
    }
</style>

<div style="margin-top: 30px; margin-left: 40px;">
    <h3>Modifier mon profil</h3>
    <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <label for="name">Nom</label>
        <input type="text" id="input_width" class="form-control" name="name" value="{{ $userInfos->name }}">

        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="input_width" class="form-control" name="username" value="{{ $userInfos->username }}">

        <label for="email">Email</label>
        <input type="text" id="input_width" class="form-control" name="email" value="{{ $userInfos->email }}">

        <label for="profile_image">Image de profil</label>
        <input type="file" id="chosenImage" name="profile_image" class="form-control">

        <img src="{{ asset('backend/images/no_image.jpg') }}" id="showImage">

        <button type="submit" class="btn btn-info" style="margin-top: 20px;">Enregistrer les modifications</button>
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