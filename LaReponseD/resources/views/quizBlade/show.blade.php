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
                <div class="card-header">
                    <h2 class="float-left">{{$quiz->titre}}</h2>
                </div>
                
                <?php $quest = 0 ?>

                <div class="card-body">
                    <!-- Participation au quiz-->
                    <form method="post" action="{{ route('verify', ['quizId' => $quiz->quizId]) }}" class="page" id="not_report">
                        @csrf
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
                                                <td class="page2" id="show">
                                                    {{$choix}}
                                                </td>
                                                <td class="page2" id="participe">
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
                    </form>

                    <!-- Report du quiz-->   
                    <form method="post" action="{{ route('report.store', ['idReported' => $quiz->quizId, 'type' => 'quiz']) }}" id="report" class="page" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="name">Pourquoi? </div>
                            <div class="value">
                                <input class="form-control input--style-6" type="text" id="message" name="message" required/>
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
