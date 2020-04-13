@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @elseif(session()->get('alert'))
        <div class="alert alert-warning">
            {{ session()->get('alert') }}
        </div><br />
    @elseif (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                <h2 class="float-left">Profile de : {{ $profile->pseudo }}</h2>
                @if ($profile->profileId == Auth::id())
                    <form action="{{ route('profile.edit', $profile->profileId ) }}" method="GET">
                        {{ method_field('GET') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary float-right">Modifier</button>
                    </form>
                @endif
            </div>
            <div class="card-body">
                <img class="img-responsive img-rounded" style="width:200px; height:200px;" src="/images/avatar/{{ $profile->avatar }}" alt="User picture">
                <h2>{{ $profile->pseudo }}</h2>
                <p>Membre depuis : <strong>{{ $profile->userSince() }}</strong></p>
                <div class="mainFlex">
                @foreach ($profile->user->quiz as $quiz)
                    <div class="border border-secondary" style="padding:3px;">
                        <h4>{{ $quiz->titre }}</h4>
                        <?php
                        switch ($quiz->compteur) {
                            case NULL:
                            case 0:
                                echo "Pas encore joué";
                                break;
        
                            default:
                                echo "Joué ".$quiz->compteur." fois.";
                                break;
                        }
                        ?>
                        <form action="{{ route('quiz.show', $quiz->quizId ) }}" method="GET">
                            {{ method_field('GET') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-play"></i></button>
                        </form>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection