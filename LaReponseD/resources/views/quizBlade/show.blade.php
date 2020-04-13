@extends('layouts.app')

@section('content')
<script src="{{ asset('js/showQuiz.js') }}" defer></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        </div>
        <div class="card col-md-11">
            @if(! $quiz)
                <div class="alert alert-success">
                    <p>Ce quiz n'existe pas</p>
                </div>
            @else

                <div class="card-body">
                    <!-- Show quiz-->
                    <div class="page" id="show">
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <img class="card-img-top" src="/images/miniature/{{ $quiz->image }}" alt="">
                            </div>
                            <div class="col-12 col-xl-6">
                                <div class="row">
                                    <div class="col-12 col-xl-6">
                                        <h2 class="d-flex justify-content-start text-break">{{$quiz->titre}}</h2>
                                        <div class="card d-flex justify-content-start p-2 mt-4">
                                            <p class="card-text h3"> Joué : <span><?php if($quiz->compteur){ echo $quiz->compteur; } else { echo 0; }?></span> fois
                                        </div>
                                        <div class="card d-flex justify-content-start p-2 mt-4">
                                            <p class="card-text h3"> Note: <span class="noteAvg"> <?php if($quiz->noteAvg){ echo $quiz->noteAvg; } else { echo "aucune"; }?></span> </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-6 card border-0 d-flex justify-content-start">
                                        <img class="card-img-top w-100 h-75" src="/images/avatar/{{ $quiz->user->profile->avatar }}" alt="">
                                        <a href="/profile/{{$quiz->user->profile->profileId}}" class="card-subtitle text-center font-weight-bold mt-1 text-dark"> {{$quiz->user->profile->pseudo}} </a>
                                        
                                    </div>
                                </div>
                                <a class="btn btn-primary btn-lg btn-block" href="#participe" id="show">Play</a>
                                <a class="btn btn-primary btn-lg btn-block" href="#report">Report</a>
                                <a class="btn btn-primary btn-lg btn-block" href="#commentaire">Comment</a>
                            </div>
                        </div>

                        <div class="row d-flex p-3 mt-3 border">
                            <h2 class="mr-auto">Commentaires</h2>
                            <button id="buttonShow" class="p-2 h4 text-dark"> plus de com <i class="fas fa-arrow-down"></i></button>
                        </div>
                        @foreach($quiz->comments as $commentaire)
                            <div class="row card mt-1 mt-3 showCommentaires" style="display:none;"> 
                                <div class="card-header d-flex ">
                                    <h2 class="card-title mr-auto"> {{$commentaire->titre}}</h2>
                                    <p class=" card-text pr-2 pt-2 h5">{{$commentaire->note}} / 10</p>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{$commentaire->corps}}</p>
                                </div>
                            </div>
                        @endforeach
                        

                    </div>
                    <!-- Participation au quiz-->
                    <form method="post" action="{{ route('verify', ['quizId' => $quiz->quizId]) }}" class="page" id="participe">
                        @csrf
                        <?php $quest = 0 ?>
                        <h1 class="mb-3">{{$quiz->titre}} </h1>
                        @foreach($quiz->questions as $question)
                            <?php
                                $choix = $question->choix;
                                $liste_choix = [$choix->choixJuste, $choix->choix2, $choix->choix3, $choix->choix4];
                                shuffle($liste_choix);
                            ?>
                            <div class="card mb-2 p-2">
                                <div class="card-header">
                                    <h2 class="card-title">{{$question->question}}</h2>
                                </div>
                                
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td class="h5">Réponse 1</td>
                                            <td class="h5">Réponse 2</td>
                                            <td class="h5">Réponse 3</td>
                                            <td class="h5">Réponse 4</td>
                                        </tr>
                                    </thead>

                                    <tbody class="h-auto mt-2">
                                        <tr class="text-center">
                                            @foreach($liste_choix as $choix)
                                                <td>
                                                    <input type="radio" value="{{$choix}}" name='{{$quest}}' required/>
                                                    <label class="h6" for='{{$quest}}'>{{$choix}}</label>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php $quest += 1;?>
                        @endforeach
                        <button type="submit" class="btn btn-primary btn-lg btn-block" name="action" id="participe">Valider</button>
                    </form>
                    
                    <!-- Commente/note du quiz -->  
                    <form method="post" action="{{ route('userNoteQuiz.store', ['quizId' => $quiz->quizId]) }}" class="page" id="commentaire" enctype="multipart/form-data">
                    @csrf
                        <a class="btn btn-primary" href="#show"><i class="fas fa-arrow-left"></i></a>
                        <div class="form-row">
                            <div class="name">Titre</div>
                            <div class="value">
                                <input class="form-control input--style-6" type="text" id="titre" name="titre" required/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Message</div>
                            <div class="value">
                                <textarea class="form-control textarea--style-6" type="text" id="message" name="message" required></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Note</div>
                            <div class="value">
                                <div class="input-group">
                                    <select name="note" id="note" required>
                                        <option value="">--Please choose an option--</option>
                                        @for ($i = 0; $i <= 10; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
                    </form>



                    <!-- Report du quiz-->   
                    <form method="post" action="{{ route('report.store', ['idReported' => $quiz->quizId, 'type' => 'quiz']) }}" id="report" class="page" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="name card-title h3"><a class="btn btn-primary" href="#show"><i class="fas fa-arrow-left"></i></a> Pourquoi? </div>
                            <div class="value">
                                <textarea class="form-control textarea--style-6" type="text" id="message" name="message" required></textarea>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Report</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
