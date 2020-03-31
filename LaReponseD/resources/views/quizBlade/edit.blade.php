@extends('layouts.app')


@section('content')
        <script src="{{ asset('js/edit.js') }}" defer></script>
        <div class="row no-gutters">

            <!-- Affichage à gauche -->
            <div class="col no-gutters">
                <div style="background:grey; width:100%; height:100%;">
                    <div style="background:grey; width:100%; height:100%;" class="text-white">
                        <div> 
                            <h5>{{$quiz->titre}}</h5>
                            <p> {{$quiz->category->categoryName}}</p>
                            <a class="btn btn-primary" href="#category">==></a>
                        </div>
                            @foreach($quiz->questions as $question)
                                <div> 
                                    {{$question->question}}
                                    {{$question->choix->choixJuste}}
                                    {{$question->choix->choix2}}
                                    {{$question->choix->choix3}}
                                    {{$question->choix->choix4}}
                                    <a class="btn btn-primary" href="#question/{{$question->questionId}}">==></a>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>

            <!-- Formulaire à droite -->
            <div class="col no-gutters">
                <div class="card-body" style="background:red; width:100%; height:100%;">
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
                                <label for="theme">Theme :</label>
                                <select name="theme" id="theme" required>
                                    <option value="{{$quiz->category->categoryId}}">{{$quiz->category->categoryName}}</option>
                                    @foreach ($categorys as $category)
                                        @if($category->categoryId == $quiz->category->categoryId)
                                            @continue
                                        @endif
                                        <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Update</button>
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

                                    <div class="form-group">
                                        <label for="question">Question :</label>
                                        <input type="text" class="form-control" name="questions[question]" value="{{ $question->question }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="choixJuste">choix Juste :</label>
                                        <input type="text" class="form-control" name="questions[choixJuste]" value="{{ $question->choix->choixJuste }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="choix2">choix2 :</label>
                                        <input type="text" class="form-control" name="questions[choix2]" value="{{ $question->choix->choix2 }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="choix3">choix3 :</label>
                                        <input type="text" class="form-control" name="questions[choix3]" value="{{ $question->choix->choix3 }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="choix4">choix4 :</label>
                                        <input type="text" class="form-control" name="questions[choix4]" value="{{ $question->choix->choix4 }}" />
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        @endforeach
                    </form>
        
                </div>
            </div>
        </div>
    

 
@endsection