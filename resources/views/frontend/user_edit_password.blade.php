@extends('frontend.main_master')
@section('content')

<style>
    label {
        margin-top: 10px;
    }
</style>

<div style="margin-top: 30px; margin-left: 40px; margin-bottom: 20px; margin-right: 600px;">
<h3 style="background-color: green; padding: 10px; display: inline-block; color: white; margin-top: -5px; margin-bottom: 10px;">Modifier mon mot de passe</h3>
    <form method="post" action="{{ route('user.password.update') }}">
        @csrf

        <label for="current_password">Ancien mot de passe</label>
        <input type="password" id="input_width" class="form-control" name="current_password" required>

        <label for="new_password">Nouveau mot de passe</label>
        <input type="password" id="input_width" class="form-control" name="new_password" required>

        <label for="confirm_password">Confirmation du nouveau mot de passe</label>
        <input type="password" id="input_width" class="form-control" name="confirm_password" required>

        <button type="submit" class="btn btn-info" style="margin-top: 20px; background-color: green!important; border: none;">Enregistrer les modifications</button>
    </form>
</div>

@endsection