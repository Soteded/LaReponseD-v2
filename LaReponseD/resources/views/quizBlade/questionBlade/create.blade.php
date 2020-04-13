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
            <div class="col no-gutters">
                <div style="width:100%; height:100%;" class="text-white">
                    <div> 
                        <h3 class="">{{$quiz->titre}}</h3>
                        <p> {{$quiz->category->categoryName}} </p>
                    </div>
                    @if ($questions != null)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td class="h6">Titre</td>
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
                <div class="card-body" style="background:red; width:100%; height:100%;">
                    <form method="post" action="{{ route('question.store') }}">
                        @csrf

                        <!--##############################-->
                        <!--           QUESTION           -->
                        <div class="form-group">
                            <label for="name">Question :</label>
                            <input type="text" class="form-control" name="question" require/>
                        </div>

                        <hr>

                        <!-- REPONSE Juste DU QUIZs -->
                        <div>
                            <label for="name">Réponse Juste :</label>
                            <input type="text" class="form-control" name="repJuste" require/>
                        </div>

                        <!-- REPONSE 1 DU QUIZs -->
                        <div>
                            <label for="name">Réponse 2 :</label>
                            <input type="text" class="form-control" name="rep2" require/>
                        </div>

                        <!-- REPONSE 2 DU QUIZs -->
                        <div>
                            <label for="name">Réponse 3 :</label>
                            <input type="text" class="form-control" name="rep3" require/>
                        </div>

                        <!-- REPONSE 3 DU QUIZs -->
                        <div>
                            <label for="name">Réponse 4 :</label>
                            <input type="text" class="form-control" name="rep4" require/>
                        </div>
                        <!--##############################-->

                        <button type="submit" class="btn btn-primary" name="action" value="again">Again</button>
                        <button type="submit" class="btn btn-primary" name="action" value="end">End</button>
                    </form>
                </div>
            </div>
        </div>
    

 
@endsection