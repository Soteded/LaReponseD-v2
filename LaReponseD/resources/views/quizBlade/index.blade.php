@extends('layouts.app')

@section('content')

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-danger">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <div class="container">
            <div class="container">
                <div class="row">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div><br />
                        @endif
                        @foreach($quizs as $quiz)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100"> 
                                <a href="/quiz/show/{{$quiz->quizId}}"><img class="card-img-top" src="/images/miniature/{{ $quiz->image }}" alt=""></a><div class="card-body">
                                    <h4 class="card-title">
                                        <a href="/quiz/show/{{$quiz->quizId}}">{{$quiz->titre}}</a>
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
        </div>
        <div>
@endsection
