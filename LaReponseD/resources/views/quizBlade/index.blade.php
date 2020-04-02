@extends('layouts.app')

@section('content')

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-danger">
                {{ session()->get('success') }}
            </div><br />
        @endif

        <div class="container">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div><br />
                        @endif

                        <div class="card">
                            <div class="card-header">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <td>Titre</td>
                                        <td>Theme</td>
                                        <td>Créateur</td>
                                        <td>Joué</td>
                                    </tr>
                                    </thead>
                            </div>

                            <div class="card-body">
                        
                                    <tbody>
                                        @foreach($quizs as $quiz)
                                            <tr>
                                                <td>{{$quiz->titre}}</td>
                                                <td>{{ DB::table('category')->where('categoryId', $quiz->RCategoryId)->first()->categoryName}}</td>
                                                <td>{{ DB::table('profile')->where('profileId', $quiz->CreatorId)->first()->pseudo}}</td>
                                                <td class="compteur">{{ $quiz->compteur }}</td> <!-- js pour afficher pas encore jouer -->
                                                <td><button type="button" class="btn btn-primary float-right" onclick="window.location='{{ url("quiz/show/$quiz->quizId") }}'">Jouer</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
@endsection
