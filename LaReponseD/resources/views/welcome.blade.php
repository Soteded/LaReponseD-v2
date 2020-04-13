@extends('layouts.app')

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height:30vh; background-color:#888; border-radius:10px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" style="margin-top:270px;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Top 3 des quizs les plus joués :</h5>
                    <?php
                        $quizs = DB::table('quiz')->orderBy('compteur', 'desc')->take(3)->get();
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
                        $quizs = DB::table('quiz')->orderBy('noteAvg', 'desc')->take(3)->get();
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
                    $quizs = DB::table('quiz')->select('RCategoryId', DB::raw('count(*)'))->groupBy('RCategoryId')->orderBy(DB::raw('count(*)'), 'desc')->take(3)->get();
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
                    $quizs = DB::table('quiz')->select('CreatorId', DB::raw('count(*)'))->groupBy('CreatorId')->orderBy(DB::raw('count(*)'), 'desc')->take(3)->get();
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

    <?php
    use App\Profile;
    use App\Category;
    use App\Quiz;
    ?>

    <div class="d-flex justify-content-between" style="width:100%;">
        <div style="background-color:#ddd; border-radius:10px; width:32%;">
            <table class="table table-striped" style="display:table;">
                <tbody style="height:33vh;">
                    <?php
                    $quizs = Quiz::all()->take(5);
                    ?>
                    @foreach( $quizs as $quiz )
                        <tr>
                            <td>{{ $quiz->titre }}</td>
                            <td>{{ count($quiz->questions) }} questions</td>
                            <td>
                                <form action="{{ route('quiz.show', $quiz->quizId) }}" method="GET">
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
        <div style="background-color:#ddd; border-radius:10px; width:32%;">
            <table class="table table-striped" style="display:table;">
                <tbody style="height:33vh;">
                    <?php
                    $categories = Category::all()->take(5);
                    ?>
                    @foreach( $categories as $category )
                        <tr>
                            <td>{{ $category->categoryName }}</td>
                            <td>{{ count($category->quizs) }} quizs</td>
                            <td>
                                <a  href="/quiz/categorie/{{$quiz->category->categoryId}}" class="btn btn-primary">Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="background-color:#ddd; border-radius:10px; width:32%;">
            <table class="table table-striped" style="display:table;">
                <tbody style="height:33vh;">
                    <?php
                    $profiles = Profile::all()->take(5);
                    ?>
                    @foreach( $profiles as $profile )
                        <tr>
                            <td>{{ $profile->pseudo }}</td>
                            <td>{{ count($profile->user->quiz) }} quizs</td>
                            <td>
                                <form action="{{ route('profile.show', $profile->profileId) }}" method="GET">
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
@endsection