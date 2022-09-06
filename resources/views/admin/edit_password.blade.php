@extends('admin.admin_master')
@section('admin')

<style>
    label {
        margin-top: 10px;
    }
    #input_width {
        width: 880px;
    }
</style>

<div style="margin-top: 30px; margin-left: 40px;">
    <h3>Modifier mon mot de passe</h3>
    <form method="post" action="{{ route('admin.password.update') }}">
        @csrf

        <label for="current_password">Ancien mot de passe</label>
        <input type="text" id="input_width" class="form-control" name="current_password" required>

        <label for="new_password">Nouveau mot de passe</label>
        <input type="text" id="input_width" class="form-control" name="new_password" required>

        <label for="confirm_password">Confirmation du nouveau mot de passe</label>
        <input type="text" id="input_width" class="form-control" name="confirm_password" required>

        <button type="submit" class="btn btn-info" style="margin-top: 20px;">Enregistrer les modifications</button>
    </form>
</div>

@endsection