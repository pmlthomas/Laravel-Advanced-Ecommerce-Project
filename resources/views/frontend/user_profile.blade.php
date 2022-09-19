@extends('frontend.main_master')
@section('content')

<div style="margin-top: 30px; margin-left: 40px; margin-bottom: 50px;">
    <h3 style="background-color: #5cb85c; padding: 10px; display: inline-block; color: white; margin-top: -10px; margin-bottom: 20px;">Bienvenue dans votre espace personnel</h3>

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ (!empty($userInfos->profile_photo_path))? asset('storage/'.$userInfos->profile_photo_path): asset('backend/images/no_image.jpg') }}" style="align-self: center; height: 100px;" class="card-img-top" alt="Image de profil">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">Nom : {{ $userInfos->name }}</p>
                    <p class="card-text">Nom d'utilisateur : {{ $userInfos->username }}</p>
                    <p class="card-text" style="padding-bottom: 10px;">Email : {{ $userInfos->email }}</p>
                    <div style="display: flex;">
                        <a href="{{ route('user.profile.edit') }}"><button type="button" class="btn btn-success" style=" margin-right: 10px;">Modifier mon profil</button></a>
                        <a href="{{ route('user.password.edit') }}"><button type="button" class="btn btn-success" style=" margin-right: 10px;">Changer mon mot de passe</button></a>
                        <a href="{{ route('user.orders') }}"><button type="button" class="btn btn-success">Mes commandes</button></a>
                    </div>
                    <a href="{{ route('logout') }}"><button type="button" class="btn btn-danger" style="margin-top: 10px; margin-bottom: -20px;">Me déconnecter</button></a>
                </div>    
            </div>
        </div>
    </div>
</div>

@endsection