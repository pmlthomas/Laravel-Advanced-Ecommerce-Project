@extends('frontend.main_master')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    label {
        margin-top: 10px;
    }
</style>

<div style="margin-top: 30px; margin-left: 40px; margin-right: 600px;">
    <h4 style="background-color: rgb(21, 126, 210); padding: 10px; display: inline-block; color: white; margin-top: -10px; margin-bottom: 5px;">Modifier mon profil</h4>

    <form method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <label for="name">Nom</label>
        <input type="text" id="input_width" class="form-control" name="name" value="{{ $userInfos->name }}">

        <label for="username">Nom d'utilisateur</label>
        <input type="text" id="input_width" class="form-control" name="username" value="{{ $userInfos->username }}">

        <label for="email">Email</label>
        <input type="text" id="input_width" class="form-control" name="email" value="{{ $userInfos->email }}">

        <label for="profile_image">Image de profil</label>
        <input type="file" id="chosenImage" name="profile_image" class="form-control">

        <img src="{{ asset('backend/images/no_image.jpg') }}" id="showImage" style="max-height: 100px; margin-top: 10px; margin-bottom: 20px;">

        <button type="submit" class="btn btn-info" style="margin-top: 25px; margin-left: 10px; background-color: rgb(21, 126, 210)!important; border: none;">Enregistrer les modifications</button>
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