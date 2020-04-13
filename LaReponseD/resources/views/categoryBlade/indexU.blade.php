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
    <div class="card" style="width:100%; margin-left: auto; margin-right: auto;">
        <div class="card-header">
            <h2>Toutes les catégories</h2>
        </div>
        <div class="card-body mainFlex categIndex">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category->categoryId) }}" class="card col-lg-2 col-md-4 mb-2">
                    <div class="card-body">
                        <h4>{{ $category->categoryName }}</h4>
                        Quizs : {{ count($category->quizs) }}
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection