@extends('layouts.register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    @if(session()->get('alert'))
        <div class="alert alert-warning">
            {{ session()->get('alert') }}
        </div><br />
    @endif
    </div>
    <div class="card" style="width: 50%; display: block; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            Mise à jour du nom d'utilisateur :
        </div>
        <div class="card-body">
            <form action="{{ route('upPseudo', $profile->profileId) }}" method="PUT">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}
                <label for="pseudo">Pseudo :</label><br>
                <input type="text" id="pseudo" name="pseudo" value="{{ $profile->pseudo }}" style="margin-bottom: 20px;"/>
                <button type="submit" class="btn btn-success btn-block" style="width: 100px; margin-left: auto; margin-right: auto;"><i class="fas fa-edit"> Valider</i></button>
            </form>
        </div>
    </div>
</div>
@endsection