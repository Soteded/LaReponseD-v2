@extends('layouts.app')

@section('content')

<div style="margin-top: 40px;">
    @if(session()->get('success'))
        <div class="alert alert-danger">
            {{ session()->get('success') }}
        </div><br />
    @endif
    <div class="card">
        <div class="card-header">
            <h2>Rechercher un quiz :</h2>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="searchInput" class="form-control" placeholder="Quiz"/>
            </div>

            <button id="created_at" class="btn btn-primary searchSort">Date de création</button>
            <button id="titre" class="btn btn-secondary searchSort">Ordre Alphabétique</button>
            <button id="compteur" class="btn btn-secondary searchSort">Nb joué</button>
            <button id="noteAvg" class="btn btn-secondary searchSort">Note moyenne</button>
        </div>
    </div>
    <div class="container">
        <div class="row" id="searchResult">
            @foreach($quizs as $quiz)
            <div class="searchElement col-lg-4 col-md-6 mb-4" style="padding:10px;">
                <div class="card h-100"> 
                    <a href="/quiz/show/{{$quiz->quizId}}"><img class="card-img-top" src="/images/miniature/{{ $quiz->image }}" alt=""></a><div class="card-body">
                        <h4 class="card-title">
                            <a href="/quiz/show/{{$quiz->quizId}}" class="quizTitre">{{$quiz->titre}}</a>
                        </h4>

                        <p><a href="/quiz/categorie/{{$quiz->category->categoryId}}" class="category"> {{$quiz->category->categoryName}}</a> -  <a href="/profile/{{$quiz->user->profile->profileId}}" class="creator"> {{$quiz->user->profile->pseudo}} </a></p>
                        <p>Créé le : <span class="created_at">{{ $quiz->created_at->format('d/m/Y') }}</span></p>
                    </div>
                    <div class="card-footer">
                        <p> Joué : <span class="compteur"><?php if($quiz->compteur){ echo $quiz->compteur; } else { echo 0; }?></span> fois  /   Note: <span class="noteAvg"><?php if($quiz->noteAvg){ echo $quiz->noteAvg; } else { echo 0; }?></span></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
<div>
@endsection