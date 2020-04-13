@extends('layouts.app')


@section('content')

        <div class="row no-gutters">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
            @endif


            <!-- Affichage à gauche -->
            <div class="col no-gutters border">
                <div style="width:100%; height:100%;" class="text-white">
                    <div> 
                        <h3 class="">{{$quiz->titre}}</h3>
                        <p> {{$quiz->category->categoryName}} </p>
                    </div>
                    @if ($questions != null)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td class="h6">Question</td>
                                <td class="h6">Réponse Juste</td>
                                <td class="h6">Réponse 2</td>
                                <td class="h6">Réponse 3</td>
                                <td class="h6">Réponse 4</td>
                            </tr>
                        </thead>
                        <tbody class="h-auto mt-2">
                        @foreach($questions as $question)
                            <tr class="text-center">
                                <td class="text-break">{{$question->question}}</td>
                                <td class="text-break">{{$question->choix->choixJuste}}</td>
                                <td class="text-break">{{$question->choix->choix2}}</td>
                                <td class="text-break">{{$question->choix->choix3}}</td>
                                <td class="text-break">{{$question->choix->choix4}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>



            <!-- Formulaire à droite -->
            <div class="col no-gutters">
                <div class="card-body border">
                    <form method="post" action="{{ route('question.store') }}">
                        @csrf

                        <!--##############################-->
                        <!--           QUESTION           -->
                        <div class="form-row">
                            <label for="name" class="name">Question :</label>
                            <input class="form-control input--style-6" type="text" id="question" name="question"  required/>
                        </div>

                        <!-- REPONSE Juste DU QUIZs -->
                        <div class="form-row">
                            <label for="name" class="name">Réponse Juste :</label>
                            <input class="form-control input--style-6" type="text" id="repJuste" name="repJuste"  required/>
                        </div>

                        <!-- REPONSE 2 DU QUIZs -->
                        <div class="form-row">
                            <label for="name" class="name">Réponse 2 :</label>
                            <input class="form-control input--style-6" type="text" id="rep2" name="rep2"  required/>
                        </div>

                        <!-- REPONSE 3 DU QUIZs -->
                        <div class="form-row">
                            <label class="name">Réponse 3 :</label>
                            <input class="form-control input--style-6" type="text" id="rep3" name="rep3"  required/>
                        </div>

                        <!-- REPONSE 4 DU QUIZs -->
                        <div class="form-row">
                            <label class="name">Réponse 2 :</label>
                            <input class="form-control input--style-6" type="text" id="rep4" name="rep4"  required/>
                        </div>
                        <!--##############################-->

                        <button type="submit" class="btn btn-primary  btn-lg btn-block" name="action" value="again">Question suivante</button>
                        <button type="submit" class="btn btn-primary  btn-lg btn-block" name="action" value="end">Fini</button>
                    </form>
                </div>
            </div>
        </div>
    

 
@endsection