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
    </div>
    <div class="card" style="width:60vw;">
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
        <div class="card-body row">
            <div style="float: left; width: 30%; text-align:center;">
                <img class="img-responsive img-rounded" style="width:280px; height:280px;" src="/images/avatar/{{ $profile->avatar }}" alt="User picture">
                <h2 style="margin:10px;">{{ $profile->pseudo }}</h2>
                <p>Membre depuis : <strong>{{ $profile->userSince() }}</strong></p>
            </div>
            <div style="float: right; width: 70%; padding:10px;">
                <table class="table table-striped" style="display:table; width:100%;">
                    <thead>
                        <tr>
                            <td style="width:45%;">Titre</td>
                            <td style="width:20%;">Joué</td>
                            <td style="width:20%;">Catégorie</td>
                            <td style="width:15%;"></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($profile->user->quiz as $quiz)
                        <tr>
                            <td style="width:45%;"><h4>{{ $quiz->titre }}</h4></td>
                            <td style="width:20%;">
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
                            </td>
                            <td style="width:20%;">
                                <a href="/quiz/categorie/{{$quiz->category->categoryId}}" class="btn btn-primary btn-block"> {{$quiz->category->categoryName}}</a>
                            </td>
                            <td style="width:15%;">
                                <form action="{{ route('quiz.show', $quiz->quizId ) }}" method="GET">
                                    {{ method_field('GET') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-play"></i></button>
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