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
                <input type="text" id="searchInput" class="form-control" placeholder="Nom du quiz"/>
            </div>
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

                        <?php 
                            $categorie = DB::table('category')->where('categoryId', $quiz->RCategoryId)->first();
                            $profile = DB::table('profile')->where('profileId', $quiz->CreatorId)->first();
                        ?>
                        <p><a href="/quiz/categorie/{{$categorie->categoryId}}"> {{$categorie->categoryName}}</a> -  <a href="/profile/{{$profile->profileId}}"> {{$profile->pseudo}} </a></p>
                    </div>
                    <div class="card-footer">
                        <p> Jouer : {{$quiz->compteur}}     Note: {{$quiz->noteAvg}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
<div>
@endsection
