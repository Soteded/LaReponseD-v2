@extends('layouts.register')

@section('content')

    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Créer son Profile</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif

            <form method="post" action="{{ route('profile.store') }}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                    <label for="firstName">Pseudo :</label>
                    <input type="text" class="form-control" name="pseudo" required/>
                </div>

                <div class="form-group">
                    <label for="birthDate">Date de naissance :</label>
                    <input type="date" class="form-control" name="birthDate" required/>
                </div>

                <div class="form-group">
                    <label for="image">Avatar</label>
                    <input type="file" accept="image/*" name="image" class="form-control"/>
                </div>

                <button type="submit" class="btn btn-primary">Créer !</button>
            </form>
        </div>
    </div>

@endsection