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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
        
                    <form method="post" action="{{ route('quiz.store') }}">
                        @csrf
                        <!-- TITRE DU QUIZs -->
                        <div class="form-group">
                            <label for="titre">Titre :</label>
                            <input type="text" class="form-control" id="titre" name="titre" required/>
                        </div>
        
                        <!-- THEME DU QUIZs -->
                        <label for="theme">Thème :</label>
                        <select name="theme" id="theme" required>
                            <option value="">--Please choose an option--</option>
                            @foreach ($categorys as $category)
                                <option value="{{$category->categoryId}}">{{$category->categoryName}}</option>
                            @endforeach
                        </select>
        
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
        
                </div>
            </div>
        </div>
    

 
@endsection