@extends('layouts.app')


@section('content')

        <div class="row no-gutters">

            <!-- Affichage à gauche -->
            <div class="col no-gutters">
                <div style="background:grey; width:100%; height:100%;">
                    <div> 
                        
                    </div>
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
                            <label for="name">Réponse 1 :</label>
                            <input type="text" class="form-control" name="repJuste " require/>
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

                        <button type="submit" class="btn btn-primary">Réponses</button>
                    </form>
                </div>
            </div>
        </div>
    

 
@endsection