@extends('layouts.app')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height:30vh;background-color:#222;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" style="margin-top:250px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Top 3 des quizs les plus joués :</h5>
                    <?php
                        $quizs = DB::table('quiz')->orderBy('compteur')->take(3)->get();
                    ?>
                    <div class="row categIndex" style="font-size:1rem;">
                        @foreach($quizs as $quiz)
                        <a href="{{ route('quiz.show', $quiz->quizId) }}" class="card" style="width:28%;">
                            <div class="card-body" style="background-image: url('/images/miniature/{{$quiz->image}}'); background-size: cover;">
                                <p>{{ $quiz->titre }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="margin-top:270px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Top 3 des quizs les mieux notés :</h5>
                    <?php
                        $quizs = DB::table('quiz')->orderBy('noteAvg')->take(3)->get();
                    ?>
                    <div class="row categIndex" style="font-size:1rem;">
                        @foreach($quizs as $quiz)
                        <a href="{{ route('quiz.show', $quiz->quizId) }}" class="card" style="width:28%;">
                            <div class="card-body" style="background-image: url('/images/miniature/{{$quiz->image}}'); background-size: cover;">
                                <p>{{ $quiz->titre }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="margin-top:250px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Top 3 des catégories les plus utilisées :</h5>
                    <?php
                    $quizs = DB::table('quiz')->select('RCategoryId', DB::raw('count(*)'))->groupBy('RCategoryId')->orderBy(DB::raw('count(*)'))->take(3)->get();
                    ?>
                    <div class="row categIndex" style="font-size:1rem;">
                        @foreach ($quizs as $quiz)
                            <?php $categ = DB::table('category')->where('categoryId', $quiz->RCategoryId)->get(); ?>
                            <a href="{{ route('categorie', $categ[0]->categoryId) }}" class="card" style="width:28%;">
                                <div class="card-body">
                                    <p>{{ $categ[0]->categoryName }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="margin-top:250px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Top 3 des utilisateurs les plus productifs :</h5>
                    <?php
                    $quizs = DB::table('quiz')->select('CreatorId', DB::raw('count(*)'))->groupBy('CreatorId')->orderBy(DB::raw('count(*)'))->take(3)->get();
                    ?>
                    <div class="row categIndex" style="font-size:1rem;">
                        @foreach ($quizs as $quiz)
                            <?php $profile = DB::table('profile')->where('profileId', $quiz->CreatorId)->get(); ?>
                            <a href="{{ route('profile.show', $profile[0]->profileId) }}" class="card" style="width:28%;">
                                <div class="card-body"style="background-image: url('/images/avatar/{{$profile[0]->avatar}}'); background-size: cover;">
                                    <p>{{ $profile[0]->pseudo }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection