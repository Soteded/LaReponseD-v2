@extends('layouts.app')


@section('content')

        <link href="{{ asset('css/createQuiz.css') }}" rel="stylesheet" type="text/css">
        <div class="card card-6">
            <div class="card-heading">
                <h2 class="title">Créer ton quiz</h2>
            </div>
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
                <form method="POST" action="{{ route('quiz.store') }}" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="name">Titre</div>
                        <div class="value">
                            <input class="form-control input--style-6" type="text" id="titre" name="titre" required/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Theme</div>
                        <div class="value">
                            <div class="input-group">
                                <select name="theme" id="theme" required>
                                    <option value="">--Please choose an option--</option>
                                    @foreach ($categorys as $category)
                                        <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Upload CV</div>
                        <div class="value">
                            <div class="input-group js-input-file">
                                <input type="file" accept="image/*" name="image" class="form-control"/>
                                <label class="label--file" for="file">Choose file</label>
                                <span class="input-file__info">No file chosen</span>
                            </div>
                            <div class="label--desc">upload une image. MAX jesaisplusMB</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Créer</button>
            </div>
        </div>
@endsection