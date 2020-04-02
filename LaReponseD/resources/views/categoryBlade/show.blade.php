@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @elseif(session()->get('alert'))
        <div class="alert alert-warning">
            {{ session()->get('alert') }}
        </div><br />
    @elseif (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <div class="card">
            <div class="card-header">
                <h2 class="float-left">Quizs des {{ $category->categoryName }} :</h2>
            </div>
            <div class="card-body">
                @foreach ($category->quizs as $quiz)
                    <div>
                        {{ $quiz->titre }}
                        {{ $quiz->compteur }}
                        <form action="{{ route('quiz.show', $quiz->quizId ) }}" method="GET">
                            {{ method_field('GET') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary" style="width:100%;"><i class='fas fa-play'></i></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection