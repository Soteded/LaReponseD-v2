@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="card" style="min-width: 600px;">
        <div class="card-header">
            <h2 class="float-left">Modifier le profile de : {{ $profile->pseudo }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update', $profile->profileId) }}" autocomplete="off" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" class="form-control" name="pseudo" value="{{ $profile->pseudo }}" required/>
                </div>
                <div class="form-group">
                    <label for="birthDate">Date de naissance :</label>
                    <input type="date" class="form-control" name="birthDate" value="{{ $profile->birthDate }}" required/>
                </div>
                <div class="form-group">
                    <label for="image">Photo de profile :</label><br/>
                    <img class="img-responsive img-rounded" style="width:400px;height:400px;" src="/images/avatar/{{ $profile->avatar }}" alt="User picture">
                    <input type="file" accept="image/*" name="image" class="form-control" style="margin:10px;"/>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour !</button>
            </form>
        </div>
    </div>
</div>

@endsection