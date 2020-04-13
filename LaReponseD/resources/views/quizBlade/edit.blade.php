@extends('layouts.app')


@section('content')
        <script src="{{ asset('js/edit.js') }}" defer></script>
        <div class="row no-gutters">

            <!-- Affichage à gauche -->
            <div class="col no-gutters ">
                <div class="text-white border">
                    <div class="row"> 
                        <div class="col">
                            <h5>{{$quiz->titre}}</h5>
                            <p> {{$quiz->category->categoryName}}</p>
                        </div>
                        <div class="col pt-3 pr-5">
                            <a class="btn btn-primary float-right " href="#category"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
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
                        @foreach($quiz->questions as $question)
                            <tr class="text-center">
                                <td class="text-break">{{$question->question}}</td>
                                <td class="text-break">{{$question->choix->choixJuste}}</td>
                                <td class="text-break">{{$question->choix->choix2}}</td>
                                <td class="text-break">{{$question->choix->choix3}}</td>
                                <td class="text-break">{{$question->choix->choix4}}</td>
                            </tr>
                            <tr> <td><a class="btn btn-primary btn-lg btn-block" href="#question/{{$question->questionId}}"><i class="fas fa-arrow-right"></i></a></td> </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Formulaire à droite -->
            <div class="col no-gutters border">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif                    
                        
                        <div id="category" class="form-group page">
                            <form method="post" action="{{ route('quiz.update', $quiz->quizId) }}" autocomplete="off">
                            @method('PATCH')
                            @csrf

                            <div class="form-row">
                                <div class="name">Theme</div>
                                    <div class="value">
                                        <div class="input-group">
                                            <select name="theme" id="theme" required>
                                                <option value="{{$quiz->category->categoryId}}">{{$quiz->category->categoryName}}</option>
                                                @foreach ($categorys as $category)
                                                    @if($category->categoryId == $quiz->category->categoryId)
                                                        @continue
                                                    @endif
                                                    <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                            </form>
                        </div>

                        @foreach($quiz->questions as $question)
                            <div id="question/{{$question->questionId}}" class="page" style="display: none;">
                                <form method="post" action="{{ route('quiz.update', $quiz->quizId) }}" autocomplete="off">
                                @method('PATCH')
                                @csrf
                                    <div class="form-group d-lg-none" >
                                        <label for="questionId">Question :</label>
                                        <input type="text" class="form-control" name="questions[questionId]" value="{{ $question->questionId }}" />
                                    </div>
                                    <!--##############################-->
                                    <!--           QUESTION           -->
                                    <div class="form-row">
                                        <label for="name" class="name">Question :</label>
                                        <input class="form-control input--style-6" type="text" name="questions[question]" value="{{ $question->question }}" required/>
                                    </div>

                                    <!-- REPONSE Juste DU QUIZs -->
                                    <div class="form-row">
                                        <label for="name" class="name">Réponse Juste :</label>
                                        <input class="form-control input--style-6" type="text" name="questions[choixJuste]" value="{{ $question->choix->choixJuste }}" required/>
                                    </div>

                                    <!-- REPONSE 2 DU QUIZs -->
                                    <div class="form-row">
                                        <label for="name" class="name">Réponse 2 :</label>
                                        <input class="form-control input--style-6" type="text" name="questions[choix2]" value="{{ $question->choix->choix2 }}" required/>
                                    </div>

                                    <!-- REPONSE 3 DU QUIZs -->
                                    <div class="form-row">
                                        <label class="name">Réponse 3 :</label>
                                        <input class="form-control input--style-6" type="text" name="questions[choix3]"  value="{{ $question->choix->choix3 }}"required/>
                                    </div>

                                    <!-- REPONSE 4 DU QUIZs -->
                                    <div class="form-row">
                                        <label class="name">Réponse 2 :</label>
                                        <input class="form-control input--style-6" type="text" name="questions[choix4]"  value="{{ $question->choix->choix4 }}"required/>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                                </form>
                            </div>
                        @endforeach        
                </div>
            </div>
        </div>
    

 
@endsection