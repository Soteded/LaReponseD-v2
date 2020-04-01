@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="card" style="min-width: 600px;">
        <div class="card-header">
            <h2 class="float-left">Modifier le profile de : {{ $profile->pseudo }}</h2>
        </div>
        <div class="card-body">
            <form method="post" action="#" autocomplete="off">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" name="pseudo" value="{{ $profile->pseudo }}" />
                </div>
                <div class="form-group">
                    <label for="birthDate">Date de naissance :</label>
                    <input type="date" class="form-control" name="birthDate" value="{{ $profile->birthDate }}" />
                </div>
                <div class="form-group">
                    <label for="address">Photo actuelle :</label>
                    <input type="text" class="form-control" name="address" value="{{ $profile->address }}" />
                </div>
                <button type="submit" class="btn btn-primary">Update !</button>
            </form>
        </div>
    </div>
</div>

@endsection