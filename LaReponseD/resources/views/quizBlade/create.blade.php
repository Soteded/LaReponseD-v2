@extends('layouts.app')
<script src="{{ asset('js/quiz/utils.js') }}" defer></script>

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    
    <div class="card uper">
        <div class="card-header">
            Créer un nouveau quiz
        </div>
        
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <div id="quiz" class="page">
            
                <form method="post">
                    @csrf
                    <!-- TITRE DU QUIZs -->
                    <div class="form-group">
                        <label for="titre">Titre :</label>
                        <input type="text" class="form-control" id="titre" name="titre" required/>
                    </div>

                    <!-- THEME DU QUIZs -->

                        
                    <!-- <button type="submit" class="btn btn-primary">Créer</button> -->
                    <a href="#question/1" class="btn btn-primary"> Suivant</a>
                </form>
            </div>

            <div id="question" class="page" style="display: none;">
                <form method="post"  >
                    @csrf

                    <!--##############################-->
                    <!--          QUESTION 1          -->
                    <div class="form-group">
                        <label for="name">Question <span id="numQuestion"></span> :</label>
                        <input type="text" class="form-control" name="question1" require/>
                    </div>

                    <hr>

                    <!-- REPONSE 1 DU QUIZs -->
                    <div>
                        <label for="name">Réponse 1 :</label>
                        <input type="text" class="form-control" name="rep2" require/>
                    </div>

                    <!-- REPONSE 2 DU QUIZs -->
                    <div>
                        <label for="name">Réponse 2 :</label>
                        <input type="text" class="form-control" name="rep3" require/>
                    </div>

                    <!-- REPONSE 3 DU QUIZs -->
                    <div>
                        <label for="name">Réponse 3 :</label>
                        <input type="text" class="form-control" name="rep4" require/>
                    </div>

                    <!-- REPONSE 4 DU QUIZs -->
                    <div>
                        <label for="name">Réponse 4 :</label>
                        <input type="text" class="form-control" name="rep5" require/>
                    </div>
                    <!--##############################-->

                    <!-- <button type="submit" class="btn btn-primary" name="action" value="next">Réponses</button> -->
                    <a href="#question/2" class="btn btn-primary"> Suivant</a>
                </form>
            </div>

        </div>
    </div>
@endsection