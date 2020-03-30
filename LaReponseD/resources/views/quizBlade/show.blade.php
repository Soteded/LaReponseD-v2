@extends('layouts.app')

@section('content')
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
                    <form method="post" action="{{ route('verify', ['quizId' => $quiz->quizId]) }}">
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
                                            <td>R�ponse 1</td>
                                            <td>R�ponse 2</td>
                                            <td>R�ponse 3</td>
                                            <td>R�ponse 4</td>
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
                        <button type="submit" class="btn btn-primary" name="action">Valider</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
