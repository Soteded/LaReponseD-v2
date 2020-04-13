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
                                <div class="row mt-1 pl-1">
                                    <h2 class="float-left">{{$quiz->titre}}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Participation au quiz-->
                    <form method="post" action="{{ route('verify', ['quizId' => $quiz->quizId]) }}" class="page" id="participe">
                        @csrf
                        <?php $quest = 0 ?>
                        @foreach($quiz->questions as $question)
                            <?php
                                $choix = $question->choix;
                                $liste_choix = [$choix->choixJuste, $choix->choix2, $choix->choix3, $choix->choix4];
                                shuffle($liste_choix);
                            ?>
                            <div class="border mb-2 p-2">
                                <h5>{{$question->question}}</h5>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>Réponse 1</td>
                                            <td>Réponse 2</td>
                                            <td>Réponse 3</td>
                                            <td>Réponse 4</td>
                                        </tr>
                                    </thead>

                                    <tbody class="h-auto">
                                        <tr class="text-center">
                                            @foreach($liste_choix as $choix)
                                                <td>
                                                    <input type="radio" value="{{$choix}}" name='{{$quest}}'>
                                                    <label for='{{$quest}}'>{{$choix}}</label>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php $quest += 1;?>
                        @endforeach
                        <a class="btn btn-primary page2" href="#participe" id="show">Play</a>
                        <button type="submit" class="btn btn-primary page2" name="action" id="participe">Valider</button>
                        <a class="btn btn-primary float-lg-right" href="#report">Report</a>
                        <a class="btn btn-primary float-lg-right" href="#commentaire">Comment</a>
                    </form>
                    
                    <!-- Commente/note du quiz -->  
                    <form method="post" action="{{ route('userNoteQuiz.store', ['quizId' => $quiz->quizId]) }}" class="page" id="commentaire" enctype="multipart/form-data">
                    @csrf
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
                        <a class="btn btn-primary" href="#show"><===</a>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>



                    <!-- Report du quiz-->   
                    <form method="post" action="{{ route('report.store', ['idReported' => $quiz->quizId, 'type' => 'quiz']) }}" id="report" class="page" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="name">Pourquoi? </div>
                            <div class="value">
                                <textarea class="form-control textarea--style-6" type="text" id="message" name="message" required></textarea>
                            </div>
                        </div>
                            <a class="btn btn-primary" href="#show"><===</a>
                            <button type="submit" class="btn btn-primary">Report</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
