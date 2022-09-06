@extends('admin.admin_master')
@section('admin')

<div style="margin-top: 30px; margin-left: 40px;">
    <h2>Bienvenue dans votre espace personnel</h2>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ (!empty($userInfos->profile_photo_path))? asset('storage/'.$userInfos->profile_photo_path): asset('backend/images/no_image.jpg') }}" style="align-self: center;" class="card-img-top" alt="Image de profil">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Nom : {{ $userInfos->name }}</p>
                    <p class="card-text">Nom d'utilisateur : {{ $userInfos->username }}</p>
                    <p class="card-text">Email : {{ $userInfos->email }}</p>
                    <a href="{{ route('admin.profile.edit') }}"><button type="button" class="btn btn-info" style="padding-top: 10px;">Modifier mon profil</button></a>
                </div>    
            </div>
        </div>
    </div>
</div>

@endsection