@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br />
    @endif
    @if(session()->get('alert'))
        <div class="alert alert-warning">
            {{ session()->get('alert') }}
        </div><br />
    @endif
    </div>
    <div class="card" style="width: 50%; display: block; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            Toutes les catégories
        </div>
        <div class="card-body">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category->categoryId) }}">
                    <div>
                    <h4>{{ $category->categoryName }}</h4>
                    Quizs : {{ count($category->quizs) }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection