@extends('layouts.app')

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
    <div id="racine" class="mainFlex">
        <div class="card" style='margin:1%;width:100%;'>
            <div class="card-header">
                <h2 class="float-left">Profiles</h2>
                @hasrole('Admin')
                <form action="{{ route('user.index') }}" method="GET">
                    {{ method_field('GET') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-secondary float-right" style="margin-right:10px;"><i class="fas fa-eye"></i></button>
                </form>
                @endhasrole
            </div>
            <div id="usersDb" class="card-body">
                <table class="table table-striped" style="display:table;">
                    <thead>
                        <tr>
                            <td style="width:5%;"></td>
                            <td style="width:20%;">Pseudonyme</td>
                            <td style="width:20%;">Créé le :</td>
                            <td style="width:10%;">Voir le profile</td>
                            <td style="width:10%;">Voir les quizs</td>
                        </tr>
                    </thead>
                    <tbody style="height:60vh;">
                        @foreach ( $profiles as $profile )
                            <tr>
                                <td style="width:5%;"><img class="img-responsive img-rounded" style="width:50px; height:50px;" src="/images/avatar/{{ $profile->avatar }}" alt="User picture"></td>
                                <td style="width:20%;">{{ $profile->pseudo }}</td>
                                <td style="width:20%;">{{ $profile->created_at }}</td>
                                <td style="width:10%;">
                                    <form action="{{ route('profile.show', $profile->profileId) }}" method="GET">
                                        {{ method_field('GET') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-id-card"></i></button>
                                    </form>
                                </td>
                                <td style="width:10%;">
                                    <form action="{{ route('quiz.show', $profile->profileId) }}" method="GET">
                                        {{ method_field('GET') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-play"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection